<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-bottom bg-cover bg-loginV">
        {{-- <div class="min-h-screen bg-cover bg-testing"> --}}
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <div class="flex justify-end py-2 mx-20">
                    <p class="p-1 px-2 text-sm font-medium text-white uppercase rounded-l-md bg-ipn">{{ Auth::user()->name }}</p>
                    <button class="px-2 text-sm font-medium text-white rounded-r-md bg-ipn-dark">SALIR</button>
                </div>
            </form>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
