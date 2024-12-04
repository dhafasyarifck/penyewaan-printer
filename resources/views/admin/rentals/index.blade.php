@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen Rental</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Perangkat</th>
                <th>Nama Penyewa</th>
                <th>Tanggal Sewa</th>
                <th>Akhir Sewa</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->id }}</td>
                    <td>{{ $rental->device->name }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->rental_date }}</td>
                    <td>{{ $rental->return_date }}</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                    <td>
                        <form action="{{ route('admin.rentals.updateStatus', $rental->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="Menunggu Verifikasi" @if($rental->status == 'Menunggu Verifikasi') selected @endif>Menunggu Verifikasi</option>
                                <option value="Pesanan Diterima" @if($rental->status == 'Pesanan Diterima') selected @endif>Pesanan Diterima</option>
                                <option value="Pesanan Ditolak" @if($rental->status == 'Pesanan Ditolak') selected @endif>Pesanan Ditolak</option>
                                <option value="Sedang Masa Penyewaan" @if($rental->status == 'Sedang Masa Penyewaan') selected @endif>Sedang Masa Penyewaan</option>
                                <option value="Selesai Penyewaan" @if($rental->status == 'Selesai Penyewaan') selected @endif>Selesai Penyewaan</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
