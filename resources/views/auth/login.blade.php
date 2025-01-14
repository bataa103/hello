<x-guest-layout>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <div class="px-6 py-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{ __('Нэвтрэх') }}</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-600 text-sm" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('И-мэйл хаяг')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="email" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Нууц үг')" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="password" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-700">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2">{{ __('Намайг сана') }}</span>
                    </label>
                </div>

                <!-- Forgot Password & Submit Button -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 underline focus:outline-none focus:ring-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Нууц үгээ мартсан уу?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3 px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 rounded-lg">
                        {{ __('Нэвтрэх') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
