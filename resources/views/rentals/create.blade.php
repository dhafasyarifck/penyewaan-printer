@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Rental Baru</h1>

    <form action="{{ route('rentals.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="device_id" class="form-label">Pilih Perangkat</label>
        <select class="form-control" id="device_id" name="device_id" required>
            @foreach ($devices as $device)
                <option value="{{ $device->id }}">{{ $device->name }} (Stok: {{ $device->stock }})</option>
            @endforeach
        </select>
    </div>

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
