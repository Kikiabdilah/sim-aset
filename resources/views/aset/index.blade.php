@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="font-bold text-2xl mb-3">Daftar Aset</h3>

    {{-- =======================
         FILTER FORM
    ======================== --}}
    <div class="card p-3 mb-4">
        <form method="GET" action="{{ route('aset.index') }}" class="row g-3">

            {{-- SEARCH --}}
            <div class="col-md-4">
                <label class="form-label fw-bold">Cari Barang</label>
                <input type="text" name="search" class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau kode barang...">
            </div>

            {{-- TANGGAL AWAL --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">Tanggal Awal</label>
                <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}" autocomplete="off">
            </div>

            {{-- TANGGAL AKHIR --}}
            <div class="col-md-3">
                <label class="form-label fw-bold">Tanggal Akhir</label>
                <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}" autocomplete="off">
            </div>

            {{-- BUTTON --}}
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('aset.index') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>
    </div>

    {{-- =======================
         TABLE LIST ASET
    ======================== --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>No</th>

                    {{-- HEADERS DENGAN SORTING --}}
                    @php
                        function sortLink($label, $field, $sort, $order) {
                            $newOrder = ($sort === $field && $order === 'asc') ? 'desc' : 'asc';
                            $arrow = '';

                            if ($sort === $field) {
                                $arrow = $order === 'asc' ? '↑' : '↓';
                            }

                            return '<a href="?sort='.$field.'&order='.$newOrder.'" class="text-decoration-none">
                                        '.$label.' '.$arrow.'
                                    </a>';
                        }
                    @endphp

                    <th>{!! sortLink('Kode', 'kd_brg', $sort, $order) !!}</th>
                    <th>{!! sortLink('Nama Barang', 'nm_brg', $sort, $order) !!}</th>
                    <th>{!! sortLink('Tanggal Pembelian', 'tgl_pengadaan', $sort, $order) !!}</th>
                    <th>{!! sortLink('Umur Ekonomis', 'masa_manfaat', $sort, $order) !!}</th>
                    <th>{!! sortLink('Harga', 'harga_brg', $sort, $order) !!}</th>
                    <th>Nilai Sisa</th>
                    <th>Penyusutan Tahunan</th>
                    <th>Akumulasi Penyusutan</th>
                    <th>Nilai Buku</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($aset as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>{{ $row->kd_brg }}</td>
                    <td>{{ $row->nm_brg }}</td>
                    <td>{{ $row->tgl_pengadaan_formatted }}</td>

                    <td>{{ $row->masa_manfaat }} tahun</td>

                    <td>Rp {{ number_format($row->harga_brg, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->nilai_sisa, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->penyusutan_tahunan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->akumulasi_penyusutan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($row->nilai_buku, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted">Tidak ada aset ditemukan.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

{{-- =======================
     FLATPICKR
======================= --}}
<script>
    flatpickr("#tanggal_awal", {
        dateFormat: "d/m/Y",
        defaultDate: "{{ request('tanggal_awal') }}"
    });

    flatpickr("#tanggal_akhir", {
        dateFormat: "d/m/Y",
        defaultDate: "{{ request('tanggal_akhir') }}"
    });
</script>

@endsection
