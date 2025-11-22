@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Usulan Pengadaan</h4>

    <form action="{{ route('admin.usulan.store') }}" method="POST">
        @csrf

        {{-- Kode Aset --}}
        <label>Kode Aset</label>
        <input type="text" name="kd_brg" class="form-control" required>

        {{-- Nama Aset --}}
        <label class="mt-2">Nama Aset</label>
        <input type="text" name="nm_brg" class="form-control" required>

        {{-- Jumlah --}}
        <label class="mt-2">Jumlah</label>
        <input type="number" name="jmlh_brg" class="form-control" required>

        {{-- Harga --}}
        <label class="mt-2">Harga</label>
        <input type="number" name="harga_brg" class="form-control" required>

        {{-- Satuan --}}
        <label class="mt-2">Satuan</label>
        <select name="satuan_brg" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="Unit">Unit</option>
            <option value="Set">Set</option>
            <option value="Pcs">Pcs</option>
        </select>

        {{-- Umur Ekonomis --}}
        <label class="mt-2">Umur Ekonomis</label>
        <input type="number" name="masa_manfaat" class="form-control" required>

        {{-- Keterangan --}}
        <label class="mt-2">Keterangan</label>
        <textarea name="ket" class="form-control"></textarea>

        {{-- Tombol --}}
        <button class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
