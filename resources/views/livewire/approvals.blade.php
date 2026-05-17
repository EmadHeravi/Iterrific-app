<div>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card approvals-card">
                    <div class="row gx-4 align-items-center mb-3">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                                <i class="material-icons text-white">
                                    fact_check
                                </i>
                            </div>
                        </div>

                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    Approvals
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    Review submitted hours and resolve employee time entries.
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal gray-light my-3">

                    @if($pendingCount > 0)
                        <div class="alert alert-warning text-white d-flex align-items-center gap-2" role="alert">
                            <i class="material-icons">notifications_active</i>
                            <span>
                                {{ $pendingCount }} time {{ $pendingCount === 1 ? 'entry needs' : 'entries need' }} approval,
                                totaling {{ number_format($pendingHours, 2) }} hours for {{ $selectedMonthLabel }}.
                            </span>
                        </div>
                    @else
                        <div class="alert alert-success text-white d-flex align-items-center gap-2" role="alert">
                            <i class="material-icons">check_circle</i>
                            <span>
                                No employee hours are waiting for approval for {{ $selectedMonthLabel }}.
                            </span>
                        </div>
                    @endif

                    @if($isManagerWithoutAssignments)
                        <div class="alert alert-light border text-dark text-sm" role="alert">
                            You are a manager, but no employees are assigned to you yet. Ask an administrator to assign employees in User Management.
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-4 col-12 mb-3 mb-md-0">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Needs Approval</p>
                                <h5 class="mb-0">{{ $pendingCount }}</h5>
                                <p class="text-xs text-secondary mb-0">{{ number_format($pendingHours, 2) }} hours</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Approved</p>
                                <h5 class="mb-0">{{ $approvedCount }}</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="time-entry-summary-box h-100">
                                <p class="text-sm mb-0 text-secondary">Declined</p>
                                <h5 class="mb-0">{{ $declinedCount }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="approvals-filter-panel mb-4">
                        <div class="row align-items-end">
                            <div class="col-xl-4 col-lg-5 col-md-6 mb-3">
                                <label class="form-label text-xs text-uppercase font-weight-bolder mb-1">
                                    Employee
                                </label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control" wire:model.live="employeeFilter">
                                        <option value="">All employees</option>
                                        @foreach($employeeOptions as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-3 col-md-3 col-6 mb-3">
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

                            <div class="col-xl-2 col-lg-3 col-md-3 col-6 mb-3">
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

                            <div class="col-xl-2 col-lg-3 col-md-4 mb-3">
                                <label class="form-label text-xs text-uppercase font-weight-bolder mb-1">
                                    Status
                                </label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control" wire:model.live="statusFilter">
                                        <option value="all">All</option>
                                        <option value="submitted">Needs Approval</option>
                                        <option value="approved">Approved</option>
                                        <option value="declined">Declined</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-3 col-md-4 mb-3">
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary mb-0 w-100"
                                    wire:click="clearFilters"
                                >
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1">
                                Employee Hours
                            </h6>
                            <p class="text-sm text-secondary mb-0">
                                Showing {{ $timeEntries->count() }} matching entries for {{ $selectedMonthLabel }}.
                            </p>
                        </div>

                        @if($employeeFilter)
                            <a
                                href="{{ route('approvals.export', ['employee_id' => $employeeFilter, 'year' => $yearFilter, 'month' => (int) $monthFilter]) }}"
                                class="btn bg-gradient-warning dynamic-config-btn mb-0"
                            >
                                <i class="material-icons text-sm">picture_as_pdf</i>
                                &nbsp;&nbsp;Export Employee PDF
                            </a>
                        @else
                            <button type="button" class="btn btn-outline-secondary mb-0" disabled>
                                Select employee to export PDF
                            </button>
                        @endif
                    </div>

                    <div class="card-body px-0 pb-2 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 approvals-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employee
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Hours
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Status
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($timeEntries as $timeEntry)
                                        <tr>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="text-sm mb-0">
                                                        {{ $timeEntry->user->first_name }} {{ $timeEntry->user->last_name }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $timeEntry->user->email }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="text-sm mb-0">
                                                        {{ $timeEntry->entry_date->format('d/m/Y') }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $timeEntry->entry_date->format('l') }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="text-sm mb-0">
                                                        {{ $timeEntry->project->name }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $timeEntry->project->company_name }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2 approval-description">
                                                    <p class="text-sm mb-0">
                                                        {{ $timeEntry->description ?: '-' }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ number_format($timeEntry->hours, 2) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass = match ($timeEntry->status) {
                                                        'approved' => 'bg-gradient-success',
                                                        'declined' => 'bg-gradient-danger',
                                                        'submitted' => 'bg-gradient-info',
                                                        default => 'bg-gradient-secondary',
                                                    };
                                                @endphp
                                                <span class="badge badge-sm {{ $statusClass }}">
                                                    {{ $timeEntry->status === 'submitted' ? 'Needs Approval' : ucfirst($timeEntry->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                @if($canWriteApprovals && $timeEntry->status === 'submitted')
                                                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                                                        <button
                                                            type="button"
                                                            class="btn bg-gradient-success btn-sm mb-0"
                                                            wire:click="approveEntry({{ $timeEntry->id }})"
                                                        >
                                                            Approve
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-outline-danger btn-sm mb-0"
                                                            wire:click="declineEntry({{ $timeEntry->id }})"
                                                        >
                                                            Decline
                                                        </button>
                                                    </div>
                                                @elseif($timeEntry->reviewer)
                                                    <p class="text-xs text-secondary text-end mb-0">
                                                        Reviewed by {{ $timeEntry->reviewer->first_name }} {{ $timeEntry->reviewer->last_name }}
                                                    </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <span class="text-secondary">
                                                    No matching employee hours found.
                                                </span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
