<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Budget with Animation</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Import Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>




    <!-- Import Custom Styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/styles.css') }}">

    <!-- Custom CSS for Tugrik Rain -->
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
</head>

<body class="bg-gradient-to-r from-[#1D3557] to-[#FFD700] overflow-auto relative">
c
    <!-- Header Section -->
    <header class="shadow-sm bg-blue-900 border-bt border-[#1D3557] fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->

            <nav class="flex justify-end items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="text-[#FFD700] hover:text-[#FFC300]">Админы Самбар</a>
                        @else
                            <a href="{{ url('/user/dashboard') }}" class="text-[#FFD700] hover:text-[#FFC300]">Хэрэглэгчийн Самбар</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-[#FFD700] text-[#1D3557] px-4 py-2 rounded hover:bg-[#FFC300]">Гарах</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[#FFD700] hover:text-[#FFC300]">Нэвтрэх</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-[#FFD700] text-[#1D3557] px-4 py-2 rounded hover:bg-[#FFC300]">Бүртгүүлэх</a>
                        @endif
                    @endauth
                @endif
            </nav>

        </div>
    </header>

    <div class="min-h-screen flex items-center justify-center relative">
        <div class="">
            <a href="{{ url('/') }}" class="flex items-center justify-center">
                <img src="{{ asset('admin/assets/image/brandlogo.svg') }}" alt="Brand Logo" class="max-w-[500px]">
            </a>
        </div>
        <!-- Rain container -->
        <div class="absolute inset-0 pointer-events-none" id="rain-container"></div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen relative">
        <div class="flex items-center justify-center pt-8">

        </div>

        <div class="absolute inset-0 pointer-events-none" id="rain-container"></div>

        <div class="h-screen bg-cover bg-center flex flex-col justify-center items-center"
            style="background-image: url('{{ asset('admin/assets/image/back3.webp') }}');">

            <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-5xl w-full">
                <div class="flex flex-col items-center mb-8">
                    <a href="{{ url('/') }}" class="flex items-center justify-center mb-4">
                    </a>
                    <p class="text-xl text-cold text-[#1D3557]">Санхүүгээ үр ашгийг нэмэгдүүлээрэй.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="relative aspect-video"> <video controls class="absolute inset-0 w-full h-full rounded-lg shadow-md">
                            <source src="{{ asset('admin/assets/video/Finance1.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <p class="mt-2 text-gray-700">Video 1 Description</p>
                    </div>
                    <div class="relative aspect-video">
                        <video controls class="absolute inset-0 w-full h-full rounded-lg shadow-md">
                            <source src="{{ asset('admin/assets/video/Finance2.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <p class="mt-2 text-gray-700">Video 2 Description</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white pt-[120px] pb-[200px]">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-20">Та төлөлвлөгөөгөө сонгоно уу.</h2>
            <div class="grid md:grid-cols-3 gap-8">

                <!-- Free Plan -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Free</h3>
                    <p class="text-gray-600 mb-6">Туршилтаар хэрэглэхэ тохиромжтой.</p>
                    <div class="text-4xl font-bold text-gray-800 mb-4">Үнэгүй</div>
                    <p class="text-sm text-gray-500 mb-6">Сар бүр</p>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li>✔ Вэб аппликейшнд нэвтрэх</li>
                        <li>✔ Орлого болон зарлага хадгалах</li>
                        <li>✖ Санхүүгийн анализ</li>
                        <li>✖ Банкны холболт</li>
                    </ul>
                    <a href="{{ route('register') }}"
                        class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-600 text-center inline-block">
                        Бүртгүүлэх
                    </a>
                </div>

                <!-- Plus Plan -->
                <div class="bg-white rounded-lg shadow-lg p-6 border-4 border-blue-500">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Plus</h3>
                    <p class="text-gray-600 mb-6">Орлого зарлага бүртгэхэд тохиромжтой.</p>
                    <div class="text-4xl font-bold text-gray-800 mb-4">5000₮</div>
                    <p class="text-sm text-gray-500 mb-6">Сар бүр</p>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li>✔ Вэб аппликейшнд нэвтрэх</li>
                        <li>✔ Орлого болон зарлага хадгалах</li>
                        <li>✔ Санхүүгийн анализ</li>
                        <li>✖ Банкны холболт</li>
                    </ul>
                    <button class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                        Түвшин ахиулах
                    </button>
                </div>

                <!-- Gold Plan -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Gold Тун удахгүй</h3>
                    <p class="text-gray-600 mb-6">Мэргэжлийн түвшин.</p>
                    <div class="text-4xl font-bold text-gray-800 mb-4">20000₮</div>
                    <p class="text-sm text-gray-500 mb-6">Сар бүр</p>
                    <ul class="text-gray-600 mb-6 space-y-2">
                        <li>✔ Вэб аппликейшнд нэвтрэх</li>
                        <li>✔ Орлого болон зарлага хадгалах</li>
                        <li>✔ Санхүүгийн анализ</li>
                        <li>✔ Банкны холболт</li> Тун удахгүй
                    </ul>
                    <button class="bg-blue-900 text-[#FFD700] px-6 py-2 rounded-lg hover:bg-blue-600">
                        Алтан хэрэглэгч болох
                    </button>
                </div>

            </div>
        </div>
    </div>


    <footer class="bg-[#1D3557] text-white py-12">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Section -->
            <div>
                <h2 class="text-2xl font-bold text-white mb-4">Санхүүгээ үр ашигтайгаар удирдаж эхлээрэй</h2>
                <p class="text-base text-gray-400 leading-relaxed mb-6">
                    Өөрийн санхүүгийн төлөвлөгөөг хялбархан удирдаарай.
                </p>
                <p class="text-sm text-gray-400">
                    © 2025 Personal Budget. All rights reserved.
                </p>
            </div>

            <!-- Right Section -->
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="text" placeholder="Нэр"
                        class="bg-gray-800 border border-gray-700 text-white px-5 py-3 rounded-lg w-full focus:ring-2 focus:ring-yellow-500 transition duration-300" />
                    <input type="email" placeholder="И-мэйл хаяг бичих"
                        class="bg-gray-800 border border-gray-700 text-white px-5 py-3 rounded-lg w-full focus:ring-2 focus:ring-yellow-500 transition duration-300" />
                </div>
                <textarea placeholder="Энд мессежээ бичнэ үү..."
                    class="bg-gray-800 border border-gray-700 text-white px-5 py-3 rounded-lg w-full h-32 resize-none mt-4 focus:ring-2 focus:ring-yellow-500 transition duration-300"></textarea>
                <button
                    class="w-full bg-yellow-500 text-gray-900 font-medium px-8 py-3 rounded-lg hover:bg-yellow-600 transition duration-300 mt-4">
                    Илгээх
                </button>
            </div>

            <!-- Social Media -->
            <div class="col-span-1 md:col-span-2 flex justify-center space-x-6 mt-6">
                <a href="#" class="text-yellow-500 hover:text-white transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-yellow-500 hover:text-white transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-yellow-500 hover:text-white transition">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="text-yellow-500 hover:text-white transition">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </footer>



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
