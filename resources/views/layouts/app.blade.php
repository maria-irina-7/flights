<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-slate-900">
        <div class="pt-3 min-h-screen flex flex-col h-screen justify-between">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="">
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="mb-auto">
                {{ $slot }}
            </main>

            <footer>
                <div class="w-full sticky bottom-0 px-40 sm:px-6 lg:px-8 py-8 text-center text-gray-600 dark:text-gray-400 bg-slate-950">
                    &copy; {{ date('Y') }} Flights. All rights reserved.
                </div>      
            </footer>
        </div>
    </body>
</html>
