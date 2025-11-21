@php
    $role = auth()->user()->role; // 1 = admin, 2 = manager, 3 = direktur
@endphp

{{-- SIDEBAR --}}
<div class="bg-dark text-white p-3" style="width:260px; min-height:100vh;">

    {{-- Profile --}}
    <div class="text-center mb-4">
        <img src="https://ui-avatars.com/api/?name={{ ucwords(auth()->user()->username) }}&background=0D8ABC&color=fff"
            class="rounded-circle mb-2 d-block mx-auto"
            width="70"
            height="70">

        <h6 class="mb-0">{{ ucwords(auth()->user()->username) }}</h6>
    </div>

    {{-- Menu --}}
    <ul class="nav flex-column">

        {{-- Dashboard (semua role) --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu
                {{ request()->is('dashboard') ? 'bg-secondary' : '' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        {{-- Usulan Pengadaan Aset (semua role) --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-file-earmark-plus"></i> Usulan Pengadaan Aset
            </a>
        </li>

        {{-- Penambahan / Pengadaan Aset (hanya Admin = role 1) --}}
        @if ($role == 1)
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-bag-plus"></i> Penambahan / Pengadaan Aset
            </a>
        </li>
        @endif

        {{-- Daftar Aset (semua role) --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-box-seam"></i> Daftar Aset
            </a>
        </li>

        {{-- Pemeliharaan Aset (semua role) --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-hammer"></i> Pemeliharaan Aset
            </a>
        </li>

        {{-- Rekomendasi Penghapusan (semua role) --}}
        <li class="nav-item mb-1">
            <a class="nav-link text-white d-flex align-items-center gap-2 px-2 rounded hover-menu"
                href="#">
                <i class="bi bi-trash"></i> Rekomendasi Penghapusan
            </a>
        </li>

        {{-- Laporan (semua role) --}}
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
