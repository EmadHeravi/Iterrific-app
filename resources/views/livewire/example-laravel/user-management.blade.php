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

                        <a
                            class="btn bg-gradient-warning mb-0"
                            href="javascript:;"
                        >

                            <i class="material-icons text-sm">
                                add
                            </i>

                            &nbsp;&nbsp;Add New User

                        </a>

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

</div>