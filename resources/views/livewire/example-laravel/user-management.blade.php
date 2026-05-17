<div>

    <div class="container-fluid px-2 px-md-4">

        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1920&q=80'); background-position: center;">
            <span class="mask bg-gradient-warning opacity-4 dynamic-config-gradient"></span>
        </div>

        <div class="row">

            <div class="col-12">

                <div class="card card-body mx-3 mx-md-4 mt-n6 user-management-card">

                    {{-- HEADER --}}
                    <div class="row gx-4 align-items-center mb-3">

                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative bg-gradient-warning shadow-warning dynamic-config-gradient dynamic-config-shadow border-radius-lg d-flex align-items-center justify-content-center">
                                <i class="material-icons text-white">
                                    group
                                </i>
                            </div>
                        </div>

                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    User Management
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    Manage accounts, roles and profile details.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link mb-0 px-0 py-1 {{ $activeTab === 'accounts' ? 'active' : '' }}"
                                            href="javascript:;"
                                            role="tab"
                                            wire:click="showAccountsTab"
                                        >
                                            <i class="material-icons text-lg position-relative">
                                                manage_accounts
                                            </i>
                                            <span class="ms-1">
                                                Accounts
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            class="nav-link mb-0 px-0 py-1 {{ $activeTab === 'roles' ? 'active' : '' }}"
                                            href="javascript:;"
                                            role="tab"
                                            wire:click="showRolesTab"
                                        >
                                            <i class="material-icons text-lg position-relative">
                                                admin_panel_settings
                                            </i>
                                            <span class="ms-1">
                                                Roles
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <hr class="horizontal gray-light my-3">

                    @if($activeTab === 'accounts')

                    @error('delete_user')
                        <div class="alert alert-danger text-white text-sm" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

                        <div>
                            <h6 class="mb-1">
                                User Management
                            </h6>
                            <p class="text-sm text-secondary mb-0">
                                {{ $users->count() }} users available.
                            </p>
                        </div>

                        @if($canWriteUserManagement)
                            <button
                                wire:click="openUserModal"
                                class="btn bg-gradient-warning dynamic-config-btn mb-0"
                            >

                                <i class="material-icons text-sm">
                                    add
                                </i>

                                &nbsp;&nbsp;Add New User

                            </button>
                        @endif

                    </div>

                    <div class="user-management-filters mt-3">
                        <div class="row g-3">
                            <div class="col-md-4 col-lg-3">
                                <label class="form-label text-xs text-secondary mb-1">
                                    Role
                                </label>
                                <select class="form-control border" wire:model.live="roleFilter">
                                    <option value="">All roles</option>
                                    @foreach($roleOptions as $roleOption)
                                        <option value="{{ $roleOption->slug }}">
                                            {{ $roleOption->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 col-lg-3">
                                <label class="form-label text-xs text-secondary mb-1">
                                    Type
                                </label>
                                <select class="form-control border" wire:model.live="typeFilter">
                                    <option value="">All types</option>
                                    <option value="internal">Internal</option>
                                    <option value="external">External</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- TABLE --}}
                    <div class="card-body px-0 pb-2 pt-3">

                        <div class="table-responsive p-0">

                            <table class="table align-items-center mb-0">

                                <thead>

                                    <tr>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NAME
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            EMAIL
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            ROLE
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            TYPE
                                        </th>

                                        @if($canManageHourlyFee)
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">
                                                HOURLY FEE
                                            </th>
                                        @endif

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            COMPANY
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">
                                            VAT %
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            EMPLOYEE ID
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            PHONE
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            CREATED
                                        </th>

                                        <th class="text-secondary opacity-7"></th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($users as $user)

                                        <tr>

                                            {{-- ID --}}
                                            <td>

                                                <div class="px-3 py-2">

                                                    <p class="text-sm mb-0">
                                                        {{ $user->id }}
                                                    </p>

                                                </div>

                                            </td>

                                            {{-- NAME --}}
                                            <td>

                                                <div class="d-flex px-3 py-2">

                                                    <div class="d-flex flex-column justify-content-center">

                                                        <h6 class="mb-0 text-sm">

                                                            {{ $user->first_name }}
                                                            {{ $user->last_name }}

                                                        </h6>

                                                    </div>

                                                </div>

                                            </td>

                                            {{-- EMAIL --}}
                                            <td>

                                                <div class="px-3 py-2">

                                                    <p class="text-sm mb-0">
                                                        {{ $user->email }}
                                                    </p>

                                                </div>

                                            </td>

                                            {{-- ROLE --}}
                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $roleBadgeClass = match ($user->role) {
                                                        'administrator' => 'bg-gradient-danger',
                                                        'manager' => 'bg-gradient-warning',
                                                        'member' => 'bg-gradient-success',
                                                        default => 'bg-gradient-dark',
                                                    };
                                                @endphp

                                                <span class="badge badge-sm {{ $roleBadgeClass }}">

                                                    {{ ucfirst($user->role) }}

                                                </span>

                                            </td>

                                            {{-- USER TYPE --}}
                                            <td class="align-middle text-center text-sm">
                                                @php
                                                    $userTypeBadgeClass = $user->user_type === 'internal'
                                                        ? 'bg-gradient-success'
                                                        : 'bg-gradient-secondary';
                                                @endphp

                                                <span class="badge badge-sm {{ $userTypeBadgeClass }}">

                                                    {{ ucfirst($user->user_type) }}

                                                </span>

                                            </td>

                                            @if($canManageHourlyFee)
                                                {{-- HOURLY FEE --}}
                                                <td class="align-middle text-end">
                                                    @if($user->user_type === 'external')
                                                        <span class="text-sm font-weight-bold">
                                                            {{ $user->hourly_fee_currency ?: 'EUR' }} {{ number_format((float) $user->hourly_fee, 2) }}
                                                        </span>
                                                    @else
                                                        <span class="text-sm text-secondary">-</span>
                                                    @endif
                                                </td>
                                            @endif

                                            {{-- COMPANY --}}
                                            <td>

                                                <div class="px-3 py-2">

                                                    <p class="text-sm mb-0">

                                                        {{ $user->company_name ?? '-' }}

                                                    </p>

                                                </div>

                                            </td>

                                            {{-- VAT RATE --}}
                                            <td class="align-middle text-end">
                                                <span class="text-sm font-weight-bold">
                                                    {{ number_format((float) ($user->vat_rate ?? 21), 2) }}%
                                                </span>
                                            </td>

                                            {{-- EMPLOYEE ID --}}
                                            <td>

                                                <div class="px-3 py-2">

                                                    <p class="text-sm mb-0">

                                                        {{ $user->employee_id ?? '-' }}

                                                    </p>

                                                </div>

                                            </td>

                                            {{-- PHONE --}}
                                            <td>

                                                <div class="px-3 py-2">

                                                    <p class="text-sm mb-0">

                                                        {{ $user->phone_country_code ?? '' }}
                                                        {{ $user->phone_number ?? '-' }}

                                                    </p>

                                                </div>

                                            </td>

                                            {{-- CREATED --}}
                                            <td class="align-middle text-center">

                                                <span class="text-secondary text-xs font-weight-bold">

                                                    {{ $user->created_at->format('d/m/Y') }}

                                                </span>

                                            </td>

                                            {{-- ACTIONS --}}
                                            <td class="align-middle">

                                                @if($canWriteUserManagement)
                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-warning dynamic-config-text px-2 mb-0"
                                                        wire:click="editUser({{ $user->id }})"
                                                    >

                                                        <i class="material-icons">
                                                            edit
                                                        </i>

                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-danger px-2 mb-0"
                                                        wire:click="deleteUser({{ $user->id }})"
                                                        wire:confirm="Are you sure you want to delete this user?"
                                                        @if($user->id === auth()->id()) disabled @endif
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

                                            <td colspan="{{ $canManageHourlyFee ? 12 : 11 }}" class="text-center py-4">

                                                <span class="text-secondary">
                                                    No users found.
                                                </span>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                    @else

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

                        <div>
                            <h6 class="mb-1">
                                Role Permissions
                            </h6>
                            <p class="text-sm text-secondary mb-0">
                                Define read and write access for each app section.
                            </p>
                        </div>

                        @if($canWriteUserManagement)
                            <button
                                wire:click="openRoleModal"
                                class="btn bg-gradient-warning dynamic-config-btn mb-0"
                            >
                                <i class="material-icons text-sm">
                                    add
                                </i>
                                &nbsp;&nbsp;Add Role
                            </button>
                        @endif

                    </div>

                    <div class="card-body px-0 pb-2 pt-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Users
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Permissions
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                        <tr>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <h6 class="text-sm mb-0">
                                                        {{ $role->name }}
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $role->slug }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <p class="text-sm mb-0">
                                                        {{ $role->users_count }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="px-3 py-2">
                                                    <p class="text-sm mb-0">
                                                        {{ $role->permissions->where('can_read', true)->count() }} read /
                                                        {{ $role->permissions->where('can_write', true)->count() }} write
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-end pe-3">
                                                @if($canWriteUserManagement)
                                                    <button
                                                        type="button"
                                                        class="btn btn-link text-warning dynamic-config-text px-2 mb-0"
                                                        wire:click="editRole({{ $role->id }})"
                                                    >
                                                        <i class="material-icons">
                                                            edit
                                                        </i>
                                                    </button>

                                                    @if(! $role->is_system && $role->users_count === 0)
                                                        <button
                                                            type="button"
                                                            class="btn btn-link text-danger px-2 mb-0"
                                                            wire:click="deleteRole({{ $role->id }})"
                                                        >
                                                            <i class="material-icons">
                                                                delete
                                                            </i>
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <span class="text-secondary">
                                                    No roles found.
                                                </span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- CREATE USER MODAL --}}
    @if($showUserModal)

        <div
            wire:ignore.self
            class="modal fade show d-block"
            tabindex="-1"
            style="background: rgba(0,0,0,0.5);"
        >

            <div class="modal-dialog modal-xl">

                <div class="modal-content">

                    {{-- HEADER --}}
                    <div class="modal-header">

                        <h5 class="modal-title">
                            {{ $isEditMode ? 'Edit User' : 'Add New User' }}
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="closeUserModal"
                        ></button>

                    </div>

                    {{-- BODY --}}
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-12 mb-3" style="order: 1;">
                                <h6 class="user-modal-section-title">
                                    Personal Information
                                </h6>
                            </div>

                            {{-- FIRST NAME --}}
                            <div class="col-md-6 mb-4" style="order: 10;">

                                <label class="form-label">
                                    First Name
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        wire:model="first_name"
                                    >

                                </div>

                                @error('first_name')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- LAST NAME --}}
                            <div class="col-md-6 mb-4" style="order: 11;">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        wire:model="last_name"
                                    >

                                </div>

                                @error('last_name')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-4" style="order: 12;">

                                <label class="form-label">
                                    Email
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        wire:model="email"
                                    >

                                </div>

                                @error('email')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-md-6 mb-4" style="order: 13;">

                                <label class="form-label">
                                    Password
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        wire:model="password"
                                    >

                                </div>

                                @error('password')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- ROLE --}}
                            <div class="col-md-6 mb-4" style="order: 51;">

                                <label class="form-label">
                                    Role
                                </label>

                                <div class="input-group input-group-outline">

                                    <select
                                        class="form-control @error('role') is-invalid @enderror"
                                        wire:model.live="role"
                                        wire:change="$set('role', $event.target.value)"
                                    >

                                        @foreach($roleOptions as $roleOption)
                                            <option value="{{ $roleOption->slug }}">
                                                {{ $roleOption->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                @error('role')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            @if($role === 'manager')
                                <div class="col-12 mb-4" style="order: 52;" wire:key="manager-assigned-employees">
                                    <h6 class="text-dark mb-2">
                                        Assigned Employees
                                    </h6>
                                    <p class="text-sm text-secondary mb-3">
                                        Select which employees this manager can review and manage hours for.
                                    </p>

                                    <div class="manager-assignment-control">
                                        <div class="input-group input-group-outline mb-3">
                                            <input
                                                type="search"
                                                class="form-control"
                                                placeholder="Search employee by name, email or employee ID"
                                                wire:model.live.debounce.250ms="employeeSearch"
                                            >
                                        </div>

                                        <div class="manager-assignment-selected mb-3">
                                            @forelse($selectedAssignedEmployees as $employee)
                                                <span class="manager-assignment-chip">
                                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                                    <button
                                                        type="button"
                                                        wire:click="removeAssignedEmployee({{ $employee->id }})"
                                                        aria-label="Remove {{ $employee->first_name }} {{ $employee->last_name }}"
                                                    >
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </span>
                                            @empty
                                                <span class="text-sm text-secondary">
                                                    No employees assigned yet.
                                                </span>
                                            @endforelse
                                        </div>

                                        <div class="manager-assignment-dropdown">
                                            @forelse($assignableEmployees as $employee)
                                                <button
                                                    type="button"
                                                    class="manager-assignment-option"
                                                    wire:click="addAssignedEmployee({{ $employee->id }})"
                                                >
                                                    <span>
                                                        <strong>
                                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                                        </strong>
                                                        <small>
                                                            {{ $employee->email }} - {{ ucfirst($employee->role) }}
                                                        </small>
                                                    </span>
                                                    <i class="material-icons">add</i>
                                                </button>
                                            @empty
                                                <div class="manager-assignment-empty">
                                                    No matching employees.
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                    @error('assigned_employee_ids')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            @endif

                            {{-- USER TYPE --}}
                            <div class="col-md-6 mb-4" style="order: 53;">

                                <label class="form-label">
                                    User Type
                                </label>

                                <div class="input-group input-group-outline">

                                    <select
                                        class="form-control @error('user_type') is-invalid @enderror"
                                        wire:model="user_type"
                                    >

                                        <option value="internal">
                                            Internal
                                        </option>

                                        <option value="external">
                                            External
                                        </option>

                                    </select>

                                </div>

                                @error('user_type')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            @if($canManageHourlyFee && $user_type === 'external')
                                {{-- HOURLY FEE --}}
                                <div class="col-md-6 mb-4" style="order: 54;">

                                    <label class="form-label">
                                        Hourly Fee
                                    </label>

                                    <div class="user-hourly-fee-field">
                                        <select
                                            class="user-hourly-fee-currency"
                                            wire:model="hourly_fee_currency"
                                            aria-label="Hourly fee currency"
                                        >
                                            <option value="EUR">EUR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            class="form-control @error('hourly_fee') is-invalid @enderror"
                                            wire:model="hourly_fee"
                                        >
                                    </div>

                                    <small class="text-secondary d-block mt-1">
                                        Visible and editable only for administrators.
                                    </small>

                                    @error('hourly_fee')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                    @error('hourly_fee_currency')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>
                            @endif

                            {{-- EMPLOYEE ID --}}
                            <div class="col-md-6 mb-4" style="order: 55;">

                                <label class="form-label">
                                    Employee ID
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('employee_id') is-invalid @enderror"
                                        wire:model="employee_id"
                                    >

                                </div>

                                @error('employee_id')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- COMPANY --}}
                            <div class="col-md-3 mb-4" style="order: 31;">

                                <label class="form-label">
                                    Company Name
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
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

                            {{-- CHAMBER --}}
                            <div class="col-md-3 mb-4" style="order: 32;">

                                <label class="form-label">
                                    Chamber of Commerce Number
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('company_registration_number') is-invalid @enderror"
                                        wire:model="company_registration_number"
                                    >

                                </div>

                                @error('company_registration_number')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- VAT --}}
                            <div class="col-md-3 mb-4" style="order: 33;">

                                <label class="form-label">
                                    VAT Number
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="vat_number"
                                    >

                                </div>

                            </div>

                            {{-- VAT RATE --}}
                            <div class="col-md-3 mb-4" style="order: 33;">

                                <label class="form-label">
                                    VAT Rate (%)
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        step="0.01"
                                        class="form-control @error('vat_rate') is-invalid @enderror"
                                        wire:model="vat_rate"
                                    >

                                </div>

                                @error('vat_rate')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- PHONE --}}
                            <div class="col-md-6 col-lg-5 mb-4" style="order: 21;">

                                <label class="form-label">
                                    Phone Number
                                </label>

                                <div wire:ignore>

                                    <input
                                        id="phone"
                                        type="tel"
                                        class="form-control"
                                        value="{{ $phone_number }}"
                                    >

                                </div>

                                @error('phone_number')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                                @error('phone_country_code')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            <div class="w-100" style="order: 21;"></div>


                            {{-- PERSONAL ADDRESS --}}
                            <div class="col-md-5 mb-4" style="order: 22;">

                                <label class="form-label">
                                    Address
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('personal_address') is-invalid @enderror"
                                        wire:model="personal_address"
                                    >

                                </div>

                                @error('personal_address')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- PERSONAL POSTAL --}}
                            <div class="col-md-2 mb-4" style="order: 23;">

                                <label class="form-label">
                                    Postal Code
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('personal_postal_code') is-invalid @enderror"
                                        wire:model="personal_postal_code"
                                    >

                                </div>

                                @error('personal_postal_code')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- PERSONAL CITY --}}
                            <div class="col-md-3 mb-4" style="order: 24;">

                                <label class="form-label">
                                    City
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('personal_city') is-invalid @enderror"
                                        wire:model="personal_city"
                                    >

                                </div>

                                @error('personal_city')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- PERSONAL COUNTRY --}}
                            <div class="col-md-2 mb-4" style="order: 25;">

                                <label class="form-label">
                                    Country
                                </label>

                                <div class="input-group input-group-outline" wire:ignore>

                                    <select
                                        class="form-control @error('personal_country') is-invalid @enderror"
                                        data-user-country-select
                                        data-country-target="personal_country"
                                        data-current-country="{{ $personal_country ?: 'Netherlands' }}"
                                    ></select>

                                </div>

                                @error('personal_country')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            <div class="w-100" style="order: 33;"></div>


                            {{-- BUSINESS ADDRESS TITLE --}}
                            <div class="col-12 mt-3" style="order: 30;">

                                <h6 class="user-modal-section-title">
                                    Business Information
                                </h6>

                            </div>

                            {{-- BUSINESS ADDRESS --}}
                            <div class="col-md-5 mb-4" style="order: 34;">

                                <label class="form-label">
                                    Address
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('business_address') is-invalid @enderror"
                                        wire:model="business_address"
                                    >

                                </div>

                                @error('business_address')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- BUSINESS POSTAL --}}
                            <div class="col-md-2 mb-4" style="order: 35;">

                                <label class="form-label">
                                    Postal Code
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('business_postal_code') is-invalid @enderror"
                                        wire:model="business_postal_code"
                                    >

                                </div>

                                @error('business_postal_code')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- BUSINESS CITY --}}
                            <div class="col-md-3 mb-4" style="order: 36;">

                                <label class="form-label">
                                    City
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('business_city') is-invalid @enderror"
                                        wire:model="business_city"
                                    >

                                </div>

                                @error('business_city')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- BUSINESS COUNTRY --}}
                            <div class="col-md-2 mb-4" style="order: 37;">

                                <label class="form-label">
                                    Country
                                </label>

                                <div class="input-group input-group-outline" wire:ignore>

                                    <select
                                        class="form-control @error('business_country') is-invalid @enderror"
                                        data-user-country-select
                                        data-country-target="business_country"
                                        data-current-country="{{ $business_country ?: 'Netherlands' }}"
                                    ></select>

                                </div>

                                @error('business_country')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- BANKING TITLE --}}
                            <div class="col-12 mt-2" style="order: 38;">

                                <h6 class="text-dark text-sm font-weight-bold">
                                    Banking Information
                                </h6>

                            </div>

                            {{-- BANK NAME --}}
                            <div class="col-md-4 mb-4" style="order: 39;">

                                <label class="form-label">
                                    Bank Name
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="bank_name"
                                    >

                                </div>

                            </div>

                            {{-- ACCOUNT HOLDER --}}
                            <div class="col-md-4 mb-4" style="order: 40;">

                                <label class="form-label">
                                    Account Holder
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="bank_account_holder"
                                    >

                                </div>

                            </div>

                            {{-- IBAN --}}
                            <div class="col-md-4 mb-4" style="order: 41;">

                                <label class="form-label">
                                    IBAN
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="iban"
                                    >

                                </div>

                            </div>

                            {{-- ABOUT --}}
                            <div class="col-12 mb-4" style="order: 14;">

                                <label class="form-label">
                                    About
                                </label>

                                <div class="input-group input-group-outline">

                                    <textarea
                                        class="form-control"
                                        rows="5"
                                        wire:model="about"
                                    ></textarea>

                                </div>

                            </div>

                            <div class="col-12 mt-3 mb-3" style="order: 50;">
                                <h6 class="user-modal-section-title">
                                    Employment & Access
                                </h6>
                            </div>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="closeUserModal"
                        >
                            Cancel
                        </button>

                        <button
                            type="button"
                            class="btn bg-gradient-warning dynamic-config-btn"
                            wire:click="saveUser"
                        >

                            {{ $isEditMode ? 'Update User' : 'Create User' }}

                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif

    @if($showRoleModal)

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
                            {{ $isRoleEditMode ? 'Edit Role' : 'Add Role' }}
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            wire:click="closeRoleModal"
                        ></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Role Name
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="text"
                                        class="form-control @error('role_name') is-invalid @enderror"
                                        wire:model="role_name"
                                    >
                                </div>
                                @error('role_name')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Role Slug
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="text"
                                        class="form-control @error('role_slug') is-invalid @enderror"
                                        wire:model="role_slug"
                                        @if($isRoleEditMode) readonly @endif
                                    >
                                </div>
                                @error('role_slug')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="form-label">
                                    Description
                                </label>
                                <div class="input-group input-group-outline">
                                    <input
                                        type="text"
                                        class="form-control @error('role_description') is-invalid @enderror"
                                        wire:model="role_description"
                                    >
                                </div>
                                @error('role_description')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <h6 class="mb-3">
                                    App Permissions
                                </h6>
                                <div class="table-responsive">
                                    <table class="table align-items-center">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Section
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                    Read
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                    Write
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissionModules as $module => $label)
                                                <tr>
                                                    <td>
                                                        <div class="px-3 py-2">
                                                            <h6 class="text-sm mb-0">
                                                                {{ $label }}
                                                            </h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $module }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input
                                                                class="form-check-input dynamic-config-checkbox"
                                                                type="checkbox"
                                                                wire:model="role_permissions.{{ $module }}.read"
                                                            >
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input
                                                                class="form-check-input dynamic-config-checkbox"
                                                                type="checkbox"
                                                                wire:model="role_permissions.{{ $module }}.write"
                                                            >
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            wire:click="closeRoleModal"
                        >
                            Cancel
                        </button>

                        <button
                            type="button"
                            class="btn bg-gradient-warning dynamic-config-btn"
                            wire:click="saveRole"
                        >
                            {{ $isRoleEditMode ? 'Update Role' : 'Create Role' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>
