@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4">Dashboard</h1>

{{-- CARD TOTAL ASET AKTIF --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-primary">
            <div class="card-body text-center">
                <h5 class="text-primary fw-bold">Aset Aktif</h5>
                <h2 class="fw-bold" id="totalAsetAktif">145</h2> {{-- dummy --}}
            </div>
        </div>
    </div>
</div>

{{-- PIE CHART ASET --}}
<div class="card shadow-sm">
    <div class="card-header fw-semibold">
        Diagram Kategori Aset
    </div>

    <div class="card-body flex justify-content-center w-50 mx-auto">
        <canvas id="pieChartAset"></canvas>
    </div>
</div>


{{-- SCRIPT PIE CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('pieChartAset').getContext('2d');

    // Dummy data kategori aset
    const dataPie = {
        labels: ['Elektronik', 'Furniture', 'Kendaraan', 'Alat Kantor', 'Lainnya'],
        datasets: [{
            data: [45, 30, 15, 10, 5], // dummy jumlah aset
            backgroundColor: [
                '#0d6efd', // biru
                '#198754', // hijau
                '#ffc107', // kuning
                '#d63384', // pink
                '#6c757d'  // abu
            ],
            borderWidth: 1
        }]
    };

    new Chart(ctx, {
        type: 'pie',
        data: dataPie,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endsection
