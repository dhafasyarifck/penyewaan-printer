@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Daftar Rentals</h2>
        <a href="{{ route('rentals.create') }}" class="btn btn-primary">Create Rental</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Device</th>
                <th>Quantity</th>
                <th>Rental Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rental->device->name }}</td>
                    <td>{{ $rental->quantity }}</td>
                    <td>{{ $rental->rental_date }}</td>
                    <td>{{ $rental->return_date }}</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                    <td>
                <a href="{{ route('rentals.show', $rental->id) }}" class="btn btn-info btn-sm">View</a>
                
                @if ($rental->status == 'pending') <!-- Pengecekan status -->
                    <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-warning btn-sm">Edit</a>
                @else
                    <span class="text-muted">Tidak bisa edit</span> <!-- Pesan jika tidak bisa edit -->
                @endif
            </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
