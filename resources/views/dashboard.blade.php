@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="dashboard-heading mt-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="chart-title">Nilai Rata-rata Mahasiswa</h2>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="chart-title">Jumlah Mahasiswa Pertahun</h2>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #def4ff;
    }

    .dashboard-heading {
        font-size: 2rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #495057;
        margin-bottom: 20px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: rgba(161, 161, 161, 0.19); /* Warna kartu dengan transparansi 19% */
    }

    .card-body {
        padding: 20px;
    }

    /* Gaya umum untuk grafik */
    .chart-container {
        position: relative;
        margin: auto;
        height: 40vh;
        width: 80vw;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" crossorigin="anonymous"></script>
<script>
    // Pie Chart
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['A', 'B', 'C', 'D', 'E'],
            datasets: [{
                data: [32.6, 27.2, 16.3, 12, 12],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });

    // Line Chart
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['2020', '2021', '2022', '2023', '2024'],
            datasets: [{
                label: 'Jumlah Mahasiswa Pertahun',
                data: [200, 180, 250, 260, 210],
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 50
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endsection
