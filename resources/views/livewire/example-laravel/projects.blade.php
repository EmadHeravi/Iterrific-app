<div>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">
                    <div class="row gx-4 align-items-center mb-3">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                                <i class="material-icons text-white">
                                    work
                                </i>
                            </div>
                        </div>

                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    Projects
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    Manage project setup, contacts, approvers and assigned users.
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal gray-light my-3">

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1">
                                Project Directory
                            </h6>
                            <p class="text-sm text-secondary mb-0">
                                {{ $projects->count() }} projects available.
                            </p>
                        </div>

                        @if($canWriteProjects)
                            <button
                                type="button"
                                wire:click="openProjectModal"
                                class="btn bg-gradient-warning dynamic-config-btn mb-0"
                            >
                                <i class="material-icons text-sm">
                                    add
                                </i>
                                &nbsp;&nbsp;Add Project
                            </button>
                        @endif
                    </div>

                    <div class="card-body px-0 pb-2 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Company
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Primary Contact
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Approval Manager
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Team
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Status
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($projects as $project)
                                        <tr>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $project->name }}
                                                    </h6>
                                                    @if($project->description)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ \Illuminate\Support\Str::limit($project->description, 60) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="px-3 py-2">
                                                    <p class="text-sm mb-0">
                                                        {{ $project->company_name }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="px-3 py-2">
                                                    <p class="text-sm mb-0">
                                                        {{ $project->primary_contact_name ?: '-' }}
                                                    </p>
                                                    @if($project->primary_contact_email)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $project->primary_contact_email }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="px-3 py-2">
                                                    <p class="text-sm mb-0">
                                                        {{ $project->approval_manager_name ?: '-' }}
                                                    </p>
                                                    @if($project->approval_manager_email)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $project->approval_manager_email }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <button
                                                    type="button"
                                                    class="btn btn-link text-warning dynamic-config-text px-2 mb-0"
                                                    wire:click="viewTeam({{ $project->id }})"
                                                >
                                                    {{ $project->users_count }}
                                                    {{ \Illuminate\Support\Str::plural('user', $project->users_count) }}
                                                </button>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm {{ $project->status === 'active' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                    {{ ucfirst($project->status) }}
                                                </span>
                                            </td>

                                            <td class="align-middle text-end pe-3">
                                                @if($canWriteProjects)
                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-warning dynamic-config-text px-2 mb-0"
                                                        wire:click="editProject({{ $project->id }})"
                                                    >
                                                        <i class="material-icons">
                                                            edit
                                                        </i>
                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-danger px-2 mb-0"
                                                        onclick="return confirm('Delete this project?')"
                                                        wire:click="deleteProject({{ $project->id }})"
                                                    >
                                                        <i class="material-icons">
                                                            delete
                                                        </i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <span class="text-secondary">
                                                    No projects found.
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

    @if($showProjectModal)
        <div
            wire:ignore.self
            class="modal fade show d-block"
            tabindex="-1"
            style="background: rgba(0,0,0,0.5);"
        >
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $isEditMode ? 'Edit Project' : 'Add Project' }}
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="closeProjectModal"
                        ></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    Project Name
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="tel"
                                        class="form-control @error('name') is-invalid @enderror"
                                        wire:model="name"
                                    >
                                </div>
                                @error('name')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    Company
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="tel"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        wire:model="company_name"
                                    >
                                </div>
                                @error('company_name')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-12 mt-2">
                                <h6 class="text-dark">
                                    Client Contacts
                                </h6>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Primary Contact Name
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="text"
                                        class="form-control @error('primary_contact_name') is-invalid @enderror"
                                        wire:model="primary_contact_name"
                                    >
                                </div>
                                @error('primary_contact_name')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Primary Contact Email
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="email"
                                        class="form-control @error('primary_contact_email') is-invalid @enderror"
                                        wire:model="primary_contact_email"
                                    >
                                </div>
                                @error('primary_contact_email')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Primary Contact Phone
                                </label>
                                <div wire:ignore>
                                    <input
                                        id="primary-contact-phone"
                                        data-project-phone-input
                                        data-phone-property="primary_contact_phone"
                                        type="text"
                                        class="form-control @error('primary_contact_phone') is-invalid @enderror"
                                        value="{{ $primary_contact_phone }}"
                                    >
                                </div>
                                @error('primary_contact_phone')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Approval Manager Name
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="text"
                                        class="form-control @error('approval_manager_name') is-invalid @enderror"
                                        wire:model="approval_manager_name"
                                    >
                                </div>
                                @error('approval_manager_name')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Approval Manager Email
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="email"
                                        class="form-control @error('approval_manager_email') is-invalid @enderror"
                                        wire:model="approval_manager_email"
                                    >
                                </div>
                                @error('approval_manager_email')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Approval Manager Phone
                                </label>
                                <div wire:ignore>
                                    <input
                                        id="approval-manager-phone"
                                        data-project-phone-input
                                        data-phone-property="approval_manager_phone"
                                        type="text"
                                        class="form-control @error('approval_manager_phone') is-invalid @enderror"
                                        value="{{ $approval_manager_phone }}"
                                    >
                                </div>
                                @error('approval_manager_phone')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Status
                                </label>
                                <div class="input-group input-group-outline">
                                    <select
                                        class="form-control @error('status') is-invalid @enderror"
                                        wire:model="status"
                                    >
                                        <option value="active">
                                            Active
                                        </option>
                                        <option value="inactive">
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label">
                                    Assigned Users
                                </label>
                                <div class="input-group input-group-outline mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search active users by first name, last name or email"
                                        wire:model.live.debounce.300ms="userSearch"
                                    >
                                </div>

                                @if(strlen(trim($userSearch)) > 0 && strlen(trim($userSearch)) < 2)
                                    <p class="text-xs text-secondary mb-3">
                                        Type at least 2 characters to search users.
                                    </p>
                                @endif

                                @if(strlen(trim($userSearch)) >= 2)
                                    <div class="border rounded-3 mb-3">
                                        @forelse($matchingUsers as $user)
                                            <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                                                <div>
                                                    <h6 class="text-sm mb-0">
                                                        {{ $user->full_name }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $user->email }}
                                                    </p>
                                                </div>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm bg-gradient-warning dynamic-config-btn mb-0"
                                                    wire:click="addAssignedUser({{ $user->id }})"
                                                >
                                                    Add
                                                </button>
                                            </div>
                                        @empty
                                            <p class="text-sm text-secondary mb-0 p-3">
                                                No users found.
                                            </p>
                                        @endforelse
                                    </div>
                                @endif

                                <div class="border rounded-3 p-3">
                                    <h6 class="text-sm mb-3">
                                        Selected Users
                                    </h6>
                                    @forelse($selectedUsers as $user)
                                        <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                                            <div>
                                                <h6 class="text-sm mb-0">
                                                    {{ $user->full_name }}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $user->email }}
                                                </p>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-link text-danger px-2 mb-0"
                                                wire:click="removeAssignedUser({{ $user->id }})"
                                            >
                                                Remove
                                            </button>
                                        </div>
                                    @empty
                                        <p class="text-sm text-secondary mb-0">
                                            No users selected yet.
                                        </p>
                                    @endforelse
                                </div>
                                @error('assignedUsers')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label">
                                    Description
                                </label>
                                <div class="input-group input-group-outline">
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="4"
                                        wire:model="description"
                                    ></textarea>
                                </div>
                                @error('description')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="closeProjectModal"
                        >
                            Cancel
                        </button>

                        <button
                            type="button"
                            class="btn bg-gradient-warning dynamic-config-btn"
                            wire:click="saveProject"
                        >
                            {{ $isEditMode ? 'Update Project' : 'Create Project' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showTeamModal && $teamProject)
        <div
            wire:ignore.self
            class="modal fade show d-block"
            tabindex="-1"
            style="background: rgba(0,0,0,0.5);"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $teamProject->name }} Team
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="closeTeamModal"
                        ></button>
                    </div>

                    <div class="modal-body">
                        @forelse($teamProject->users as $user)
                            @php
                                $roleBadgeClass = match ($user->role) {
                                    'administrator' => 'bg-gradient-danger',
                                    'manager' => 'bg-gradient-warning',
                                    'member' => 'bg-gradient-success',
                                    default => 'bg-gradient-dark',
                                };
                            @endphp
                            <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                                <div>
                                    <h6 class="text-sm mb-0">
                                        {{ $user->full_name }}
                                    </h6>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <span class="badge badge-sm {{ $roleBadgeClass }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-secondary mb-0">
                                No users are assigned to this project yet.
                            </p>
                        @endforelse
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="closeTeamModal"
                        >
                            Close
                        </button>

                        @if($canWriteProjects)
                            <button
                                type="button"
                                class="btn bg-gradient-warning dynamic-config-btn"
                                wire:click="editProject({{ $teamProject->id }})"
                            >
                                Manage Team
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
