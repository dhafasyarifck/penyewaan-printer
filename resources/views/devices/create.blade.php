@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Perangkat</h1>
    <form action="{{ route('devices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga Sewa</label>
            <input type="number" step="0.01" name="rental_price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tersedia</label>
            <select name="available" class="form-control">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection