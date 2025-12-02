@php
$user = auth()->user();
$role = $user?->role; // aman meskipun null
@endphp

{{-- Jika user belum login, hentikan render sidebar --}}
@if (!$user)
    @php return; @endphp
@endif

<div class="bg-dark text-white p-3" style="width:260px; min-height:100vh;">

    {{-- Profile --}}
    <div class="text-center mb-4">
        @php
            $photo = $user->image
                ? asset('storage/' . $user->image)
                : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=0D8ABC&color=fff';
        @endphp

        <img src="{{ $photo }}"
            class="rounded-circle mb-2 d-block mx-auto"
            width="70"
            height="70"
            style="object-fit: cover;">

        <h6 class="mb-0">{{ ucwords($user->username) }}</h6>
    </div>

    {{-- MENU --}}
    <ul class="nav flex-column">

        {{-- Dashboard --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu
                {{ request()->is('dashboard') ? 'bg-secondary' : '' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        {{-- Admin --}}
        @if ($role == 1)
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu 
                {{ request()->routeIs('admin.usulan.create') ? 'bg-secondary' : '' }}"
                href="{{ route('admin.usulan.create') }}">
                <i class="bi bi-file-earmark-plus"></i> Usulan Pengadaan Aset
            </a>
        </li>
        @endif

        {{-- Manager --}}
        @if ($role == 2)
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu 
                {{ request()->routeIs('manager.approval.index') ? 'bg-secondary' : '' }}"
                href="{{ route('manager.approval.index') }}">
                <i class="bi bi-check2-circle"></i> Approval Manager
            </a>
        </li>
        @endif

        {{-- Direktur --}}
        @if ($role == 3)
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu 
                {{ request()->routeIs('direktur.approval.index') ? 'bg-secondary' : '' }}"
                href="{{ route('direktur.approval.index') }}">
                <i class="bi bi-check2-square"></i> Approval Direktur
            </a>
        </li>
        @endif

        {{-- Daftar Aset --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="{{ route('aset.index') }}">
                <i class="bi bi-box-seam"></i> Daftar Aset
            </a>
        </li>

        {{-- Pemeliharaan --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-hammer"></i> Pemeliharaan Aset
            </a>
        </li>

        {{-- Rekomendasi Penghapusan --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-trash"></i> Rekomendasi Penghapusan
            </a>
        </li>

        {{-- Laporan --}}
        <li class="nav-item">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan
            </a>
        </li>

    </ul>

</div>

<style>
.hover-menu:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transition: 0.2s;
}
</style>
