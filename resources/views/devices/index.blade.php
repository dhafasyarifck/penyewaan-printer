@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Perangkat</h1>
    <a href="{{ route('devices.create') }}" class="btn btn-primary">Tambah Perangkat</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Harga Sewa</th>
                <th>Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $device)
            <tr>
                <td>{{ $device->name }}</td>
                <td>{{ $device->description }}</td>
                <td>{{ $device->stock }}</td>
                <td>Rp {{ number_format($device->rental_price, 2) }}</td>
                <td>{{ $device->available ? 'Ya' : 'Tidak' }}</td>
                <td>
                    <a href="{{ route('devices.edit', $device) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('devices.destroy', $device) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection