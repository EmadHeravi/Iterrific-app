<div>

    <div class="container-fluid py-4">

        <div class="row">

            <div class="col-12">

                <div class="card my-4">

                    {{-- HEADER --}}
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

                        <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">

                            <h6 class="text-white text-capitalize ps-3">
                                User Management
                            </h6>

                        </div>

                    </div>

                    {{-- ADD USER BUTTON --}}
                    <div class="me-3 my-3 text-end">

                        <button
                            wire:click="openUserModal"
                            class="btn bg-gradient-warning mb-0"
                        >

                            <i class="material-icons text-sm">
                                add
                            </i>

                            &nbsp;&nbsp;Add New User

                        </button>

                    </div>

                    {{-- TABLE --}}
                    <div class="card-body px-0 pb-2">

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

                                                <span class="badge badge-sm bg-gradient-info">

                                                    {{ ucfirst($user->role) }}

                                                </span>

                                            </td>

                                            {{-- USER TYPE --}}
                                            <td class="align-middle text-center text-sm">

                                                <span class="badge badge-sm bg-gradient-secondary">

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

                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-link"
                                                >

                                                    <i class="material-icons">
                                                        edit
                                                    </i>

                                                </button>

                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-link"
                                                >

                                                    <i class="material-icons">
                                                        delete
                                                    </i>

                                                </button>

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

                </div>

            </div>

        </div>

    </div>

    {{-- CREATE USER MODAL --}}
    @if($showUserModal)

        <div
            class="modal fade show d-block"
            tabindex="-1"
            style="background: rgba(0,0,0,0.5);"
        >

            <div class="modal-dialog modal-xl">

                <div class="modal-content">

                    {{-- HEADER --}}
                    <div class="modal-header">

                        <h5 class="modal-title">
                            Add New User
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

                                        <option value="administrator">
                                            Administrator
                                        </option>

                                        <option value="manager">
                                            Manager
                                        </option>

                                        <option value="member">
                                            Member
                                        </option>

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
                                        class="form-control"
                                        wire:model="company_registration_number"
                                    >

                                </div>

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

                            {{-- COUNTRY CODE --}}
                            <div class="col-md-3 mb-4">

                                <label class="form-label">
                                    Country Code
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="phone_country_code"
                                    >

                                </div>

                            </div>

                            {{-- PHONE --}}
                            <div class="col-md-9 mb-4">

                                <label class="form-label">
                                    Phone Number
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="phone_number"
                                    >

                                </div>

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
                                        class="form-control"
                                        wire:model="personal_address"
                                    >

                                </div>

                            </div>

                            {{-- PERSONAL POSTAL --}}
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    Postal Code
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="personal_postal_code"
                                    >

                                </div>

                            </div>

                            {{-- PERSONAL CITY --}}
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    City
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="personal_city"
                                    >

                                </div>

                            </div>

                            {{-- PERSONAL COUNTRY --}}
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    Country
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="personal_country"
                                    >

                                </div>

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
                                        class="form-control"
                                        wire:model="business_address"
                                    >

                                </div>

                            </div>

                            {{-- BUSINESS POSTAL --}}
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    Postal Code
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="business_postal_code"
                                    >

                                </div>

                            </div>

                            {{-- BUSINESS CITY --}}
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    City
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="business_city"
                                    >

                                </div>

                            </div>

                            {{-- BUSINESS COUNTRY --}}
                            <div class="col-md-2 mb-4">

                                <label class="form-label">
                                    Country
                                </label>

                                <div class="input-group input-group-outline">

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model="business_country"
                                    >

                                </div>

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
                            class="btn bg-gradient-warning"
                            wire:click="saveUser"
                        >
                            Create User
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif

</div>