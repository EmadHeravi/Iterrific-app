<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white"
    id="sidenav-main"
>

    {{-- SIDEBAR HEADER --}}
    <div class="sidenav-header">

        <i
            class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true"
            id="iconSidenav"
        ></i>

        <a
            class="navbar-brand m-0 d-flex text-wrap align-items-center"
            href="{{ route('dashboard') }}"
        >

            <img
                src="{{ asset('assets/img/Logo.png') }}"
                class="navbar-brand-img h-100"
                alt="ITerrific Logo"
            >


        </a>

    </div>

    <hr class="horizontal dark mt-0 mb-2">

    {{-- SIDEBAR CONTENT --}}
    <div
        class="collapse navbar-collapse w-auto"
        id="sidenav-collapse-main"
        style="
            height: calc(100vh - 320px);
            overflow-y: auto;
            overflow-x: hidden;
        "
    >

        <ul class="navbar-nav">

            @php
                $menuItems = [
                    ['dashboard', 'dashboard', 'Dashboard'],
                    ['time-entry', 'schedule', 'Time Entry'],
                    ['approvals', 'fact_check', 'Approvals'],
                    ['billing', 'receipt_long', 'Billing'],
                ];
            @endphp

            @foreach($menuItems as [$route, $icon, $label])
                @continue(! auth()->user()->canRead($route))

                <li class="nav-item">

                    <a
                        class="nav-link text-dark {{ Route::currentRouteName() == $route ? 'active bg-gradient-warning text-white' : '' }}"
                        href="{{ route($route) }}"
                    >

                        <div class="text-center me-2 d-flex align-items-center justify-content-center">

                            <i class="material-icons opacity-10">
                                {{ $icon }}
                            </i>

                        </div>

                        <span class="nav-link-text ms-1">
                            {{ $label }}
                        </span>

                    </a>

                </li>

            @endforeach

            @if(auth()->user()->canRead('user-management') || auth()->user()->canRead('projects') || auth()->user()->canRead('calendars'))
            {{-- LARAVEL EXAMPLES --}}
            <li class="nav-item mt-3">

                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8 d-flex align-items-center">
                    <i class="material-icons opacity-10 me-2" style="font-size: 1rem;">
                        settings
                    </i>
                    Settings
                </h6>

            </li>
            @endif


            {{-- USER MANAGEMENT --}}
            @if(auth()->user()->canRead('user-management'))
            <li class="nav-item settings-sub-item">

                <a
                    class="nav-link text-dark settings-sub-link {{ Route::currentRouteName() == 'user-management' ? 'active bg-gradient-warning text-white' : '' }}"
                    href="{{ route('user-management') }}"
                >

                    <div class="settings-sub-icon text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            manage_accounts
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        User Management
                    </span>

                </a>

            </li>
            @endif

            {{-- PROJECTS --}}
            @if(auth()->user()->canRead('projects'))
            <li class="nav-item settings-sub-item">

                <a
                    class="nav-link text-dark settings-sub-link {{ Route::currentRouteName() == 'projects' ? 'active bg-gradient-warning text-white' : '' }}"
                    href="{{ route('projects') }}"
                >

                    <div class="settings-sub-icon text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            work
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Projects
                    </span>

                </a>

            </li>
            @endif

            {{-- CALENDARS --}}
            @if(auth()->user()->canRead('calendars'))
            <li class="nav-item settings-sub-item">

                <a
                    class="nav-link text-dark settings-sub-link {{ Route::currentRouteName() == 'calendars' ? 'active bg-gradient-warning text-white' : '' }}"
                    href="{{ route('calendars') }}"
                >

                    <div class="settings-sub-icon text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            event
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Calendars
                    </span>

                </a>

            </li>
            @endif

            {{-- ACCOUNT --}}
            @if(auth()->user()->canRead('user-profile'))
            <li class="nav-item mt-3">

                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8 d-flex align-items-center">
                    <i class="material-icons opacity-10 me-2" style="font-size: 1rem;">
                        account_circle
                    </i>
                    Account
                </h6>

            </li>
            @endif

            {{-- LOGOUT --}}
                        {{-- USER PROFILE --}}
            @if(auth()->user()->canRead('user-profile'))
            <li class="nav-item settings-sub-item">

                <a
                    class="nav-link text-dark settings-sub-link {{ Route::currentRouteName() == 'user-profile' ? 'active bg-gradient-warning text-white' : '' }}"
                    href="{{ route('user-profile') }}"
                >

                    <div class="settings-sub-icon text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            account_circle
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        User Profile
                    </span>

                </a>

            </li>
            @endif
            <li class="nav-item">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="nav-link text-dark border-0 bg-transparent w-100"
                        style="text-align: left;"
                    >

                        <div class="d-flex align-items-center">

                            <div class="text-center me-2 d-flex align-items-center justify-content-center">

                                <i class="material-icons opacity-10">
                                    logout
                                </i>

                            </div>

                            <span class="nav-link-text ms-1">
                                Sign Out
                            </span>

                        </div>

                    </button>

                </form>

            </li>

        </ul>

    </div>

    {{-- SIDEBAR FOOTER --}}
    <div class="sidenav-footer position-absolute w-100 bottom-0">

        @if(auth()->user()->role === 'administrator')
            @php
                $permissionPreviewUserId = session('permission_preview_user_id');
                $permissionPreviewUsers = \App\Models\User::orderBy('first_name')
                    ->orderBy('last_name')
                    ->get(['id', 'first_name', 'last_name', 'email', 'role']);
            @endphp

            <div class="mx-3 mb-3 permission-preview-card">
                <div class="d-flex align-items-center mb-2">
                    <div class="permission-preview-icon bg-gradient-warning dynamic-config-gradient">
                        <i class="material-icons text-white">visibility</i>
                    </div>
                    <div class="ms-2">
                        <p class="text-xs text-uppercase font-weight-bolder mb-0 text-dark">
                            Permission Preview
                        </p>
                        <p class="text-xxs text-secondary mb-0">
                            View dashboard as another user
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('permission-preview.set') }}">
                    @csrf
                    <select
                        name="user_id"
                        class="form-control form-control-sm permission-preview-select"
                        onchange="this.form.submit()"
                    >
                        <option value="">
                            View as myself
                        </option>

                        @foreach($permissionPreviewUsers as $previewUser)
                            <option
                                value="{{ $previewUser->id }}"
                                @selected((int) $permissionPreviewUserId === $previewUser->id)
                            >
                                {{ $previewUser->full_name ?: $previewUser->email }} - {{ ucfirst($previewUser->role) }}
                            </option>
                        @endforeach
                    </select>
                </form>

                @if($permissionPreviewUserId)
                    <form method="POST" action="{{ route('permission-preview.clear') }}" class="mt-2">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100 mb-0">
                            Reset to Admin View
                        </button>
                    </form>
                @endif
            </div>
        @endif

        <div class="mx-3 mb-2">

            <a
                class="btn bg-gradient-warning w-100 dynamic-config-btn"
                href="{{ url('/') }}"
            >
                ITerrific Home
            </a>

        </div>

    </div>

</aside>
