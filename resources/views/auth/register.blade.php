<x-guest-layout>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Gambar Perusahaan --}}
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/pt.ina.png') }}" alt="Logo Perusahaan" class="h-28 object-contain">
    </div>

    {{-- Form Register --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Username --}}
        <div>
            <label class="block font-medium text-sm text-gray-700">Username</label>
            <input
                name="username"
                value="{{ old('username') }}"
                required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md w-full">
            @error('username')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama Pegawai --}}
        <div>
            <label class="block font-medium text-sm text-gray-700">Nama Pegawai</label>
            <input
                name="nama_pegawai"
                value="{{ old('nama_pegawai') }}"
                required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md w-full">
            @error('nama_pegawai')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- NIK --}}
        <div>
            <label class="block font-medium text-sm text-gray-700">NIK</label>
            <input
                name="nik"
                value="{{ old('nik') }}"
                required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md w-full">
            @error('nik')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="block font-medium text-sm text-gray-700">Password</label>
            <input
                type="password"
                name="password"
                required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md w-full">
        </div>

        {{-- Confirm Password --}}
        <div>
            <label class="block font-medium text-sm text-gray-700">Confirm Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md w-full">
        </div>

        {{-- Role --}}
        <div>
            <label class="block font-medium text-sm text-gray-700">Role</label>
            <select
                name="role"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md w-full">
                <option value="1">Admin</option>
                <option value="2">Manajer</option>
                <option value="3">Direktur</option>
            </select>
        </div>

        {{-- Tombol --}}
        <x-primary-button class="w-full">
            {{ __('Register') }}
        </x-primary-button>

        <a
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md justify-end flex "
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

    </form>
</x-guest-layout>