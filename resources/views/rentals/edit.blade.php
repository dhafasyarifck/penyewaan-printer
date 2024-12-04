@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Rental untuk {{ $device->name }}</h1>
    
    @if ($device->image)
        <img src="{{ asset('images/devices/' . $device->image) }}" alt="{{ $device->name }}" class="img-fluid mb-3">
    @endif

    <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="device_id" value="{{ $device->id }}">
        
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ $rental->quantity }}" min="1" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rental_date" class="form-label">Tanggal Rental</label>
            <input type="date" class="form-control @error('rental_date') is-invalid @enderror" id="rental_date" name="rental_date" value="{{ $rental->rental_date }}" required>
            @error('rental_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ $rental->return_date }}" required>
            @error('return_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_date" class="form-label">Tanggal Pengiriman (Opsional)</label>
            <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" id="delivery_date" name="delivery_date" value="{{ $rental->delivery_date }}">
            @error('delivery_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivery_time" class="form-label">Waktu Pengiriman (Opsional)</label>
            <input type="time" class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time" name="delivery_time" value="{{ $rental->delivery_time }}">
            @error('delivery_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ $rental->alamat }}">
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="no_telp" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ $rental->no_telp }}">
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="atas_nama" class="form-label">Atas Nama</label>
            <input type="text" class="form-control @error('atas_nama') is-invalid @enderror" id="atas_nama" name="atas_nama" value="{{ $rental->atas_nama }}">
            @error('atas_nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <button type="submit" class="btn btn-primary">Update Rental</button>
    </form>
</div>
@endsection
