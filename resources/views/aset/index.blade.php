@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="font-bold text-2xl">Daftar Aset</h3>

    {{-- FILTER FORM --}}
    <div class="card p-3 mt-3 mb-4">
        <form method="GET" action="{{ route('aset.index') }}" class="row g-3">

            {{-- SEARCH --}}
            <div class="col-md-4">
                <label class="form-label">Cari Barang</label>
                <input type="text" name="search" class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau kode barang...">
            </div>

            {{-- TANGGAL AWAL --}}
            <div class="col-md-3">
                <label class="form-label">Tanggal Awal</label>
                <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}">
            </div>

            {{-- TANGGAL AKHIR --}}
            <div class="col-md-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}">
            </div>

            {{-- BUTTONS --}}
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('aset.index') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Pembelian</th>
                    <th>Umur Ekonomis</th>
                    <th>Harga</th>
                    <th>Nilai Sisa</th>
                    <th>Penyusutan Tahunan</th>
                    <th>Akumulasi Penyusutan</th>
                    <th>Nilai Buku</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($aset as $row)
                <tr>
                    <td></td>
                    <td>{{ $row->kd_brg }}</td>
                    <td>
                        {{ $row->nm_brg }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($row->tgl_pengadaan ?: $row->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $row->masa_manfaat }} tahun</td>
                    <td>Rp {{ number_format($row->harga_brg, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->nilai_sisa, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->penyusutan_tahunan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->akumulasi_penyusutan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->nilai_buku, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center">Tidak ada aset ditemukan.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>


</div>

<script>
    flatpickr("#tanggal_awal", {
        dateFormat: "d/m/Y"
    });

    flatpickr("#tanggal_akhir", {
        dateFormat: "d/m/Y"
    });
</script>
@endsection
