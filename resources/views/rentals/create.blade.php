@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Rental Baru untuk {{ $device->name }}</h1>
    
    <img src="{{ asset('images/devices/' . $device->image) }}" alt="{{ $device->name }}" class="img-fluid mb-3">

    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf
        <input type="hidden" name="device_id" value="{{ $device->id }}">
        
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
        </div>

        <div class="mb-3">
            <label for="rental_date" class="form-label">Tanggal Rental</label>
            <input type="date" class="form-control" id="rental_date" name="rental_date" required>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="return_date" name="return_date" required>
        </div>

        <div class="mb-3">
            <label for="delivery_date" class="form-label">Tanggal Pengiriman (Opsional)</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date">
        </div>

        <div class="mb-3">
            <label for="delivery_time" class="form-label">Waktu Pengiriman (Opsional)</label>
            <input type="time" class="form-control" id="delivery_time" name="delivery_time">
        </div>

        <button type="submit" class="btn btn-primary">Sewa</button>
    </form>
</div>
@endsection
