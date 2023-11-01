<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>
</head>
<body class="font-sans antialiased bg-cover bg-center" style="background-image: url('/bg.svg');">
<div class="min-h-screen">
{{--    @include('layouts.navigation')--}}

    @include('layouts.sidebar')

    <!-- Page Content -->
    <main class="p-2 sm:p-4 w-full mt-14 overflow-clip">
        {{ $slot }}
    </main>
</div>
</body>
</html>
