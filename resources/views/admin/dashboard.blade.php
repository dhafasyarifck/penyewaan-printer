@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Admin</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Perangkat</h5>
                    <p class="card-text">{{ $totalDevices }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Penyewaan</h5>
                    <p class="card-text">{{ $totalRentals }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Penyewaan Terbaru</h5>
                    <ul>
                        @foreach($recentRentals as $rental)
                            <li>{{ $rental->device->name }} - {{ $rental->created_at->diffForHumans() }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <canvas id="rentalChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('rentalChart').getContext('2d');
        var rentalChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($monthlyRentals)) !!}, // Label bulan
                datasets: [{
                    label: 'Penyewaan per Bulan',
                    data: {!! json_encode(array_values($monthlyRentals)) !!}, // Data penyewaan
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
@endsection
