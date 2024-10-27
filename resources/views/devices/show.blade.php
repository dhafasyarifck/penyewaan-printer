@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Perangkat</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $device->name }}</h5>
            @if($device->image)
                <img src="{{ asset('images/devices/' . $device->image) }}" width="200" alt="Gambar {{ $device->name }}">
            @else
                <p>Tidak ada gambar</p>
            @endif
            <p><strong>Ukuran Kertas:</strong> {{ $device->paper_size }}</p>
            <p><strong>Resolusi Cetak:</strong> {{ $device->print_resolution }}</p>
            <p><strong>Kecepatan Cetak:</strong> {{ $device->print_speed }}</p>
            <p><strong>Hasil Print:</strong> {{ $device->print_result }}</p>
            <p><strong>Kapasitas Cetak:</strong> {{ $device->capacity }}</p>
            <p><strong>Volume Bulanan yang Direkomendasikan:</strong> {{ $device->recommended_volume }}</p>
            <p><strong>Konsumsi Daya:</strong> {{ $device->power_consumption }}</p>
            <p><strong>Jenis Konektivitas:</strong> {{ $device->connectivity }}</p>
            <p><strong>Stok:</strong> {{ $device->stock }}</p>
            <p><strong>Harga Sewa:</strong> Rp {{ number_format($device->rental_price, 2) }}</p>
            <p><strong>Status Ketersediaan:</strong> {{ $device->available ? 'Tersedia' : 'Tidak Tersedia' }}</p>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>

            <!-- Tombol Sewa -->
            <a href="{{ route('rentals.create', $device->id) }}" class="btn btn-primary">Sewa</a>

        </div>
    </div>
</div>
@endsection
