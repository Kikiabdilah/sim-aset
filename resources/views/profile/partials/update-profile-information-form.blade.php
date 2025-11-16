<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profil Pengguna
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Perbarui data akun anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="nama_pegawai" value="Nama Pegawai" />
            <x-text-input id="nama_pegawai" name="nama_pegawai" type="text"
                class="mt-1 block w-full"
                :value="old('nama_pegawai', $user->nama_pegawai)" required />
            <x-input-error class="mt-2" :messages="$errors->get('nama_pegawai')" />
        </div>

        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text"
                class="mt-1 block w-full"
                :value="old('username', $user->username)" required />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
