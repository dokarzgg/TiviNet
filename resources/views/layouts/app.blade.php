<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0a4f82">
    <meta name="description" content="@yield('description', config('company.name') . ' — ' . config('company.tagline') . '.')">
    <title>@hasSection('title')@yield('title') — {{ config('company.name') }}@else{{ config('company.name') }} — Internet WiFi Cepat & Stabil @endif</title>

    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48'%3E%3Crect width='48' height='48' rx='12' fill='%230a4f82'/%3E%3Cg fill='none' stroke='%23fff' stroke-width='3.4' stroke-linecap='round'%3E%3Cpath d='M9 21c8.5-8 21.5-8 30 0' opacity='.55'/%3E%3Cpath d='M14.5 27c5.5-5 14.5-5 19 0' opacity='.8'/%3E%3Cpath d='M20 33c2.5-2.200 5.500-2.200 8 0'/%3E%3C/g%3E%3Ccircle cx='24' cy='39' r='2.600' fill='%23fff'/%3E%3C/svg%3E">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    @include('partials.header')

    <main class="grow">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Popup global: formulir pendaftaran, sukses, dan tombol WhatsApp --}}
    @include('partials.install-modal')
    @include('partials.whatsapp')
</body>
</html>
