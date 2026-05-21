<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $actor = auth()->user();
        $user = $this->dashboardUser($actor);
        $month = now()->startOfMonth();
        $monthRange = [
            $month->copy()->startOfMonth()->toDateString(),
            $month->copy()->endOfMonth()->toDateString(),
        ];

        $ownEntries = TimeEntry::with('project')
            ->where('user_id', $user->id)
            ->whereBetween('entry_date', $monthRange)
            ->get();

        $approvalEntries = $user->canRead('approvals')
            ? $this->approvalScope($user)->whereBetween('entry_date', $monthRange)->get()
            : collect();

        $billingSummary = $user->canRead('billing')
            ? $this->billingSummary($user, $monthRange)
            : null;

        return view('livewire.dashboard', [
            'assignedProjects' => $this->assignedProjects($user),
            'billingSummary' => $billingSummary,
            'canReadApprovals' => $user->canRead('approvals'),
            'canReadBilling' => $user->canRead('billing'),
            'canReadCalendars' => $user->canRead('calendars'),
            'canReadProjects' => $user->canRead('projects'),
            'canReadTimeEntry' => $user->canRead('time-entry'),
            'canReadUserManagement' => $user->canRead('user-management'),
            'monthLabel' => $month->format('F Y'),
            'ownApprovedHours' => $ownEntries->where('status', 'approved')->sum('hours'),
            'ownDraftHours' => $ownEntries->where('status', 'draft')->sum('hours'),
            'ownRegisteredHours' => $ownEntries->sum('hours'),
            'ownSubmittedHours' => $ownEntries->where('status', 'submitted')->sum('hours'),
            'pendingApprovalCount' => $approvalEntries->where('status', 'submitted')->count(),
            'pendingApprovalHours' => $approvalEntries->where('status', 'submitted')->sum('hours'),
            'recentEntries' => TimeEntry::with('project')
                ->where('user_id', $user->id)
                ->where('hours', '>', 0)
                ->orderByDesc('entry_date')
                ->latest()
                ->limit(6)
                ->get(),
            'teamApprovedHours' => $approvalEntries->where('status', 'approved')->sum('hours'),
            'teamDeclinedCount' => $approvalEntries->where('status', 'declined')->count(),
            'user' => $user,
        ]);
    }

    private function approvalScope(User $user): Builder
    {
        $query = TimeEntry::with(['user', 'project'])
            ->whereHas('user')
            ->whereHas('project')
            ->where('hours', '>', 0);

        if ($user->role === 'administrator') {
            return $query;
        }

        if ($user->role === 'manager') {
            $employeeIds = $user->managedEmployees()
                ->wherePivot('active', true)
                ->pluck('users.id');

            return $query->whereIn('user_id', $employeeIds);
        }

        return $query->whereRaw('1 = 0');
    }

    private function dashboardUser(User $actor): User
    {
        if ($actor->role !== 'administrator') {
            return $actor;
        }

        $previewUserId = session('permission_preview_user_id');

        if (! $previewUserId || (int) $previewUserId === (int) $actor->id) {
            return $actor;
        }

        return User::find($previewUserId) ?: $actor;
    }

    private function assignedProjects(User $user)
    {
        if ($user->canRead('projects') && $user->role === 'administrator') {
            return Project::query()
                ->withCount(['users as assigned_users_count' => fn ($query) => $query->where('project_user.active', true)])
                ->orderBy('name')
                ->limit(6)
                ->get();
        }

        if (! $user->canRead('time-entry') && ! $user->canRead('projects')) {
            return collect();
        }

        return $user->projects()
            ->wherePivot('active', true)
            ->orderBy('projects.name')
            ->limit(6)
            ->get();
    }

    private function billingSummary(User $user, array $monthRange): ?array
    {
        if ($user->role === 'administrator' && ! session('permission_preview_user_id')) {
            $externalUsers = User::where('user_type', 'external')->get();
            $approvedEntries = TimeEntry::whereIn('user_id', $externalUsers->pluck('id'))
                ->where('status', 'approved')
                ->whereBetween('entry_date', $monthRange)
                ->get()
                ->groupBy('user_id');

            $exclusiveVat = $externalUsers->sum(function (User $externalUser) use ($approvedEntries) {
                $hours = (float) $approvedEntries->get($externalUser->id, collect())->sum('hours');

                return $hours * (float) ($externalUser->hourly_fee ?? 0);
            });

            return [
                'currency' => 'mixed',
                'exclusiveVat' => round($exclusiveVat, 2),
                'hours' => round((float) $approvedEntries->flatten()->sum('hours'), 2),
                'label' => 'External billing',
                'vatRate' => null,
            ];
        }

        if ($user->user_type !== 'external') {
            return null;
        }

        $hours = (float) TimeEntry::where('user_id', $user->id)
            ->where('status', 'approved')
            ->whereBetween('entry_date', $monthRange)
            ->sum('hours');
        $exclusiveVat = round($hours * (float) ($user->hourly_fee ?? 0), 2);
        $vatRate = max(0, (float) ($user->vat_rate ?? 21)) / 100;

        return [
            'currency' => $user->hourly_fee_currency ?: 'EUR',
            'exclusiveVat' => $exclusiveVat,
            'hours' => round($hours, 2),
            'inclusiveVat' => round($exclusiveVat * (1 + $vatRate), 2),
            'label' => 'Approved earnings',
            'vatRate' => $vatRate,
        ];
    }
}
