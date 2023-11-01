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
<div class="min-h-screen flex">
{{--    @include('layouts.navigation')--}}
    <!-- Drawer Button -->

    @include('layouts.sidebar')

    <!-- Page Content -->
    <main class="p-2 sm:p-4 w-full mt-14 overflow-clip">
        <div class="absolute top-0 left-0 right-0 m-3 bottom-0">
            <section data-tip="SideBar" class="tooltip tooltip-bottom m-0 p-0 shrink-0 flex items-center md:hidden">
                <label for="my-drawer" class="drawer-button swap swap-rotate">

                    <!-- this hidden checkbox controls the state -->
                    <input class="hidden" type="checkbox" />

                    <i class="fa-solid text-xl text-white fa-bars"></i>

                </label>
            </section>
        </div>

        {{ $slot }}
    </main>
</div>
</body>
</html>
