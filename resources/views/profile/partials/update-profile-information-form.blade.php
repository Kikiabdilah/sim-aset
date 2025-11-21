<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    {{-- FOTO PROFIL --}}
    <div class="text-center mb-4">
        <div class="d-flex justify-content-center mb-5">
            <img id="previewImage"
                src="{{ $user->image ? asset('storage/'.$user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama_pegawai) }}"
                class="rounded-circle shadow"
                width="130" height="130"
                style="object-fit: cover;">
        </div>

        <input type="file" id="imageInput" name="image" class="form-control border-2 p-2">
        @error('image')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- NAMA --}}
    <div class="mb-3">
        <label class="form-label fw-bold">Employee Name</label>
        <input type="text" class="form-control" name="nama_pegawai"
            value="{{ old('nama_pegawai', $user->nama_pegawai) }}">
        @error('nama_pegawai') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- USERNAME --}}
    <div class="mb-3">
        <label class="form-label fw-bold">Username</label>
        <input type="text" class="form-control" name="username"
            value="{{ old('username', $user->username) }}">
        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- NIK --}}
    <div class="mb-3">
        <label class="form-label fw-bold">NIK</label>
        <input type="text" class="form-control" name="nik"
            value="{{ old('nik', $user->nik) }}">
        @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">

        {{-- Tombol SAVE --}}
        <x-primary-button>
            Save
        </x-primary-button>

        {{-- tombol hapus foto --}}
        @if($user->image)
        <button formaction="{{ route('profile.delete-photo') }}"
            formmethod="POST"
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            @csrf
            @method('DELETE')
            Delete Photo
        </button>
        @endif
    </div>
</form>

<script>
    // preview foto otomatis
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('previewImage').src = URL.createObjectURL(file);
        }
    });
</script>