@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Perangkat</h1>

    <form action="{{ route('admin.devices.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Perangkat</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="paper_size" class="form-label">Ukuran Kertas</label>
            <input type="text" class="form-control" id="paper_size" name="paper_size" value="{{ old('paper_size') }}" required>
            @error('paper_size')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="print_resolution" class="form-label">Resolusi Cetak</label>
            <input type="text" class="form-control" id="print_resolution" name="print_resolution" value="{{ old('print_resolution') }}" required>
            @error('print_resolution')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="print_speed" class="form-label">Kecepatan Cetak</label>
            <input type="text" class="form-control" id="print_speed" name="print_speed" value="{{ old('print_speed') }}" required>
            @error('print_speed')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="print_result" class="form-label">Hasil Print</label>
            <input type="text" class="form-control" id="print_result" name="print_result" value="{{ old('print_result') }}" required>
            @error('print_result')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">Kapasitas Cetak</label>
            <input type="text" class="form-control" id="capacity" name="capacity" value="{{ old('capacity') }}" required>
            @error('capacity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="recommended_volume" class="form-label">Volume Bulanan yang Direkomendasikan</label>
            <input type="text" class="form-control" id="recommended_volume" name="recommended_volume" value="{{ old('recommended_volume') }}" required>
            @error('recommended_volume')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="power_consumption" class="form-label">Konsumsi Daya</label>
            <input type="text" class="form-control" id="power_consumption" name="power_consumption" value="{{ old('power_consumption') }}" required>
            @error('power_consumption')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="connectivity" class="form-label">Jenis Konektivitas</label>
            <input type="text" class="form-control" id="connectivity" name="connectivity" value="{{ old('connectivity') }}" required>
            @error('connectivity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rental_price" class="form-label">Harga Sewa</label>
            <input type="number" class="form-control" id="rental_price" name="rental_price" value="{{ old('rental_price') }}" required step="0.01">
            @error('rental_price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Perangkat</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.devices.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
