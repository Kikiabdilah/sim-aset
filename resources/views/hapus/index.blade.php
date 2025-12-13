@extends('layouts.app')

@section('content')

<body class="bg-light">
    <div class="container mt-4">

        <h4 class="mb-3">
            <i class="bi bi-trash"></i> Rekomendasi Penghapusan Aset (MAUT)
        </h4>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Rank</th>
                            <th>Nama Aset</th>
                            <th>Sisa Umur</th>
                            <th>Akumulasi</th>
                            <th>Nilai Buku</th>
                            <th>Kondisi</th>
                            <th>Nilai MAUT</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasil as $i => $row)
                        <tr>
                            <td class="text-center fw-bold">{{ $i + 1 }}</td>
                            <td>{{ $row['aset']->nm_brg }}</td>

                            {{-- BOBOT --}}
                            <td class="text-center">{{ $row['aset']->bobot_sisa_umur }}</td>
                            <td class="text-center">{{ $row['aset']->bobot_akumulasi }}</td>
                            <td class="text-center">{{ $row['aset']->bobot_nilai_buku }}</td>
                            <td class="text-center">{{ $row['aset']->bobot_kondisi }}</td>

                            <td class="text-center fw-bold">{{ $row['nilai_maut'] }}</td>

                            <td class="text-center">
                                @if ($row['layak'])
                                <span class="badge bg-danger">LAYAK DIHAPUS</span>
                                @else
                                <span class="badge bg-success">BELUM LAYAK</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</body>
@endsection