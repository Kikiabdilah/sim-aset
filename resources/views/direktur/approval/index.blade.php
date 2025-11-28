@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Approval Direktur</h3>

    {{-- ALERT SWEETALERT2 SUCCESS --}}
    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session("success") }}',
                confirmButtonColor: '#3085d6',
            })
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
                <th>Status Manager</th>
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

                <td class="d-flex gap-2">

                    {{-- Manager belum approve => direktur tidak bisa apa-apa --}}
                    @if($row->stts_approval_mg != 'approved')
                    <span class="badge bg-warning text-dark">Menunggu Manager</span>

                    {{-- Manager sudah approve => Direktur baru bisa approve/reject --}}
                    @elseif($row->stts_approval_dir == 'pending')

                    <button class="btn btn-info btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalReview{{ $row->id }}">
                        Review
                    </button>

                    {{-- BUTTON APPROVE --}}
                    <button class="btn btn-success btn-sm"
                        onclick="confirmApproval(`{{ route('direktur.approval.approve', $row->id) }}`)">
                        Accept
                    </button>

                    {{-- BUTTON DECLINE --}}
                    <button class="btn btn-danger btn-sm"
                        onclick="confirmReject(`{{ route('direktur.approval.reject', $row->id) }}`)">
                        Decline
                    </button>

                    {{-- Jika direktur sudah approve/reject --}}
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
                        <th>Jumlah</th>
                        <td>{{ $row->jmlh_brg }}</td>
                    </tr>

                    <tr>
                        <th>Harga Satuan</th>
                        <td>Rp {{ number_format($row->harga_brg) }}</td>
                    </tr>

                    <tr>
                        <th>Total Harga</th>
                        <td><strong>Rp {{ number_format($row->harga_brg * $row->jmlh_brg) }}</strong></td>
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
{{-- SWEETALERT2 SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // APPROVE
    function confirmApproval(url) {
        Swal.fire({
            title: "Yakin?",
            text: "Anda akan menyetujui usulan ini.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Accept"
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                let csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // REJECT
    function confirmReject(url) {
        Swal.fire({
            title: "Yakin?",
            text: "Anda akan menolak usulan ini.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Reject"
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                let csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                form.appendChild(csrf);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection