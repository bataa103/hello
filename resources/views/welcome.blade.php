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

    <style>
        /* Tugrik Rain Animation */
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

        /* Fade-in Animation */
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1.5s ease-in-out;
        }

        .delay-20 {
            animation-delay: 0.2s;
        }

        /* General Styles */
        body {
            background: linear-gradient(to bottom, #1D3557, #FFC300);
            color: #1D3557;
            margin: 0;
            overflow: hidden;
        }

        .dark-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .text-hover:hover {
            color: #FFC300;
        }

        .rounded-xl {
            border-radius: 1rem;
        }

        .container {
            display: flex;
            height: 100vh;
            width: 100%;
            position: relative;
        }

        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 10;
            padding: 2rem;
        }

        .right-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 10;
        }

        #rain-container {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 1;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="container">
        <!-- Tugrik Rain -->
        <div id="rain-container"></div>

        <!-- Left Section -->
        <div class="left-section">
            <!-- Logo -->
            <img src="{{ asset('admin/assets/image/brandlogo.svg') }}" alt="Brand Logo"
                class="h-96 mx-auto animate-fade-in">

            <!-- Text -->
            <p class="text-3xl text-white mt-8 animate-fade-in delay-20 text-hover">
                Санхүүгээ хялбарчлах, зорилгодоо хялбархан хүрэх боломжийг олгоно.
            </p>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div class="form-container">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                </div>
                <!-- Dynamic Content -->
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Tugrik Rain Script -->
    <script>
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
</body>

</html>
