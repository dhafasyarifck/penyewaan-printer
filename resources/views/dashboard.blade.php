@extends('layouts.app')

@section('content')
<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>
<div class="container">
    <h1>Dashboard Pelanggan</h1>
    <p>Selamat datang di Sistem Penyewaan PT Mitra Copierindo Mandiri!</p>

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
        @forelse($devices as $device)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/devices/' . ($device->image ?? 'default.jpg')) }}" 
                         class="card-img-top img-fluid" 
                         alt="{{ $device->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $device->name }}</h5>
                        <p class="card-text">Harga Sewa: Rp {{ number_format($device->rental_price, 2) }}</p>
                        <p class="card-text">Stok Tersedia: {{ $device->stock }}</p>
                        <a href="{{ route('devices.show', $device->id) }}" 
                           class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada perangkat tersedia saat ini.</p>
        @endforelse
    </div>
    
  
</div>
@endsection
