<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Gambar Perusahaan --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/pt.ina.png') }}" alt="Logo Perusahaan" class="h-28 object-contain">
    </div>


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="username">Username</label>
            <input id="username" class="block mt-1 w-full"
                type="text"
                name="username"
                required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-gray-600 cursor-pointer">{{ __('Remember me') }}</span>
            </label>
        </div>

        <x-primary-button class="mt-4 w-full">
            {{ __('Log in') }}
        </x-primary-button>
        
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

        </div>
        {{-- Link ke Register --}}
        <div class="flex items-center justify-end mt-3">
            <a
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none"
                href="{{ route('register') }}">
                {{ __('Don`t have an account? Register') }}
            </a>
        </div>
    </form>
</x-guest-layout>