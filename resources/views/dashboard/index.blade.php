@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4">Dashboard</h1>

{{-- CARD TOTAL ASET AKTIF --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-primary">
            <div class="card-body text-center">
                <h5 class="text-primary fw-bold">Aset Aktif</h5>
                <h2 class="fw-bold" id="totalAsetAktif">{{ $totalAsetAktif }}</h2>
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

{{-- ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('pieChartAset').getContext('2d');

    // LABEL + DATA DARI CONTROLLER
    const labels = @json($labels);
    const dataPie = @json($data);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: dataPie,
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#ffc107',
                    '#d63384',
                    '#6c757d',
                    '#dc3545',
                    '#20c997'
                ],
                borderWidth: 1
            }]
        },
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