<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tinduka') }} - Explore Kenya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-base-200 text-base-content min-h-screen flex flex-col">
    <div class="flex-1">
        @include('layouts.navigation')
        <main class="container mx-auto px-4 py-8">
            {{ $slot }}
        </main>
    </div>

    @include('layouts.footer')

    @livewireScripts
</body>
</html>