<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ITerrific</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Material Dashboard CSS (reuse styles) -->
    <link href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet">
    <link href="{{ asset('assets/css/iterrific.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>
    <body class="bg-gray-200 d-flex flex-column min-vh-100">

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img
                    src="{{ asset('assets/img/Logo.png') }}"
                    alt="ITerrific"
                    height="45"
                >
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-warning' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('services') ? 'active fw-bold text-warning' : '' }}" href="/services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active fw-bold text-warning' : '' }}" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('references') ? 'active fw-bold text-warning' : '' }}" href="/references">References</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active fw-bold text-warning' : '' }}" href="/contact">Contact Us</a>
                    </li>

                    <li class="nav-item d-flex align-items-center ms-lg-3">
                        <a href="/sign-in" class="btn btn-warning btn-sm mb-0">
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main class="flex-fill">
        @yield('content')
    </main>
    
        <footer class="bg-white border-top py-4 mt-5">
        <div class="container">
            <div class="row align-items-center">

                <!-- Left -->
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-secondary d-block">
                        © {{ date('Y') }} ITerrific B.V. — All rights reserved.
                    </span>

                    <div class="mt-2 small text-secondary">
                        <div>
                            <i class="material-icons align-middle me-1" style="font-size:16px;">call</i>
                            <a href="tel:+31636199976" class="text-secondary">
                                +31 6 36 19 99 76
                            </a>
                        </div>
                        <div>
                            <i class="material-icons align-middle me-1" style="font-size:16px;">email</i>
                            <a href="mailto:info@iterrific.nl" class="text-secondary">
                                info@iterrific.nl
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Right -->
                <div class="col-md-6 text-center text-md-end">
                    <a href="https://www.linkedin.com/company/iterrific"
                    target="_blank"
                    aria-label="ITerrific on LinkedIn"
                    class="me-4">
                        <i class="fab fa-linkedin-in fs-5"></i>
                    </a>

                    <a href="/privacy" class="me-4">
                        Privacy
                    </a>

                    <a href="/contact">
                        Contact
                    </a>
                </div>

            </div>
        </div>
    </footer>

    <!-- Core JS -->
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <!-- Turnstile-->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</body>
</html>
