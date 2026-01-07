<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ITerrific</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    {{-- CSS --}}
    <link href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body class="bg-gray-200">

{{-- ✅ PUBLIC NAVBAR --}}
@include('layouts.public-navbar') {{-- or COPY navbar HTML here --}}

{{-- ✅ LIVEWIRE CONTENT --}}
{{ $slot }}

{{-- ✅ PUBLIC FOOTER --}}
@include('layouts.public-footer') {{-- or COPY footer HTML here --}}

<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
@livewireScripts
</body>
</html>
