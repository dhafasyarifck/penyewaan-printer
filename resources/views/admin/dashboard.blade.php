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

    <!-- Form Filter -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date">Tanggal Akhir:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
        </div>
    </form>

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
        // Data penyewaan per hari
        var rentalData = {!! json_encode(array_values($dailyRentals)) !!};
        var rentalLabels = {!! json_encode(array_keys($dailyRentals)) !!};

        if (rentalData.length > 0) {
            var ctx = document.getElementById('rentalChart').getContext('2d');
            var rentalChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: rentalLabels,
                    datasets: [{
                        label: 'Penyewaan per Hari',
                        data: rentalData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        } else {
            console.warn('Tidak ada data untuk ditampilkan di chart.');
        }
    </script>
</div>
@endsection
