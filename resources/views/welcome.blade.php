<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title -->
    <title>Personal Budget</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<!-- Header -->
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('admin/image/brandlogo.png') }}" alt="Brand Logo"class="h-10">
        </a>

        <!-- Navigation -->
        <nav class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-indigo-600 hover:text-indigo-800">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="relative bg-gray-900 text-white">
    <img src="{{ asset('assets/images/slider/back2.webp') }}" alt="Hero Background" class="w-full h-96 object-cover opacity-50">
    <div class="absolute inset-0 flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Take Control of Your Finances</h1>
            <p class="text-lg mb-6">Simplify budgeting and achieve your financial goals effortlessly.</p>
            <a href="#" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">Get Started</a>
        </div>
    </div>
</section>


<!-- Features Section -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <i class="fa fa-chart-line text-indigo-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Track Expenses</h3>
                <p>Understand your spending habits with detailed analytics and reports.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <i class="fa fa-wallet text-indigo-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Set Goals</h3>
                <p>Define and achieve financial goals to create the life you want.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <i class="fa fa-cogs text-indigo-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Budgeting Tools</h3>
                <p>Plan and manage your budget with intuitive, easy-to-use tools.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-10">
    <div class="container mx-auto px-4 flex flex-col lg:flex-row justify-between items-center">
        <div>
            <h3 class="text-white text-lg font-semibold">Personal Budget</h3>
            <p>Helping you take control of your finances.</p>
        </div>
        <div class="space-x-4 mt-4 lg:mt-0">
            <a href="#" class="text-gray-400 hover:text-white"><i class="fa fa-facebook"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fa fa-twitter"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fa fa-linkedin"></i></a>
        </div>
    </div>
    <p class="text-center mt-6 text-gray-500">&copy; {{ date('Y') }} Personal Budget. All rights reserved.</p>
</footer>

</body>
</html>
