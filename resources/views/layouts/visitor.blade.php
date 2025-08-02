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


        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/popper.min.js') }}"></script>
        <script src="{{ asset('/js/flowbite.min.js') }}"></script>
        <script src="{{ asset('/axios/axios.min.js') }}"></script>
        <script src="{{ asset('/sweetalert/sweetalert2.all.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/sweetalert/sweetalert2.min.css') }}">
        
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="w-full bg-cover bg-center" style="background-image: url({{ asset('img/2148844717.jpg') }});">

        
        <div class="min-h-screen w-full bg-black p-2 bg-opacity-55">
            <a href="{{ url('/') }}" class="bg-blue-500 hover:bg-blue-700 px-2 py-2 rounded text-white">Home</a>

            <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

    </div>
    </body>
</html>