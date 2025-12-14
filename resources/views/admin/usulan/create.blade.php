@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-3 fw-bold">Usulan Pengadaan Aset</h4>

    {{-- FORM INPUT --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white fw-semibold py-2">
            Tambah Usulan Aset
        </div>

        <div class="card-body">
            <form action="{{ route('admin.usulan.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-2">
                    <div class="col-md-2">
                        <label class="form-label">Kode Aset</label>
                        <input type="text" name="kd_brg" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Aset</label>
                        <input type="text" name="nm_brg" class="form-control" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jmlh_brg" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Satuan</label>
                        <select name="satuan_brg" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Unit">Unit</option>
                            <option value="Set">Set</option>
                            <option value="Pcs">Pcs</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-2">
                    <div class="col-md-3">
                        <label class="form-label">Jenis Barang</label>
                        <select name="jns_brg" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Bangunan">Bangunan</option>
                            <option value="Kendaraan">Kendaraan</option>
                            <option value="Peralatan Kantor">Peralatan Kantor</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Harga</label>
                        <input type="text" id="harga_brg" name="harga_brg"
                            class="form-control"
                            placeholder="Contoh: 15000000" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tanggal Pengadaan</label>
                        <input type="date" name="tgl_pengadaan" id="tgl_pengadaan" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Umur Ekonomis (Tahun)</label>
                        <input type="number" name="masa_manfaat" class="form-control" min="1" required>
                    </div>
                </div>

                {{-- BARIS 3 --}}
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Keterangan</label>
                        <textarea name="ket" class="form-control" rows="2"
                            placeholder="Opsional, jelaskan kondisi atau kebutuhan aset"></textarea>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>

    </div>

    {{-- TABLE LIST --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-semibold py-2">
            Daftar Usulan Aset
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0 align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th style="width: 130px;">Kode Usulan</th>
                            <th>Nama Barang</th>
                            <th style="width: 90px;">Jumlah</th>
                            <th style="width: 120px;">Tanggal</th>
                            <th style="width: 120px;">Manager</th>
                            <th style="width: 120px;">Direktur</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($usulan as $u)
                        <tr>
                            <td>{{ $u->kd_usulan }}</td>
                            <td>{{ $u->nm_brg }}</td>
                            <td>{{ $u->jmlh_brg }}</td>
                            <td>{{ $u->created_at->format('d-m-Y') }}</td>

                            {{-- Manager --}}
                            <td>
                                @if ($u->stts_approval_mg == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($u->stts_approval_mg == 'approved')
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>

                            {{-- Direktur --}}
                            <td>
                                @if ($u->stts_approval_dir == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($u->stts_approval_dir == 'approved')
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<script>
    flatpickr("#tgl_pengadaan", {
        dateFormat: "d/m/Y"
    });

    const hargaInput = document.getElementById('harga_brg');

    hargaInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>

@endsection