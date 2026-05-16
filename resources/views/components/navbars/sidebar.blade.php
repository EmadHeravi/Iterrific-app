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
                    ['tables', 'table_view', 'Tables'],
                    ['billing', 'receipt_long', 'Billing'],
                    ['virtual-reality', 'view_in_ar', 'Virtual Reality'],
                    ['rtl', 'format_textdirection_r_to_l', 'RTL'],
                    ['notifications', 'notifications', 'Notifications'],
                    ['profile', 'person', 'Profile'],
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

            @if(auth()->user()->canRead('user-management') || auth()->user()->canRead('projects'))
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

        <div class="mx-3 mb-2">

            <a
                class="btn bg-gradient-warning w-100 dynamic-config-btn"
                href="https://www.creative-tim.com/product/material-dashboard-laravel-livewire"
                target="_blank"
            >
                Free Download
            </a>

        </div>

        <div class="mx-3 mb-2">

            <a
                class="btn bg-gradient-warning w-100 dynamic-config-btn"
                href="../../documentation/getting-started/installation.html"
                target="_blank"
            >
                View Documentation
            </a>

        </div>

        <div class="mx-3">

            <a
                class="btn bg-gradient-warning w-100 dynamic-config-btn"
                href="https://www.creative-tim.com/product/material-dashboard-pro-laravel-livewire"
                target="_blank"
                type="button"
            >
                Upgrade to Pro
            </a>

        </div>

    </div>

</aside>
