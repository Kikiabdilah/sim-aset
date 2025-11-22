@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-3">Usulan Pengadaan Aset</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <a href="{{ route('admin.usulan.create') }}" class="btn btn-primary mb-3">+ Tambah Usulan</a>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Usulan</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Manager</th>
                        <th>Direktur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usulan as $u)
                    <tr>
                        <td>{{ $u->kd_usulan }}</td>
                        <td>{{ $u->nm_brg }}</td>
                        <td>{{ $u->jmlh_brg }}</td>
                        <td>{{ $u->created_at->format('Y-m-d') }}</td>

                        <td>
                            @if ($u->stts_approval_mg == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($u->stts_approval_mg == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>

                        <td>
                            @if ($u->stts_approval_dir == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($u->stts_approval_dir == 'approved')
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
@endsection
