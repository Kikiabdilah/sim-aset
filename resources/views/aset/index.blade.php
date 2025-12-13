@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">

    <div class="px-4">
        <h3 class="fw-bold fs-4 mb-3">Daftar Aset</h3>

        {{-- FILTER --}}
        <div class="card p-3 mb-4">
            <form method="GET" action="{{ route('aset.index') }}" class="row g-3">

                <div class="col-md-4">
                    <label class="form-label fw-bold">Cari Barang</label>
                    <input type="text" name="search" class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau kode barang...">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Tanggal Awal</label>
                    <input type="text" class="form-control" id="tanggal_awal"
                        name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Tanggal Akhir</label>
                    <input type="text" class="form-control" id="tanggal_akhir"
                        name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                </div>

                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('aset.index') }}" class="btn btn-secondary">Reset</a>
                </div>

            </form>
        </div>
    </div>

    {{-- TABLE SCROLL --}}
    <div class="table-scroll px-4">
        <table class="table table-bordered table-hover align-middle">

            <thead class="table-light text-center">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Umur</th>
                    <th>Harga</th>
                    <th>Nilai Sisa</th>
                    <th>Penyusutan</th>
                    <th>Akumulasi</th>
                    <th>Nilai Buku</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($aset as $index => $row)
                <tr>
                    <td class="text-center">{{ $aset->firstItem() + $index }}</td>
                    <td class="text-center">{{ $row->kd_brg }}</td>
                    <td>{{ $row->nm_brg }}</td>
                    <td class="text-center">{{ $row->tgl_pengadaan_formatted }}</td>
                    <td class="text-center">{{ $row->masa_manfaat }} Th</td>

                    <td class="text-end text-nowrap">Rp {{ number_format($row->harga_brg,0,',','.') }}</td>
                    <td class="text-end text-nowrap">Rp {{ number_format($row->nilai_sisa,0,',','.') }}</td>
                    <td class="text-end text-nowrap">Rp {{ number_format($row->penyusutan_tahunan,0,',','.') }}</td>
                    <td class="text-end text-nowrap">Rp {{ number_format($row->akumulasi_penyusutan,0,',','.') }}</td>
                    <td class="text-end text-nowrap">Rp {{ number_format($row->nilai_buku,0,',','.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="px-4 mt-3 d-flex justify-content-between align-items-center">
        <div class="text-muted">
            Menampilkan {{ $aset->firstItem() }} - {{ $aset->lastItem() }}
            dari {{ $aset->total() }} data
        </div>
        {{ $aset->links('pagination::bootstrap-5') }}
    </div>

</div>

<script>
    flatpickr("#tanggal_awal", { dateFormat: "d/m/Y" });
    flatpickr("#tanggal_akhir", { dateFormat: "d/m/Y" });
</script>
@endsection
