<div>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body mx-1 mx-md-2 mt-n6 user-management-card time-entry-card">
                    <div class="row gx-4 align-items-center mb-3">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                                <i class="material-icons text-white">
                                    schedule
                                </i>
                            </div>
                        </div>

                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    Time Entry
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    Register and review hours for each day of the selected month.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-end gap-3">
                                <div class="time-entry-filter-control">
                                    <label class="form-label text-xs text-uppercase font-weight-bolder mb-1">
                                        Year
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <select class="form-control" wire:model.live="yearFilter">
                                            @foreach($yearOptions as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="time-entry-filter-control">
                                    <label class="form-label text-xs text-uppercase font-weight-bolder mb-1">
                                        Month
                                    </label>
                                    <div class="input-group input-group-outline">
                                        <select class="form-control" wire:model.live="monthFilter">
                                            @foreach($monthOptions as $month)
                                                <option value="{{ $month['value'] }}">
                                                    {{ $month['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <a
                                    href="{{ route('time-entry.export', ['year' => $yearFilter, 'month' => (int) $monthFilter]) }}"
                                    target="_blank"
                                    class="btn bg-gradient-warning dynamic-config-btn mb-0"
                                >
                                    <i class="material-icons text-sm">
                                        picture_as_pdf
                                    </i>
                                    &nbsp;&nbsp;Export PDF
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal gray-light my-3">

                    <div class="row mb-4">
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Registered</p>
                                <h5 class="mb-0">{{ number_format($registeredHours, 2) }}</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Submitted</p>
                                <h5 class="mb-0">{{ number_format($submittedHours, 2) }}</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Approved</p>
                                <h5 class="mb-0">{{ number_format($approvedHours, 2) }}</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Draft</p>
                                <h5 class="mb-0">{{ number_format($draftHours, 2) }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1">
                                Month Overview
                            </h6>
                            <p class="text-sm text-secondary mb-0">
                                {{ $selectedMonthLabel }} overview. Select a day and register hours directly in that row.
                            </p>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 time-entry-month-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Day
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Type
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Registered Entries
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Hours
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Status
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Entry
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($monthDays as $day)
                                        @php
                                            $isSelected = $selectedDate === $day['date'];
                                        @endphp
                                        <tr class="{{ $isSelected ? 'bg-gray-100' : '' }}">
                                            <td>
                                                <button
                                                    type="button"
                                                    class="btn btn-link text-dark text-start px-3 py-2 mb-0"
                                                    wire:click="selectDate('{{ $day['date'] }}')"
                                                >
                                                    <h6 class="text-sm mb-0">{{ $day['date_label'] }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $day['day_name'] }}</p>
                                                </button>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($day['calendar'])
                                                    <span class="badge badge-sm bg-gradient-danger">
                                                        {{ $day['calendar']->holiday_name }}
                                                    </span>
                                                @elseif($day['is_weekend'])
                                                    <span class="badge badge-sm bg-gradient-warning">
                                                        Weekend
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        Workday
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="px-3 py-2 time-entry-project-stack">
                                                    @forelse($day['entries']->pluck('project.name')->filter()->unique() as $projectName)
                                                        <span class="badge badge-sm bg-gradient-light text-dark">
                                                            {{ $projectName }}
                                                        </span>
                                                    @empty
                                                        <span class="text-xs text-secondary">
                                                            -
                                                        </span>
                                                    @endforelse
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    @forelse($day['entries'] as $timeEntry)
                                                        <div class="mb-2">
                                                            <h6 class="text-sm mb-0">
                                                                {{ $timeEntry->project->name }}
                                                            </h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ number_format($timeEntry->hours, 2) }} hours - {{ ucfirst($timeEntry->status) }}
                                                            </p>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $timeEntry->description }}
                                                            </p>
                                                        </div>
                                                    @empty
                                                        <span class="text-xs text-secondary">
                                                            No entry
                                                        </span>
                                                    @endforelse
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ number_format($day['hours'], 2) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $dayStatusClass = match ($day['status']) {
                                                        'approved' => 'bg-gradient-success',
                                                        'submitted' => 'bg-gradient-info',
                                                        'declined' => 'bg-gradient-danger',
                                                        'draft' => 'bg-gradient-secondary',
                                                        'mixed' => 'bg-gradient-warning',
                                                        default => 'bg-gradient-light text-dark',
                                                    };

                                                    $dayStatusLabel = $day['status'] === 'empty'
                                                        ? 'No Entry'
                                                        : ucfirst($day['status']);
                                                @endphp
                                                <span class="badge badge-sm {{ $dayStatusClass }}">
                                                    {{ $dayStatusLabel }}
                                                </span>
                                            </td>
                                            <td class="time-entry-inline-cell">
                                                <div class="d-flex flex-column align-items-start gap-2">
                                                    @foreach($day['entries'] as $timeEntry)
                                                        @if($this->canEditTimeEntry($timeEntry))
                                                            <button
                                                                type="button"
                                                                class="btn btn-outline-secondary btn-sm mb-0"
                                                                wire:click="editTimeEntry({{ $timeEntry->id }})"
                                                            >
                                                                <i class="material-icons text-sm">edit</i>
                                                                &nbsp;&nbsp;Edit {{ $timeEntry->project->name }}
                                                            </button>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-light text-dark">
                                                                Locked
                                                            </span>
                                                        @endif
                                                    @endforeach

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary btn-sm mb-0"
                                                        wire:click="selectDate('{{ $day['date'] }}')"
                                                    >
                                                        Add Hours
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @if($isSelected)
                                            <tr class="time-entry-form-row">
                                                <td colspan="7">
                                                    <div class="time-entry-editor p-3">
                                                        @if($editingTimeEntryId)
                                                            <div class="alert alert-light border text-dark text-sm mb-3" role="alert">
                                                                Editing existing entry. Approved entries stay approved when a manager or administrator updates them.
                                                            </div>
                                                        @endif

                                                        <div class="row">
                                                            <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                                                                <label class="form-label">Project *</label>
                                                                <div class="input-group input-group-outline">
                                                                    <select class="form-control @error('project_id') is-invalid @enderror" wire:model="project_id">
                                                                        <option value="">Select project</option>
                                                                        @foreach($projectOptions as $project)
                                                                            <option value="{{ $project->id }}">
                                                                                {{ $project->name }} - {{ $project->company_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('project_id')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                                            </div>

                                                            <div class="col-xl-2 col-lg-2 col-md-3 mb-3">
                                                                <label class="form-label">Hours *</label>
                                                                <div class="input-group input-group-outline">
                                                                    <input type="number" step="0.25" min="0.25" max="24" class="form-control @error('hours') is-invalid @enderror" wire:model="hours">
                                                                </div>
                                                                @error('hours')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                                            </div>

                                                            <div class="col-xl-7 col-lg-6 col-md-12 mb-3">
                                                                <label class="form-label">Work Description</label>
                                                                <div class="input-group input-group-outline">
                                                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="2" wire:model="description"></textarea>
                                                                </div>
                                                                @error('description')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-wrap justify-content-end gap-2">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm mb-0" wire:click="cancelEdit">
                                                                Cancel
                                                            </button>
                                                            @if($editingOriginalStatus !== 'approved')
                                                                <button type="button" class="btn btn-outline-secondary btn-sm mb-0" wire:click="saveDraft">
                                                                    {{ $editingTimeEntryId ? 'Update Draft' : 'Save Draft' }}
                                                                </button>
                                                            @endif
                                                            <button type="button" class="btn bg-gradient-warning dynamic-config-btn btn-sm mb-0" wire:click="submitHours">
                                                                @if($editingOriginalStatus === 'approved')
                                                                    Update Approved Entry
                                                                @else
                                                                    {{ $editingTimeEntryId ? 'Update & Submit' : 'Submit Hours' }}
                                                                @endif
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
