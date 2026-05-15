<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main"
>

    {{-- SIDEBAR HEADER --}}
    <div class="sidenav-header">

        <i
            class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true"
            id="iconSidenav"
        ></i>

        <a
            class="navbar-brand m-0 d-flex text-wrap align-items-center"
            href="{{ route('dashboard') }}"
        >

            <img
                src="{{ asset('assets') }}/img/logo-ct.png"
                class="navbar-brand-img h-100"
                alt="main_logo"
            >

            <span class="ms-2 font-weight-bold text-white">
                ITerrific
            </span>

        </a>

    </div>

    <hr class="horizontal light mt-0 mb-2">

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

            {{-- LARAVEL EXAMPLES --}}
            <li class="nav-item mt-3">

                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                    Laravel Examples
                </h6>

            </li>

            {{-- USER PROFILE --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'user-profile' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('user-profile') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i
                            style="font-size: 1.2rem;"
                            class="fas fa-user-circle ps-2 pe-2 text-center"
                        ></i>

                    </div>

                    <span class="nav-link-text ms-1">
                        User Profile
                    </span>

                </a>

            </li>

            {{-- USER MANAGEMENT --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'user-management' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('user-management') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i
                            style="font-size: 1rem;"
                            class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"
                        ></i>

                    </div>

                    <span class="nav-link-text ms-1">
                        User Management
                    </span>

                </a>

            </li>

            {{-- PAGES --}}
            <li class="nav-item mt-3">

                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                    Pages
                </h6>

            </li>

            {{-- DASHBOARD --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            dashboard
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Dashboard
                    </span>

                </a>

            </li>

            {{-- TABLES --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'tables' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('tables') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            table_view
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Tables
                    </span>

                </a>

            </li>

            {{-- BILLING --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'billing' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('billing') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            receipt_long
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Billing
                    </span>

                </a>

            </li>

            {{-- VIRTUAL REALITY --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'virtual-reality' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('virtual-reality') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            view_in_ar
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Virtual Reality
                    </span>

                </a>

            </li>

            {{-- RTL --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'rtl' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('rtl') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            format_textdirection_r_to_l
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        RTL
                    </span>

                </a>

            </li>

            {{-- NOTIFICATIONS --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'notifications' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('notifications') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            notifications
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Notifications
                    </span>

                </a>

            </li>

            {{-- ACCOUNT --}}
            <li class="nav-item mt-3">

                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                    Account Pages
                </h6>

            </li>

            {{-- PROFILE --}}
            <li class="nav-item">

                <a
                    class="nav-link text-white {{ Route::currentRouteName() == 'profile' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('profile') }}"
                >

                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                        <i class="material-icons opacity-10">
                            person
                        </i>

                    </div>

                    <span class="nav-link-text ms-1">
                        Profile
                    </span>

                </a>

            </li>

            {{-- LOGOUT --}}
            <li class="nav-item">

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="nav-link text-white border-0 bg-transparent w-100"
                        style="text-align: left;"
                    >

                        <div class="d-flex align-items-center">

                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

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

        <div class="mx-3">

            <a
                class="btn bg-gradient-primary w-100"
                href="https://www.creative-tim.com/product/material-dashboard-laravel-livewire"
                target="_blank"
            >
                Free Download
            </a>

        </div>

        <div class="mx-3">

            <a
                class="btn bg-gradient-primary w-100"
                href="../../documentation/getting-started/installation.html"
                target="_blank"
            >
                View Documentation
            </a>

        </div>

        <div class="mx-3">

            <a
                class="btn bg-gradient-primary w-100"
                href="https://www.creative-tim.com/product/material-dashboard-pro-laravel-livewire"
                target="_blank"
                type="button"
            >
                Upgrade to Pro
            </a>

        </div>

    </div>

</aside>