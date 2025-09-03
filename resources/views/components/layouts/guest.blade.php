<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light font-sans text-gray-900 antialiased">

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center">

        <!-- Logo + Title in one line -->
        <div class="d-flex flex-row justify-content-center align-items-center mb-4">
            <img src="{{ asset('AYM_Transparent_Logo.png') }}" alt="Logo" width="80" class="me-3">
            <h2 class="fw-bold mb-0">AYM Engineering Solutions - EMS</h2>
        </div>

        <!-- Content -->
        <div class="card shadow p-4" style="width: 400px;">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
