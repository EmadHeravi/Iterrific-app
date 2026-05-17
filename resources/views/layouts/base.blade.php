<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang='en' dir="{{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">

<head>
    @php
        $appName = \App\Models\AppSetting::valueFor('app_name', config('app.name', 'ITerrific'));
        $faviconPath = \App\Models\AppSetting::valueFor('app_favicon_path', 'assets/img/favicon.png');
        $faviconVersion = is_file(public_path($faviconPath)) ? filemtime(public_path($faviconPath)) : time();
    @endphp
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($faviconPath) }}?v={{ $faviconVersion }}">
    <link rel="icon" type="image/png" href="{{ asset($faviconPath) }}?v={{ $faviconVersion }}">
    <title>
        {{ $appName }}
    </title>

    <!-- Metas -->
    @if (env('IS_DEMO'))
        <meta name="keywords"
            content="creative tim, updivision, material, html dashboard, laravel, livewire, laravel livewire, alpine.js, html css dashboard laravel, material dashboard laravel, livewire material dashboard, material admin, livewire dashboard, livewire admin, web dashboard, bootstrap 5 dashboard laravel, bootstrap 5, css3 dashboard, bootstrap 5 admin laravel, material dashboard bootstrap 5 laravel, frontend, responsive bootstrap 5 dashboard, material dashboard, material laravel bootstrap 5 dashboard" />
        <meta name="description"
            content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta itemprop="name" content="Material Dashboard 2 Laravel Livewire by Creative Tim & UPDIVISION" />
        <meta itemprop="description"
            content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta itemprop="image"
            content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />
        <meta name="twitter:card" content="product" />
        <meta name="twitter:site" content="@creativetim" />
        <meta name="twitter:title" content="Material Dashboard 2 Laravel Livewire by Creative Tim & UPDIVISION" />
        <meta name="twitter:description"
            content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta name="twitter:creator" content="@creativetim" />
        <meta name="twitter:image"
            content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />
        <meta property="fb:app_id" content="655968634437471" />
        <meta property="og:title" content="Material Dashboard 2 Laravel Livewire by Creative Tim & UPDIVISION" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="https://www.creative-tim.com/live/material-dashboard-laravel-livewire" />
        <meta property="og:image"
            content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />
        <meta property="og:description"
            content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta property="og:site_name" content="Creative Tim" />
    @endif
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <link href="{{ asset('assets/css/iterrific-dashboard.css') }}?v={{ filemtime(public_path('assets/css/iterrific-dashboard.css')) }}" rel="stylesheet" />
    @livewireStyles
</head>

<body
    class="g-sidenav-show {{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }} {{ Route::currentRouteName() == 'register' || Route::currentRouteName() == 'static-sign-up' ? '' : 'bg-gray-200' }}">

    {{ $slot }}

    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
    @stack('js')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets') }}/js/material-dashboard.js?v=3.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script>

        const phoneInputOptions = {
            initialCountry: 'nl',
            separateDialCode: true,
            preferredCountries: [
                'nl',
                'be',
                'de',
                'fr',
                'gb'
            ],
            utilsScript:
                'https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js'
        };

        function initUserPhoneInput() {

            const input = document.querySelector('#phone');

            if (!input || input.classList.contains('iti-initialized')) {
                return;
            }

            input.classList.add('iti-initialized');

            const iti = window.intlTelInput(input, phoneInputOptions);

            function updatePhoneData() {

                const countryData = iti.getSelectedCountryData();

                const wireId = input.closest('[wire\\:id]').getAttribute('wire:id');

                Livewire.find(wireId).set(
                    'phone_country_code',
                    '+' + countryData.dialCode
                );

                Livewire.find(wireId).set(
                    'phone_number',
                    input.value
                );

            }

            input.addEventListener('countrychange', updatePhoneData);

            input.addEventListener('input', updatePhoneData);

            updatePhoneData();

        }

        function initProjectPhoneInputs() {

            document.querySelectorAll('[data-project-phone-input]').forEach((input) => {

                if (input.classList.contains('iti-initialized')) {
                    return;
                }

                input.classList.add('iti-initialized');

                const iti = window.intlTelInput(input, phoneInputOptions);

                function updateProjectPhoneData() {

                    const wireElement = input.closest('[wire\\:id]');
                    const property = input.getAttribute('data-phone-property');

                    if (!wireElement || !property) {
                        return;
                    }

                    const wire = Livewire.find(wireElement.getAttribute('wire:id'));
                    const phoneValue = iti.getNumber() || input.value;

                    wire.set(property, phoneValue);

                }

                input.addEventListener('countrychange', updateProjectPhoneData);

                input.addEventListener('input', updateProjectPhoneData);

                updateProjectPhoneData();

            });

        }

        function initCalendarCountryInputs() {

            document.querySelectorAll('[data-calendar-country-select]').forEach((select) => {

                if (select.classList.contains('calendar-country-initialized')) {
                    return;
                }

                select.classList.add('calendar-country-initialized');

                const countryData = window.intlTelInputGlobals
                    ? window.intlTelInputGlobals.getCountryData()
                    : [];

                const preferredCountries = ['nl', 'be', 'de', 'fr', 'gb', 'us'];
                const currentCountry = (select.getAttribute('data-current-country') || 'NL').toLowerCase();

                function isoToFlag(iso2) {
                    return iso2
                        .toUpperCase()
                        .replace(/./g, (char) => String.fromCodePoint(127397 + char.charCodeAt()));
                }

                const sortedCountries = countryData
                    .slice()
                    .sort((first, second) => {
                        const firstPreferred = preferredCountries.indexOf(first.iso2);
                        const secondPreferred = preferredCountries.indexOf(second.iso2);

                        if (firstPreferred !== -1 || secondPreferred !== -1) {
                            return (firstPreferred === -1 ? 999 : firstPreferred) - (secondPreferred === -1 ? 999 : secondPreferred);
                        }

                        return first.name.localeCompare(second.name);
                    });

                sortedCountries.forEach((country) => {
                    const option = document.createElement('option');

                    option.value = country.iso2.toUpperCase();
                    option.dataset.countryName = country.name;
                    option.textContent = `${isoToFlag(country.iso2)} ${country.iso2.toUpperCase()} - ${country.name}`;

                    select.appendChild(option);
                });

                select.value = currentCountry.toUpperCase();

                function updateCalendarCountryData() {

                    const wireElement = select.closest('[wire\\:id]');
                    const selectedOption = select.options[select.selectedIndex];

                    if (!wireElement || !selectedOption) {
                        return;
                    }

                    const wire = Livewire.find(wireElement.getAttribute('wire:id'));

                    const countryCode = select.value;
                    const countryName = selectedOption.dataset.countryName || selectedOption.textContent.replace(/^[^\s]+\s+[A-Z]{2}\s+-\s+/, '');

                    wire.set('country_code', countryCode);
                    wire.set('country_name', countryName);

                }

                select.addEventListener('change', updateCalendarCountryData);

                updateCalendarCountryData();

            });

        }

        function initUserCountryInputs() {

            document.querySelectorAll('[data-user-country-select]').forEach((select) => {

                if (select.classList.contains('user-country-initialized')) {
                    return;
                }

                select.classList.add('user-country-initialized');

                const countryData = window.intlTelInputGlobals
                    ? window.intlTelInputGlobals.getCountryData()
                    : [];

                const preferredCountries = ['nl', 'be', 'de', 'fr', 'gb', 'us'];
                const currentCountry = (select.getAttribute('data-current-country') || '').toLowerCase();

                function isoToFlag(iso2) {
                    return iso2
                        .toUpperCase()
                        .replace(/./g, (char) => String.fromCodePoint(127397 + char.charCodeAt()));
                }

                const sortedCountries = countryData
                    .slice()
                    .sort((first, second) => {
                        const firstPreferred = preferredCountries.indexOf(first.iso2);
                        const secondPreferred = preferredCountries.indexOf(second.iso2);

                        if (firstPreferred !== -1 || secondPreferred !== -1) {
                            return (firstPreferred === -1 ? 999 : firstPreferred) - (secondPreferred === -1 ? 999 : secondPreferred);
                        }

                        return first.name.localeCompare(second.name);
                    });

                sortedCountries.forEach((country) => {
                    const option = document.createElement('option');

                    option.value = country.name;
                    option.dataset.countryCode = country.iso2.toUpperCase();
                    option.textContent = `${isoToFlag(country.iso2)} ${country.iso2.toUpperCase()} - ${country.name}`;

                    select.appendChild(option);
                });

                const selectedCountry = sortedCountries.find((country) => {
                    return country.name.toLowerCase() === currentCountry
                        || country.iso2.toLowerCase() === currentCountry;
                });

                if (selectedCountry) {
                    select.value = selectedCountry.name;
                }

                function updateUserCountryData() {

                    const wireElement = select.closest('[wire\\:id]');
                    const target = select.getAttribute('data-country-target');

                    if (!wireElement || !target) {
                        return;
                    }

                    const wire = Livewire.find(wireElement.getAttribute('wire:id'));

                    wire.set(target, select.value);

                }

                select.addEventListener('change', updateUserCountryData);

                updateUserCountryData();

            });

        }

        function initPhoneInputs() {

            initUserPhoneInput();

            initProjectPhoneInputs();

            initCalendarCountryInputs();

            initUserCountryInputs();

        }

        document.addEventListener('livewire:initialized', () => {

            initPhoneInputs();

            Livewire.hook('morph.updated', () => {

                setTimeout(() => {
                    initPhoneInputs();
                }, 100);

            });

        });

    </script>

    @livewireScripts
</body>

</html>
