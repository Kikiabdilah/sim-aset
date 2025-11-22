@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Approval Direktur</h4>

    <table class="table">
        <tr>
            <th>Kode Usulan</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>

        @foreach($data as $d)
        <tr>
            <td>{{ $d->kd_usulan }}</td>
            <td>{{ $d->nm_brg }}</td>
            <td>{{ $d->jmlh_brg }}</td>
            <td>
                <a href="{{ route('direktur.approval.approve', $d->id) }}" class="btn btn-success btn-sm">Approve</a>
                <a href="{{ route('direktur.approval.reject', $d->id) }}" class="btn btn-danger btn-sm">Reject</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
