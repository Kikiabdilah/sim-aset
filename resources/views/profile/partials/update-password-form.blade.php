<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />

            <div class="relative">
                <x-text-input id="current_password" name="current_password"
                    type="password"
                    class="mt-1 block w-full pr-10"
                />

                <i class="bi bi-eye-slash absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-500"
                   onclick="togglePassword('current_password', this)"></i>
            </div>

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
        </div>

        {{-- New Password --}}
        <div>
            <x-input-label for="password" :value="__('New Password')" />

            <div class="relative">
                <x-text-input id="password" name="password"
                    type="password"
                    class="mt-1 block w-full pr-10"
                />

                <i class="bi bi-eye-slash absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-500"
                   onclick="togglePassword('password', this)"></i>
            </div>

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation" name="password_confirmation"
                    type="password"
                    class="mt-1 block w-full pr-10"
                />

                <i class="bi bi-eye-slash absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-500"
                   onclick="togglePassword('password_confirmation', this)"></i>
            </div>

            <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
