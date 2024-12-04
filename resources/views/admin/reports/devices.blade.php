@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Perangkat</h1>
    <a href="{{ route('admin.devices.exportPdf') }}" class="btn btn-danger mb-3">Cetak PDF</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Perangkat</th>
                <th>Stok</th>
                <th>Harga Sewa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $index => $device)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->stock }}</td>
                   
                    <td>Rp {{ number_format($device->rental_price, 2) }}</td>
                    <td>
                        <a href="{{ route('devices.show', $device->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('devices.destroy', $device->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus perangkat ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
