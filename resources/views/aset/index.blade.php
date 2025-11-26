@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="text-2xl font-bold">Daftar Aset</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr class="table-primary">
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Umur Ekonomis</th>
                <th>Harga</th>
                <th>Total</th>
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
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada aset yang disetujui.</td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>
@endsection
