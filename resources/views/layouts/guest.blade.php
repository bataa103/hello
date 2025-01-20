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


    <body class="font-sans bg-gradient-to-r from-[#1D3557] to-[#FFD700] overflow-hidden relative">
        <!-- Tugrik Rain Animation -->
        <div class="absolute inset-0 pointer-events-none" id="rain-container"></div>

        <div class="min-h-screen flex items-center justify-center">
            <!-- Content: Login Form -->
            <div class="relative w-full max-w-md px-8 py-6 bg-white bg-opacity-10 backdrop-blur-lg shadow-lg rounded-lg">
                <!-- Dynamic Content: Login Form -->
                {{ $slot }}
            </div>
            
        </div>

        <script>
            // Tugrik Rain Animation
            const rainContainer = document.getElementById('rain-container');
            const totalTugriks = 50; // Number of Tugrik signs

            for (let i = 0; i < totalTugriks; i++) {
                const tugrik = document.createElement('div');
                tugrik.className = 'absolute text-[#FFD700] text-2xl animate-fall';
                tugrik.textContent = '₮';

                // Randomize position and animation duration
                tugrik.style.left = Math.random() * 100 + 'vw';
                tugrik.style.animationDuration = Math.random() * 3 + 3 + 's';
                tugrik.style.animationDelay = Math.random() * 5 + 's';

                rainContainer.appendChild(tugrik);
            }
        </script>

        <style>
            /* Tugrik Rain */
            @keyframes fall {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                }

                100% {
                    transform: translateY(100vh) rotate(360deg);
                    opacity: 0;
                }
            }

            .animate-fall {
                animation: fall 5s linear infinite;
            }
        </style>
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
