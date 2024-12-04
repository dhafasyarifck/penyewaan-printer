@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Rental</h1>

    <div class="mb-3">
        <img src="{{ asset('images/devices/' . $rental->device->image) }}" alt="{{ $rental->device->name }}" class="img-fluid mb-3">
    </div>
    <p><strong>Nama Penyewa:</strong> {{ $rental->atas_nama }}</p>
    <p><strong>Perangkat:</strong> {{ $rental->device->name }}</p>
    <p><strong>Jumlah:</strong> {{ $rental->quantity }}</p>
    <p><strong>Tanggal Rental:</strong> {{ \Carbon\Carbon::parse($rental->rental_date)->format('d/m/Y') }}</p>
    <p><strong>Tanggal Pengembalian:</strong> {{ \Carbon\Carbon::parse($rental->return_date)->format('d/m/Y') }}</p>
    <p><strong>Status:</strong> {{ $rental->status }}</p>
    <p><strong>Harga Sewa:</strong> Rp {{ number_format($rental->device->rental_price, 0, ',', '.') }}</p>
    <p><strong>Alamat Pengiriman:</strong> {{ $rental->alamat }}</p>
    <p><strong>No. Telepon:</strong> {{ $rental->no_telp }}</p>

    <a href="{{ route('rentals.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
