@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Perangkat</h1>
    <form action="{{ route('devices.update', $device) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $device->name }}" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $device->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ $device->stock }}" required>
        </div>
        <div class="form-group">
            <label>Harga Sewa</label>
            <input type="number" step="0.01" name="rental_price" class="form-control" value="{{ $device->rental_price }}" required>
        </div>
        <div class="form-group">
            <label>Tersedia</label>
            <select name="available" class="form-control">
                <option value="1" {{ $device->available ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ !$device->available ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection