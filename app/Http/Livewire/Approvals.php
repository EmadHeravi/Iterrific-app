<?php

namespace App\Http\Livewire;

use App\Models\TimeEntry;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Approvals extends Component
{
    public $employeeFilter = '';
    public $yearFilter = '';
    public $monthFilter = '';
    public $statusFilter = 'all';

    public function mount()
    {
        $this->yearFilter = now()->format('Y');
        $this->monthFilter = now()->format('m');
    }

    public function approveEntry($timeEntryId)
    {
        abort_unless(auth()->user()->canWrite('approvals'), 403);

        $timeEntry = $this->scopedTimeEntriesQuery()
            ->whereKey($timeEntryId)
            ->where('status', 'submitted')
            ->firstOrFail();

        $timeEntry->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'review_note' => null,
        ]);
    }

    public function declineEntry($timeEntryId)
    {
        abort_unless(auth()->user()->canWrite('approvals'), 403);

        $timeEntry = $this->scopedTimeEntriesQuery()
            ->whereKey($timeEntryId)
            ->where('status', 'submitted')
            ->firstOrFail();

        $timeEntry->update([
            'status' => 'declined',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);
    }

    public function clearFilters()
    {
        $this->reset([
            'employeeFilter',
        ]);

        $this->yearFilter = now()->format('Y');
        $this->monthFilter = now()->format('m');
        $this->statusFilter = 'all';
    }

    private function scopedTimeEntriesQuery(): Builder
    {
        $user = $this->approvalUser();

        $query = TimeEntry::with(['user', 'project', 'reviewer'])
            ->whereHas('user')
            ->whereHas('project');

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

    private function filteredTimeEntriesQuery(): Builder
    {
        return $this->scopedTimeEntriesQuery()
            ->whereBetween('entry_date', [
                $this->selectedMonth()->copy()->startOfMonth()->toDateString(),
                $this->selectedMonth()->copy()->endOfMonth()->toDateString(),
            ])
            ->when($this->statusFilter !== 'all', fn ($query) => $query->where('status', $this->statusFilter))
            ->when($this->employeeFilter !== '', fn ($query) => $query->where('user_id', (int) $this->employeeFilter))
            ->where('hours', '>', 0);
    }

    public function render()
    {
        $month = $this->selectedMonth();
        $approvalUser = $this->approvalUser();

        $pendingQuery = $this->scopedTimeEntriesQuery()
            ->where('status', 'submitted')
            ->whereBetween('entry_date', [
                $month->copy()->startOfMonth()->toDateString(),
                $month->copy()->endOfMonth()->toDateString(),
            ]);

        $timeEntries = $this->filteredTimeEntriesQuery()
            ->orderBy('entry_date')
            ->orderBy('user_id')
            ->get();

        $pendingEntries = (clone $pendingQuery)->get();
        $pendingCount = $pendingEntries->count();
        $pendingHours = $pendingEntries->sum('hours');

        return view('livewire.approvals', [
            'timeEntries' => $timeEntries,
            'employeeOptions' => $this->scopedTimeEntriesQuery()
                ->with('user')
                ->whereBetween('entry_date', [
                    $month->copy()->startOfMonth()->toDateString(),
                    $month->copy()->endOfMonth()->toDateString(),
                ])
                ->get()
                ->pluck('user')
                ->filter()
                ->unique('id')
                ->sortBy(fn ($user) => $user->first_name . ' ' . $user->last_name)
                ->values(),
            'yearOptions' => $this->yearOptions(),
            'monthOptions' => $this->monthOptions(),
            'selectedMonthLabel' => $month->format('F Y'),
            'pendingCount' => $pendingCount,
            'pendingHours' => $pendingHours,
            'approvedCount' => $this->filteredStatusCount('approved', $month),
            'declinedCount' => $this->filteredStatusCount('declined', $month),
            'canWriteApprovals' => auth()->user()->canWrite('approvals'),
            'isManagerWithoutAssignments' => $approvalUser->role === 'manager'
                && $approvalUser->managedEmployees()->wherePivot('active', true)->doesntExist(),
        ]);
    }

    private function selectedMonth(): Carbon
    {
        return Carbon::create(
            (int) ($this->yearFilter ?: now()->format('Y')),
            (int) ($this->monthFilter ?: now()->format('m')),
            1
        );
    }

    private function filteredStatusCount(string $status, Carbon $month): int
    {
        return $this->scopedTimeEntriesQuery()
            ->where('status', $status)
            ->whereBetween('entry_date', [
                $month->copy()->startOfMonth()->toDateString(),
                $month->copy()->endOfMonth()->toDateString(),
            ])
            ->count();
    }

    private function yearOptions(): array
    {
        $currentYear = (int) now()->format('Y');
        $entryYears = $this->scopedTimeEntriesQuery()
            ->pluck('entry_date')
            ->map(fn ($date) => (int) Carbon::parse($date)->format('Y'))
            ->unique()
            ->all();

        return collect(range($currentYear - 2, $currentYear + 1))
            ->merge($entryYears)
            ->merge([(int) $this->yearFilter])
            ->filter()
            ->unique()
            ->sortDesc()
            ->values()
            ->all();
    }

    private function monthOptions(): array
    {
        return collect(range(1, 12))
            ->map(fn ($month) => [
                'value' => str_pad((string) $month, 2, '0', STR_PAD_LEFT),
                'label' => Carbon::create(null, $month, 1)->format('F'),
            ])
            ->all();
    }

    private function approvalUser(): User
    {
        $actor = auth()->user();

        if ($actor->role !== 'administrator') {
            return $actor;
        }

        $previewUserId = session('permission_preview_user_id');

        if (! $previewUserId || (int) $previewUserId === (int) $actor->id) {
            return $actor;
        }

        return User::find($previewUserId) ?: $actor;
    }
}
