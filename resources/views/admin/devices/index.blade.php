@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Perangkat</h1>
    <a href="{{ route('admin.devices.create') }}" class="btn btn-primary mb-3">Tambah Perangkat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Harga Sewa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $index => $device)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $device->name }}</td>
                <td>
                    @if($device->image)
                        <img src="{{ asset('images/devices/' . $device->image) }}" width="100" alt="Gambar {{ $device->name }}">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>{{ $device->stock }}</td>
                <td>Rp {{ number_format($device->rental_price, 2) }}</td>
                <td>
    <a href="{{ route('admin.devices.edit', $device->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <a href="{{ route('admin.devices.show', $device->id) }}" class="btn btn-info btn-sm">Detail</a>
    <form action="{{ route('admin.devices.destroy', $device->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus perangkat ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
    </form>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
