<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Budget with Animation</title>

  <!-- Import Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Import Custom Styles -->
  <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.css') }}">

  <!-- Custom CSS for Tugrik Rain -->
  <style>
    /* Tugrik Rain */
    @keyframes fall {
      0% { transform: translateY(0) rotate(0deg); opacity: 1; }
      100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
    }

    .animate-fall {
      animation: fall 5s linear infinite;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-[#1D3557] to-[#FFD700] overflow-auto relative">

  <!-- Header Section -->
  <header class="shadow-sm bg-[#1D3557] fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="flex items-center">
        <img src="{{ asset('admin/assets/image/brandlogo.svg') }}" alt="Brand Logo" class="h-10">
      </a>
      <!-- Navigation -->
      <nav class="space-x-4">
        @if (Route::has('login'))
          @auth
            <a href="{{ url('/dashboard') }}" class="text-[#FFD700] hover:text-[#FFC300]">Удирдах самбар</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="bg-[#FFD700] text-[#1D3557] px-4 py-2 rounded hover:bg-[#FFC300]">Гарах</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-[#FFD700] hover:text-[#FFC300]">Нэвтрэх</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="bg-[#FFD700] text-[#1D3557] px-4 py-2 rounded hover:bg-[#FFC300]">Бүртгүүлэх</a>
            @endif
          @endauth
        @endif
      </nav>
    </div>
  </header>

  <!-- Landing Section -->
  <div class="h-screen flex items-center justify-center relative">
    <div class="text-center z-10">
      <h1 class="text-4xl text-white font-bold animate-fade-in">Welcome to Personal Budget</h1>
      <p class="text-xl text-white mt-4 animate-fade-in delay-200">Take control of your finances with ease.</p>
    </div>
    <!-- Rain container -->
    <div class="absolute inset-0 pointer-events-none" id="rain-container"></div>
  </div>

  <!-- Main Content -->
  <div class="h-screen bg-white flex items-center justify-center">
    <div class="text-center">
      <h2 class="text-3xl font-bold text-[#1D3557]">Welcome to Your Dashboard</h2>
      <p class="text-lg text-gray-600 mt-4">Start managing your finances effectively.</p>
    </div>
  </div>

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
  </script>
</body>
</html>
