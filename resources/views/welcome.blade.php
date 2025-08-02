<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('img/cloe-removebg.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-cover bg-center" style="background-image: url({{ asset('img/3837.jpg') }});">
            <div class="min-h-screen bg-opacity-15 bg-gray-700 p-2">
                <p class="flex"><img src="{{ asset('img/cloe-removebg.png') }}" width="50"> <span class="text-white font-bold text-3xl p-2">Cloé Edu</span></p>
                <div class="min-h-screen flex justify-center items-center bg-opacity-15 sbg-gray-700 p-2">
                    <div class="p-6 bg-gray-700 shadow-md rounded-lg bg-opacity-35 border-2 border-white">
                        <p class="">
                            <a href="{{ url('/signin') }}" class="bg-blue-500 text-white hover:bg-blue-700 px-4 py-2 rounded">Sign In</a>
                        </p>
                     </div>
                </div>
            </div>
        </div>
    </body>
</html>