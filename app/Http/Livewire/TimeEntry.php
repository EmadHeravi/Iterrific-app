<?php

namespace App\Http\Livewire;

use App\Models\Calendar;
use App\Models\Project;
use App\Models\TimeEntry as TimeEntryModel;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class TimeEntry extends Component
{
    public $project_id = '';
    public $entry_date = '';
    public $hours = '';
    public $description = '';
    public $yearFilter = '';
    public $monthFilter = '';
    public $selectedDate = '';
    public $editingTimeEntryId = null;
    public $editingOriginalStatus = '';

    public function mount()
    {
        $this->entry_date = now()->format('Y-m-d');
        $this->selectedDate = now()->format('Y-m-d');
        $this->yearFilter = now()->format('Y');
        $this->monthFilter = now()->format('m');
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->entry_date = $date;
        $this->editingTimeEntryId = null;
        $this->editingOriginalStatus = '';
        $this->reset(['project_id', 'hours', 'description']);
    }

    public function editTimeEntry($timeEntryId)
    {
        abort_unless(auth()->user()->canWrite('time-entry'), 403);

        $timeEntry = TimeEntryModel::whereKey($timeEntryId)->firstOrFail();

        if (! $this->canEditTimeEntry($timeEntry)) {
            return;
        }

        $this->editingTimeEntryId = $timeEntry->id;
        $this->editingOriginalStatus = $timeEntry->status;
        $this->selectedDate = $timeEntry->entry_date->toDateString();
        $this->entry_date = $timeEntry->entry_date->toDateString();
        $this->project_id = $timeEntry->project_id;
        $this->hours = $timeEntry->hours;
        $this->description = $timeEntry->description;
    }

    public function cancelEdit()
    {
        $this->editingTimeEntryId = null;
        $this->editingOriginalStatus = '';
        $this->selectedDate = '';
        $this->resetTimeEntryForm();
    }

    public function saveDraft()
    {
        $this->saveTimeEntry('draft');
    }

    public function submitHours()
    {
        $this->saveTimeEntry('submitted');
    }

    private function saveTimeEntry(string $status)
    {
        abort_unless(auth()->user()->canWrite('time-entry'), 403);

        $this->validate([
            'project_id' => [
                'required',
                'exists:projects,id',
                function ($attribute, $value, $fail) {
                    if (! $this->canUseProject((int) $value)) {
                        $fail('Select a project assigned to you.');
                    }
                },
            ],
            'entry_date' => 'required|date',
            'hours' => 'required|numeric|min:0.25|max:24',
            'description' => 'nullable|string|max:1000',
        ]);

        $entryDate = Carbon::parse($this->entry_date);
        $calendar = $this->matchingCalendar($entryDate);

        $payload = [
            'user_id' => $this->timeEntryUser()->id,
            'project_id' => $this->project_id,
            'entry_date' => $entryDate->toDateString(),
            'hours' => $this->hours,
            'description' => $this->description,
            'status' => $status,
            'is_weekend' => $entryDate->isWeekend(),
            'is_holiday' => (bool) $calendar,
            'calendar_id' => $calendar?->id,
            'submitted_at' => $status === 'submitted' ? now() : null,
        ];

        if ($this->editingTimeEntryId) {
            $timeEntry = TimeEntryModel::whereKey($this->editingTimeEntryId)->firstOrFail();

            if (! $this->canEditTimeEntry($timeEntry)) {
                return;
            }

            $payload['user_id'] = $timeEntry->user_id;
            $payload['status'] = $this->nextStatusForEdit($timeEntry, $status);
            $payload['submitted_at'] = match ($payload['status']) {
                'approved' => $timeEntry->submitted_at ?: now(),
                'submitted' => $timeEntry->submitted_at ?: now(),
                default => null,
            };

            $timeEntry->update($payload + [
                'reviewed_by' => $payload['status'] === 'approved' ? auth()->id() : null,
                'reviewed_at' => $payload['status'] === 'approved' ? now() : null,
                'review_note' => $payload['status'] === 'approved' ? $timeEntry->review_note : null,
            ]);
        } else {
            TimeEntryModel::create($payload);
        }

        $this->resetTimeEntryForm();
    }

    private function resetTimeEntryForm()
    {
        $this->reset([
            'project_id',
            'hours',
            'description',
            'editingTimeEntryId',
            'editingOriginalStatus',
        ]);

        $this->entry_date = $this->selectedDate ?: now()->format('Y-m-d');
    }

    private function matchingCalendar(Carbon $entryDate): ?Calendar
    {
        $exactHoliday = Calendar::where('country_code', 'NL')
            ->where('status', 'active')
            ->whereDate('holiday_date', $entryDate->toDateString())
            ->first();

        if ($exactHoliday) {
            return $exactHoliday;
        }

        return Calendar::where('country_code', 'NL')
            ->where('status', 'active')
            ->where('is_recurring', true)
            ->whereMonth('holiday_date', $entryDate->month)
            ->whereDay('holiday_date', $entryDate->day)
            ->first();
    }

    private function assignedProjectsQuery()
    {
        return $this->timeEntryUser()
            ->projects()
            ->where('projects.status', 'active')
            ->wherePivot('active', true);
    }

    private function projectOptionsQuery()
    {
        if ($this->editingTimeEntryId) {
            $timeEntry = TimeEntryModel::find($this->editingTimeEntryId);

            if ($timeEntry && $this->canEditApprovedEntry($timeEntry)) {
                return Project::where('status', 'active');
            }
        }

        return $this->assignedProjectsQuery();
    }

    private function canUseProject(int $projectId): bool
    {
        if ($this->editingTimeEntryId) {
            $timeEntry = TimeEntryModel::find($this->editingTimeEntryId);

            if ($timeEntry && $this->canEditApprovedEntry($timeEntry)) {
                return Project::whereKey($projectId)->exists();
            }
        }

        return $this->assignedProjectsQuery()
            ->where('projects.id', $projectId)
            ->exists();
    }

    public function canEditTimeEntry(TimeEntryModel $timeEntry): bool
    {
        if (! auth()->user()->canWrite('time-entry')) {
            return false;
        }

        $user = auth()->user();
        $timeEntryUser = $this->timeEntryUser();

        if ($user->role === 'administrator') {
            return $timeEntry->user_id === $timeEntryUser->id;
        }

        if ($user->role === 'manager') {
            return ($timeEntry->status === 'approved' && $user->managesEmployee($timeEntry->user_id))
                || ($timeEntry->user_id === $timeEntryUser->id && $timeEntry->status !== 'approved');
        }

        return $timeEntry->user_id === $timeEntryUser->id && $timeEntry->status !== 'approved';
    }

    private function canEditApprovedEntry(TimeEntryModel $timeEntry): bool
    {
        $user = auth()->user();
        $timeEntryUser = $this->timeEntryUser();

        return ($user->role === 'administrator' && $timeEntry->user_id === $timeEntryUser->id)
            || (
                $user->role === 'manager'
                && $timeEntry->status === 'approved'
                && $user->managesEmployee($timeEntry->user_id)
            );
    }

    private function nextStatusForEdit(TimeEntryModel $timeEntry, string $requestedStatus): string
    {
        if ($timeEntry->status === 'approved' && $this->canEditApprovedEntry($timeEntry)) {
            return 'approved';
        }

        return $requestedStatus;
    }

    public function render()
    {
        $timeEntryUser = $this->timeEntryUser();
        $selectedYear = (int) ($this->yearFilter ?: now()->format('Y'));
        $selectedMonth = (int) ($this->monthFilter ?: now()->format('m'));
        $month = Carbon::create($selectedYear, $selectedMonth, 1);
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();

        $timeEntries = TimeEntryModel::with(['project', 'calendar'])
            ->where('user_id', $timeEntryUser->id)
            ->whereBetween('entry_date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->orderByDesc('entry_date')
            ->latest()
            ->get();

        $entriesByDate = $timeEntries->groupBy(fn ($timeEntry) => $timeEntry->entry_date->toDateString());
        $monthDays = collect();

        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $dateString = $date->toDateString();
            $dayEntries = $entriesByDate->get($dateString, collect());
            $calendar = $this->matchingCalendar($date);
            $statuses = $dayEntries->pluck('status')->unique()->values();

            $monthDays->push([
                'date' => $dateString,
                'date_label' => $date->format('d/m/Y'),
                'day_name' => $date->format('l'),
                'is_weekend' => $date->isWeekend(),
                'calendar' => $calendar,
                'entries' => $dayEntries,
                'hours' => $dayEntries->sum('hours'),
                'status' => $statuses->isEmpty()
                    ? 'empty'
                    : ($statuses->count() === 1 ? $statuses->first() : 'mixed'),
            ]);
        }

        return view('livewire.time-entry', [
            'assignedProjects' => $this->assignedProjectsQuery()
                ->orderBy('projects.name')
                ->get(),
            'canWriteTimeEntry' => auth()->user()->canWrite('time-entry'),
            'projectOptions' => $this->projectOptionsQuery()
                ->orderBy('projects.name')
                ->get(),
            'timeEntries' => $timeEntries,
            'monthDays' => $monthDays,
            'yearOptions' => $this->yearOptions(),
            'monthOptions' => $this->monthOptions(),
            'selectedMonthLabel' => $month->format('F Y'),
            'registeredHours' => $timeEntries->sum('hours'),
            'submittedHours' => $timeEntries->where('status', 'submitted')->sum('hours'),
            'approvedHours' => $timeEntries->where('status', 'approved')->sum('hours'),
            'draftHours' => $timeEntries->where('status', 'draft')->sum('hours'),
            'timeEntryUser' => $timeEntryUser,
        ]);
    }

    private function yearOptions(): array
    {
        $currentYear = (int) now()->format('Y');
        $entryYears = TimeEntryModel::where('user_id', $this->timeEntryUser()->id)
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

    private function timeEntryUser(): User
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

    private function monthOptions(): array
    {
        return collect(range(1, 12))
            ->map(fn ($month) => [
                'value' => str_pad((string) $month, 2, '0', STR_PAD_LEFT),
                'label' => Carbon::create(null, $month, 1)->format('F'),
            ])
            ->all();
    }
}
