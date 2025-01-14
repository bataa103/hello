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


    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen relative overflow-hidden">
            <!-- Background Video -->
            <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover">
                <source src="{{ asset('haha/2.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Dark Overlay for better readability -->
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <!-- Content: Welcome Text + Login Form -->
            <div class="absolute inset-0 flex items-center justify-center">

                <div class="w-2/3 h-2/3 flex flex-row bg-gray-400 bg-opacity-10  backdrop-blur-md shadow-lg rounded-lg overflow-hidden">
                    <!-- Left Side: Welcome Text -->
                    <div class="w-1/2 flex items-center justify-center bg-gray-300 bg-opacity-80">
                        <h1 class="text-4xl font-bold text-gray-700">Welcome to Personal Budget</h1>
                    </div>

                    <!-- Right Side: Login Form -->
                    <div class="w-1/2 flex items-center justify-center">
                        <div class="w-full max-w-md px-8 py-6">
                            <div class="text-center mb-6">
                                <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                            </div>
                            <!-- Dynamic Content: Login Form -->
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>




    {{-- <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex relative overflow-hidden">
            <!-- Background Video -->
            <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover">
                <source src="{{ asset('haha/2.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <!-- Dark Overlay for better readability -->
            <div class="absolute inset-0 bg-black opacity-50"></div>

            <!-- Overlay Content -->
            <div class="relative z-10 w-full max-w-md ml-auto mt-10 sm:mt-20 px-8 py-6 bg-white bg-opacity-90 shadow-lg rounded-lg sm:mr-10">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Personal budget</h1>
                    <p class="text-sm text-gray-600"></p>
                </div>

                <!-- Slot for dynamic content -->
                {{ $slot }}
            </div>
        </div>
    </body> --}}


</html>
