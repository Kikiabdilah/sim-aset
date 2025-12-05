@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Riwayat Maintenance: {{ $aset->nm_brg }}</h3>

        <a href="{{ route('maintenance.create', $aset->id) }}" class="btn btn-success mt-2 mb-3">
            + Add Maintenance
        </a>
        {{-- Back ke daftar maintenance --}}
        <a href="{{ route('maintenance.index') }}" class="btn btn-secondary mb-3 mt-2">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Biaya</th>
                <th>Catatan</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $r)
            <tr>
                <td>{{ date('d/m/Y', strtotime($r->tgl_maintenance)) }}</td>
                <td>{{ $r->jenis }}</td>
                <td>Rp {{ number_format($r->biaya) }}</td>
                <td>{{ $r->catatan }}</td>
                <td>
                    @if ($r->bukti)
                    <a href="{{ asset('storage/' . $r->bukti) }}" target="_blank">Lihat</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada riwayat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection