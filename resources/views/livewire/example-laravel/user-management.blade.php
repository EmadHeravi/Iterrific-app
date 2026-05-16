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

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            COMPANY
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

                                            {{-- COMPANY --}}
                                            <td>

                                                <div class="px-3 py-2">

                                                    <p class="text-sm mb-0">

                                                        {{ $user->company_name ?? '-' }}

                                                    </p>

                                                </div>

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

                                            <td colspan="10" class="text-center py-4">

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

                            {{-- FIRST NAME --}}
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

                                <label class="form-label">
                                    Role
                                </label>

                                <div class="input-group input-group-outline">

                                    <select
                                        class="form-control @error('role') is-invalid @enderror"
                                        wire:model="role"
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

                            {{-- USER TYPE --}}
                            <div class="col-md-6 mb-4">

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

                            {{-- EMPLOYEE ID --}}
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-6 mb-4">

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


                            {{-- PHONE --}}
                            <div class="col-md-12 mb-4">

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



                            {{-- PERSONAL ADDRESS TITLE --}}
                            <div class="col-12 mt-3">

                                <h6 class="text-dark">
                                    Personal Address
                                </h6>

                            </div>

                            {{-- PERSONAL ADDRESS --}}
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-2 mb-4">

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
                            <div class="col-md-2 mb-4">

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
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    Country
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('personal_country') is-invalid @enderror"
                                        wire:model="personal_country"
                                    >

                                </div>

                                @error('personal_country')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>


                            {{-- BUSINESS ADDRESS TITLE --}}
                            <div class="col-12 mt-3">

                                <h6 class="text-dark">
                                    Business Address
                                </h6>

                            </div>

                            {{-- BUSINESS ADDRESS --}}
                            <div class="col-md-6 mb-4">

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
                            <div class="col-md-2 mb-4">

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
                            <div class="col-md-2 mb-4">

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
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    Country
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control @error('business_country') is-invalid @enderror"
                                        wire:model="business_country"
                                    >

                                </div>

                                @error('business_country')

                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>

                                @enderror

                            </div>

                            {{-- BANKING TITLE --}}
                            <div class="col-12 mt-3">

                                <h6 class="text-dark">
                                    Banking Information
                                </h6>

                            </div>

                            {{-- BANK NAME --}}
                            <div class="col-md-4 mb-4">

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
                            <div class="col-md-4 mb-4">

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
                            <div class="col-md-4 mb-4">

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
                            <div class="col-12 mb-4">

                                <label class="form-label">
                                    About User
                                </label>

                                <div class="input-group input-group-outline">

                                    <textarea
                                        class="form-control"
                                        rows="5"
                                        wire:model="about"
                                    ></textarea>

                                </div>

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
