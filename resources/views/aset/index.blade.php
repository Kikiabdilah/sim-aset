@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Daftar Aset Disetujui</h3>

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
                <input type="date" name="tanggal_awal" class="form-control"
                       value="{{ request('tanggal_awal') }}">
            </div>

            {{-- TANGGAL AKHIR --}}
            <div class="col-md-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control"
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Umur Ekonomis</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($aset as $row)
            <tr>
                <td>{{ $row->kd_brg }}</td>
                <td>{{ $row->nm_brg }}</td>
                <td>{{ $row->jmlh_brg }}</td>
                <td>{{ $row->masa_manfaat }}</td>
                <td>{{ number_format($row->harga_brg) }}</td>
                <td>{{ number_format($row->jmlh_brg * $row->harga_brg) }}</td>
<td>{{ \Carbon\Carbon::parse($row->tgl_approval_dir)->format('d/m/Y') }}</td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada aset ditemukan.</td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>
@endsection
