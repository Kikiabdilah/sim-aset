@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Approval Manager</h3>

    {{-- SWEETALERT2 SUCCESS NOTIF --}}
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 1800,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Status</th>
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

                <td>
                    @if($row->stts_approval_mg == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($row->stts_approval_mg == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>

                <td class="d-flex gap-2">

                    @if($row->stts_approval_mg == 'pending')

                        {{-- BUTTON APPROVE --}}
                        <form method="POST" class="approveForm" action="{{ route('manager.approval.approve', $row->id) }}">
                            @csrf
                            <button type="button" class="btn btn-success btn-sm approveBtn">Accept</button>
                        </form>

                        {{-- BUTTON REJECT --}}
                        <form method="POST" class="rejectForm" action="{{ route('manager.approval.reject', $row->id) }}">
                            @csrf
                            <button type="button" class="btn btn-danger btn-sm rejectBtn">Decline</button>
                        </form>

                    @else
                        <button class="btn btn-secondary btn-sm" disabled>DONE</button>
                    @endif

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No Data Pending.</td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

{{-- SweetAlert2 Confirmation Script --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {

        // APPROVE CONFIRMATION
        document.querySelectorAll('.approveBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                let form = this.closest('form');

                Swal.fire({
                    title: 'Yakin menyetujui?',
                    text: "Usulan akan di-ACC oleh Manager!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Accept',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // REJECT CONFIRMATION
        document.querySelectorAll('.rejectBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                let form = this.closest('form');

                Swal.fire({
                    title: 'Yakin menolak?',
                    text: "Usulan akan ditolak oleh Manager!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Reject',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    });
</script>

@endsection
