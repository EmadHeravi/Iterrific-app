<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $appName = \App\Models\AppSetting::valueFor('app_name', config('app.name', 'ITerrific'));
        $faviconPath = \App\Models\AppSetting::valueFor('app_favicon_path', 'assets/img/favicon.png');
        $faviconVersion = is_file(public_path($faviconPath)) ? filemtime(public_path($faviconPath)) : time();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance | {{ $appName }}</title>
    <link rel="icon" type="image/png" href="{{ asset($faviconPath) }}?v={{ $faviconVersion }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($faviconPath) }}?v={{ $faviconVersion }}">
    <link href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/iterrific.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200">
    <main class="min-vh-100 d-flex align-items-center justify-content-center px-3">
        <section class="card shadow-lg border-0" style="max-width: 640px;">
            <div class="card-body p-5 text-center">
                <img
                    src="{{ asset(\App\Models\AppSetting::valueFor('app_logo_path', 'assets/img/Logo.png')) }}"
                    alt="ITerrific Logo"
                    style="height: 52px; width: auto;"
                    class="mb-4"
                >

                <div class="avatar avatar-lg bg-gradient-warning dynamic-config-gradient mx-auto mb-3">
                    <span class="text-white font-weight-bold" style="font-size: 1.6rem; line-height: 1;">
                        !
                    </span>
                </div>

                <h3 class="text-dark mb-2">Maintenance Mode</h3>
                <p class="text-secondary mb-4">
                    {{ $message }}
                </p>

                <a href="{{ route('login') }}" class="btn bg-gradient-warning dynamic-config-btn mb-0">
                    Administrator Login
                </a>
            </div>
        </section>
    </main>
</body>
</html>
