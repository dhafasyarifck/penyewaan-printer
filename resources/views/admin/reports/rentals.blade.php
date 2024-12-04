@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Manajemen Rental</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.reports.rentals') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="user_name" class="form-control" placeholder="Nama Penyewa" value="{{ request('user_name') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="rental_date" class="form-control" value="{{ request('rental_date') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Status --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.reports.rentals') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Perangkat</th>
                <th>Username Penyewa</th>
                <th>Atas Nama Penyewa</th>
                <th>Tanggal Sewa</th>
                <th>Akhir Sewa</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->device->name }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->atas_nama }}</td>
                    <td>{{ $rental->rental_date }}</td>
                    <td>{{ $rental->return_date }}</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                    <td>
                        <a href="{{ route('admin.rentals.pdf', $rental->id) }}" class="btn btn-success btn-sm">Print</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
