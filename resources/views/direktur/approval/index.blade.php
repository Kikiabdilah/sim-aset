@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Approval Direktur</h3>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status Manager</th>
                <th>Status Direktur</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($usulan as $row)
            <tr>
                <td>{{ $row->kd_brg }}</td>
                <td>{{ $row->nm_brg }}</td>
                <td>{{ $row->jmlh_brg }}</td>
                <td>{{ number_format($row->harga_brg) }}</td>

                {{-- STATUS MANAGER --}}
                <td>
                    @if($row->stts_approval_mg == 'approved')
                    <span class="badge bg-success">Approved</span>
                    @elseif($row->stts_approval_mg == 'rejected')
                    <span class="badge bg-danger">Rejected</span>
                    @else
                    <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>

                {{-- STATUS DIREKTUR --}}
                <td>
                    @if($row->stts_approval_dir == 'approved')
                    <span class="badge bg-success">Approved</span>
                    @elseif($row->stts_approval_dir == 'rejected')
                    <span class="badge bg-danger">Rejected</span>
                    @else
                    <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
<td class="d-flex gap-2">

    @if($row->stts_approval_mg != 'approved')
        <span class="badge bg-warning text-dark">Menunggu Manager</span>

    @elseif($row->stts_approval_mg == 'approved' && $row->stts_approval_dir == 'pending')

        <form method="POST" action="{{ route('direktur.approval.approve', $row->id) }}">
            @csrf
            <button class="btn btn-success btn-sm">Accept</button>
        </form>

        <form method="POST" action="{{ route('direktur.approval.reject', $row->id) }}">
            @csrf
            <button class="btn btn-danger btn-sm">Decline</button>
        </form>

    @else
        <button class="btn btn-secondary btn-sm" disabled>DONE</button>
    @endif

</td>


            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No Data Pending.</td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>
@endsection