@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center fw-bold display-5">Sales Report Dashboard</h1>

    <!-- Summary Cards -->
    <div class="row mb-5 g-4">
        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-cash-coin fs-1 text-primary"></i>
                    </div>
                    <h6 class="text-muted">Total Sales</h6>
                    <h2 class="fw-bold text-info">₱{{ number_format($totalSales, 2) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h6 class="text-muted text-center mb-3">Sales Per Region</h6>
                    <ul class="list-group list-group-flush">
                        @foreach ($salesPerRegion as $region)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $region['region_name'] }}</span>
                                <span class="fw-bold text-secondary">{{ number_format($region['total_units']) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-bag-check fs-1 text-success"></i>
                    </div>
                    <h6 class="text-muted">Total Number of Sales</h6>
                    <h2 class="fw-bold text-warning">{{ $salesCount }}</h2>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Charts -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 text-center fw-bold fs-5 py-3">
                    Total Sales Per Date
                </div>
                <div class="card-body">
                    <canvas id="salesPerMonthChart" height="230"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 text-center fw-bold fs-5 py-3">
                    Sales Count by Region
                </div>
                <div class="card-body">
                    <canvas id="salesPerRegionChart" height="230"></canvas>
                </div>
            </div>
        </div>

        
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Sales Per Region Chart
const salesPerRegionCtx = document.getElementById('salesPerRegionChart').getContext('2d');
new Chart(salesPerRegionCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($salesPerRegion->pluck('region_name')) !!},
        datasets: [{
            label: 'Units Sold',
            data: {!! json_encode($salesPerRegion->pluck('total_units')) !!},
            backgroundColor: 'rgba(21, 42, 160, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            borderRadius: 6,
        }]
    },
    options: {
        animation: {
            duration: 1200,
            easing: 'easeOutBounce'
        },
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Sales Per Month Chart
const salesPerMonthCtx = document.getElementById('salesPerMonthChart').getContext('2d');
new Chart(salesPerMonthCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(
            $salesPerMonth->map(fn($item) => \Carbon\Carbon::parse($item->month)->format('d-m-Y'))
        ) !!},
        datasets: [{
            label: 'Units Sold',
            data: {!! json_encode($salesPerMonth->pluck('total_units')) !!},
            backgroundColor: 'rgba(97, 34, 197, 0.61)',
            borderColor: 'rgb(98, 0, 255)',
            pointBackgroundColor: 'rgb(192, 137, 75)',
            fill: true,
            tension: 0.4,
        }]
    },
    options: {
        animation: {
            duration: 1500,
            easing: 'easeInOutQuart'
        },
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    maxRotation: 45,
                    minRotation: 45,
                }
            },
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
