@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Aset untuk Maintenance</h3>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Tanggal Pengadaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $a)
            <tr>
                <td>{{ $a->kd_brg }}</td>
                <td>{{ $a->nm_brg }}</td>
                <td>{{ $a->jns_brg }}</td>
                <td>{{ date('d/m/Y', strtotime($a->tgl_pengadaan)) }}</td>
                <td>
                    <a href="{{ route('maintenance.show', $a->id) }}" class="btn btn-primary btn-sm">
                        Lihat Riwayat
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
