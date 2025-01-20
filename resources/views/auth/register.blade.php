<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="px-6 py-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Бүртгүүлэх') }}</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Нэр')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="name" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('И-мэйл хаяг')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="email" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Нууц үг')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Нууц үгээ баталгаажуулах')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password_confirmation" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-blue-900 hover:text-blue-900 underline focus:outline-none focus:ring-2 focus:ring-blue-900" href="{{ route('login') }}">
                        {{ __('Өмнө нь бүртгүүлсэн үү?') }}
                    </a>
                    <x-primary-button class="px-6 py-2 text-white bg-blue-900 hover:bg-blue-900 focus:ring-2 focus:ring-blue-900 rounded-lg">
                        {{ __('Бүртгүүлэх') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
