<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Logo --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/pt.ina.png') }}" alt="Logo Perusahaan" class="h-28 object-contain">
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username"
                type="text"
                class="block mt-1 w-full"
                required autofocus />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

                <i class="bi bi-eye-slash absolute top-1/2 right-3 -translate-y-1/2
                   cursor-pointer text-gray-500"
                   onclick="togglePassword('password', this)"></i>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm
                       focus:ring-indigo-500 cursor-pointer"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <!-- Login Button -->
        <x-primary-button class="mt-4 w-full">
            Log in
        </x-primary-button>

        <!-- Forgot Password -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>

        <!-- Register Link -->
        <div class="flex items-center justify-end mt-3">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('register') }}">
                Don’t have an account? Register
            </a>
        </div>
    </form>
</x-guest-layout>

<script>
    function togglePassword(id, icon) {
        const input = document.getElementById(id);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
