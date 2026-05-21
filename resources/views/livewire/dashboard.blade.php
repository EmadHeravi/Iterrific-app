<div>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">
            <div class="row gx-4 align-items-center mb-3">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                        <i class="material-icons text-white">dashboard</i>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <h5 class="mb-1">Dashboard</h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ $monthLabel }} overview for {{ $user->full_name ?: $user->email }}.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 ms-sm-auto text-end mt-3 mt-sm-0">
                    @if($canReadTimeEntry)
                        <a href="{{ route('time-entry') }}" class="btn bg-gradient-warning dynamic-config-btn mb-0">
                            <i class="material-icons text-sm">schedule</i>
                            &nbsp;&nbsp;Time Entry
                        </a>
                    @endif
                </div>
            </div>

            <hr class="horizontal gray-light my-3">

            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">timer</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Registered Hours</p>
                                <h4 class="mb-0">{{ number_format((float) $ownRegisteredHours, 2) }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-sm">{{ $monthLabel }} personal total</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">outbox</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Submitted</p>
                                <h4 class="mb-0">{{ number_format((float) $ownSubmittedHours, 2) }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-sm">{{ number_format((float) $ownDraftHours, 2) }} draft hours</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">verified</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Approved</p>
                                <h4 class="mb-0">{{ number_format((float) $ownApprovedHours, 2) }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-sm">Approved personal hours</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">work</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Projects</p>
                                <h4 class="mb-0">{{ $assignedProjects->count() }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0 text-sm">{{ $user->role === 'administrator' ? 'Visible active projects' : 'Assigned to you' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @if($canReadApprovals)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Approvals</h6>
                                        <p class="text-sm mb-0">Items waiting for review this month.</p>
                                    </div>
                                    <a href="{{ route('approvals') }}" class="btn btn-outline-warning btn-sm mb-0">Open</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-sm text-secondary">Pending entries</span>
                                    <strong>{{ $pendingApprovalCount }}</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-sm text-secondary">Pending hours</span>
                                    <strong>{{ number_format((float) $pendingApprovalHours, 2) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-sm text-secondary">Approved team hours</span>
                                    <strong>{{ number_format((float) $teamApprovedHours, 2) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2">
                                    <span class="text-sm text-secondary">Declined entries</span>
                                    <strong>{{ $teamDeclinedCount }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($canReadBilling && $billingSummary)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="mb-1">Billing</h6>
                                        <p class="text-sm mb-0">{{ $billingSummary['label'] }} for {{ $monthLabel }}.</p>
                                    </div>
                                    <a href="{{ route('billing') }}" class="btn btn-outline-warning btn-sm mb-0">Open</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-sm text-secondary">Approved hours</span>
                                    <strong>{{ number_format((float) $billingSummary['hours'], 2) }}</strong>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom">
                                    <span class="text-sm text-secondary">Exclusive VAT</span>
                                    <strong>{{ $billingSummary['currency'] }} {{ number_format((float) $billingSummary['exclusiveVat'], 2) }}</strong>
                                </div>
                                @if(isset($billingSummary['inclusiveVat']))
                                    <div class="d-flex justify-content-between py-2">
                                        <span class="text-sm text-secondary">Inclusive VAT</span>
                                        <strong>{{ $billingSummary['currency'] }} {{ number_format((float) $billingSummary['inclusiveVat'], 2) }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6 class="mb-1">Quick Access</h6>
                            <p class="text-sm mb-0">Available actions based on your permissions.</p>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                @if($canReadTimeEntry)
                                    <a href="{{ route('time-entry') }}" class="btn btn-outline-secondary text-start mb-0">
                                        <i class="material-icons text-sm me-2">schedule</i> Time Entry
                                    </a>
                                @endif
                                @if($canReadApprovals)
                                    <a href="{{ route('approvals') }}" class="btn btn-outline-secondary text-start mb-0">
                                        <i class="material-icons text-sm me-2">fact_check</i> Approvals
                                    </a>
                                @endif
                                @if($canReadProjects)
                                    <a href="{{ route('projects') }}" class="btn btn-outline-secondary text-start mb-0">
                                        <i class="material-icons text-sm me-2">work</i> Projects
                                    </a>
                                @endif
                                @if($canReadUserManagement)
                                    <a href="{{ route('user-management') }}" class="btn btn-outline-secondary text-start mb-0">
                                        <i class="material-icons text-sm me-2">manage_accounts</i> User Management
                                    </a>
                                @endif
                                @if($canReadCalendars)
                                    <a href="{{ route('calendars') }}" class="btn btn-outline-secondary text-start mb-0">
                                        <i class="material-icons text-sm me-2">event</i> Calendars
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6 class="mb-1">Recent Time Entries</h6>
                            <p class="text-sm mb-0">Your latest registered hours.</p>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Project</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hours</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentEntries as $entry)
                                            <tr>
                                                <td class="ps-4">
                                                    <span class="text-sm font-weight-bold">{{ $entry->entry_date->format('d/m/Y') }}</span>
                                                    <p class="text-xs text-secondary mb-0">{{ $entry->entry_date->format('l') }}</p>
                                                </td>
                                                <td>
                                                    <span class="text-sm">{{ $entry->project?->name ?? 'Project removed' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-sm font-weight-bold">{{ number_format((float) $entry->hours, 2) }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge badge-sm bg-gradient-{{ $entry->status === 'approved' ? 'success' : ($entry->status === 'submitted' ? 'info' : ($entry->status === 'declined' ? 'danger' : 'secondary')) }}">
                                                        {{ ucfirst($entry->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-secondary text-sm">No time entries yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6 class="mb-1">Projects</h6>
                            <p class="text-sm mb-0">{{ $user->role === 'administrator' ? 'Active project snapshot.' : 'Projects assigned to your account.' }}</p>
                        </div>
                        <div class="card-body">
                            @forelse($assignedProjects as $project)
                                <div class="d-flex justify-content-between align-items-start py-2 border-bottom">
                                    <div>
                                        <h6 class="text-sm mb-0">{{ $project->name }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ $project->company_name ?: 'No company set' }}</p>
                                    </div>
                                    <span class="badge badge-sm bg-gradient-{{ $project->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($project->status ?? 'active') }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-sm text-secondary mb-0">No projects to show.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
