@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">
            <i class="bi bi-tools me-2"></i> Tambah Maintenance
        </h3>

        <a href="{{ route('maintenance.show', $aset->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Aset: {{ $aset->nm_brg }}</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('maintenance.store', $aset->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- Tanggal --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Maintenance</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="tgl_maintenance" class="form-control" required>
                        </div>
                    </div>

                    {{-- Jenis --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Maintenance</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-wrench-adjustable-circle"></i></span>
                            <input type="text" name="jenis" class="form-control" placeholder="Contoh: Service AC, Ganti Oli, dll" required>
                        </div>
                    </div>

                    {{-- Biaya --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Biaya</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="biaya" class="form-control" placeholder="Masukkan biaya" min="0" required>
                        </div>
                    </div>

                    {{-- Catatan --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan (opsional)"></textarea>
                    </div>

                    {{-- Bukti Upload --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Upload Bukti (Opsional)</label>
                        <input type="file" name="bukti" class="form-control">
                        <div class="form-text">Format: JPG, PNG, PDF — Maks 2MB</div>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Save
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection