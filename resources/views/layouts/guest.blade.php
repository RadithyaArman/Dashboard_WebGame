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
    </head>
    <body class="font-sans text-gray-50 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
            <div class="">
                <a href="/" class="text-3xl font-bold">
                    <h1 class="">Dashboard</h1>
                    <h1 class="">Web Game</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 pb-4 bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
                @include('layouts.auth')

                <div class="px-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
