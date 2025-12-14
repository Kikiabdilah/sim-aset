@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Approval Manager</h3>

    {{-- SWEETALERT2 SUCCESS NOTIF --}}
    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                <td>{{ number_format($row->harga_brg,0,',','.') }}</td>

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

                    <button class="btn btn-info btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalReview{{ $row->id }}">
                        Review
                    </button>

                    @if($row->stts_approval_mg == 'pending')

                    <form method="POST" class="approveForm"
                        action="{{ route('manager.approval.approve', $row->id) }}">
                        @csrf
                        <button type="button" class="btn btn-success btn-sm approveBtn">
                            Accept
                        </button>
                    </form>

                    <form method="POST" class="rejectForm"
                        action="{{ route('manager.approval.reject', $row->id) }}">
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm rejectBtn">
                            Decline
                        </button>
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

    {{-- ================== MODAL REVIEW SEMUA DATA ================== --}}
    @foreach ($usulan as $row)
    <div class="modal fade" id="modalReview{{ $row->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Detail Aset — {{ $row->nm_brg }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered">

                        <tr>
                            <th>Kode Usulan</th>
                            <td>{{ $row->kd_usulan }}</td>
                        </tr>

                        <tr>
                            <th>Kode Barang</th>
                            <td>{{ $row->kd_brg }}</td>
                        </tr>

                        <tr>
                            <th>Nama Barang</th>
                            <td>{{ $row->nm_brg }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Barang</th>
                            <td>{{ $row->jns_brg }}</td>
                        </tr>

                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $row->jmlh_brg }}</td>
                        </tr>

                        <tr>
                            <th>Harga Satuan</th>
                            <td>Rp {{ number_format($row->harga_brg,0,',','.') }}</td>
                        </tr>

                        <tr>
                            <th>Total Harga</th>
                            <td><strong>Rp {{ number_format($row->harga_brg * $row->jmlh_brg,0,',','.') }}</strong></td>
                        </tr>

                        <tr>
                            <th>Tanggal Pengadaan</th>
                            <td>{{ $row->tgl_pengadaan ? \Carbon\Carbon::parse($row->tgl_pengadaan)->format('d/m/Y') : '-' }}</td>
                        </tr>

                        <tr>
                            <th>Satuan</th>
                            <td>{{ $row->satuan_brg }}</td>
                        </tr>

                        <tr>
                            <th>Masa Manfaat</th>
                            <td>{{ $row->masa_manfaat }}</td>
                        </tr>

                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $row->ket }}</td>
                        </tr>

                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>
    @endforeach


</div>


{{-- SWEETALERT SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll('.approveBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                let form = this.closest('form');

                Swal.fire({
                    title: 'Yakin menyetujui?',
                    text: "Usulan akan di-ACC oleh Manager!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Accept',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        document.querySelectorAll('.rejectBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                let form = this.closest('form');

                Swal.fire({
                    title: 'Yakin menolak?',
                    text: "Usulan akan ditolak oleh Manager!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Reject',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });

    });
</script>

@endsection