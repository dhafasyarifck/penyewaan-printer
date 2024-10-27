@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Perangkat</h1>

    <form action="{{ route('admin.devices.update', $device->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Perangkat</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $device->name) }}" required>
        </div>

        <div class="form-group">
            <label for="paper_size">Ukuran Kertas</label>
            <input type="text" name="paper_size" id="paper_size" class="form-control" value="{{ old('paper_size', $device->paper_size) }}">
        </div>

        <div class="form-group">
            <label for="print_resolution">Resolusi Cetak</label>
            <input type="text" name="print_resolution" id="print_resolution" class="form-control" value="{{ old('print_resolution', $device->print_resolution) }}">
        </div>

        <div class="form-group">
            <label for="print_speed">Kecepatan Cetak</label>
            <input type="text" name="print_speed" id="print_speed" class="form-control" value="{{ old('print_speed', $device->print_speed) }}">
        </div>

        <div class="form-group">
            <label for="print_result">Hasil Print</label>
            <input type="text" name="print_result" id="print_result" class="form-control" value="{{ old('print_result', $device->print_result) }}">
        </div>

        <div class="form-group">
            <label for="capacity">Kapasitas Cetak per Bulan</label>
            <input type="text" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $device->capacity) }}">
        </div>

        <div class="form-group">
            <label for="recommended_volume">Volume Bulanan yang Direkomendasikan</label>
            <input type="text" name="recommended_volume" id="recommended_volume" class="form-control" value="{{ old('recommended_volume', $device->recommended_volume) }}">
        </div>

        <div class="form-group">
            <label for="power_consumption">Konsumsi Daya</label>
            <input type="text" name="power_consumption" id="power_consumption" class="form-control" value="{{ old('power_consumption', $device->power_consumption) }}">
        </div>

        <div class="form-group">
            <label for="connectivity">Jenis Konektivitas</label>
            <input type="text" name="connectivity" id="connectivity" class="form-control" value="{{ old('connectivity', $device->connectivity) }}">
        </div>

        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $device->stock) }}" required>
        </div>

        <div class="form-group">
            <label for="rental_price">Harga Sewa</label>
            <input type="number" name="rental_price" id="rental_price" class="form-control" step="0.01" value="{{ old('rental_price', $device->rental_price) }}" required>
        </div>

        <div class="form-group">
            <label for="available">Ketersediaan</label>
            <select name="available" id="available" class="form-control">
                <option value="1" {{ $device->available ? 'selected' : '' }}>Tersedia</option>
                <option value="0" {{ !$device->available ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Gambar Perangkat (opsional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if ($device->image)
                <small>Gambar saat ini: {{ $device->image }}</small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Perangkat</button>
        <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
