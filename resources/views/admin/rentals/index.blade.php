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
                    <td>{{ ucfirst($rental->status) }}</td>
                    <td>
                        <form action="{{ route('admin.rentals.updateStatus', $rental->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="pending" @if($rental->status == 'pending') selected @endif>Pending</option>
                                <option value="approved" @if($rental->status == 'approved') selected @endif>Approved</option>
                                <option value="rejected" @if($rental->status == 'rejected') selected @endif>Rejected</option>
                                <option value="returned" @if($rental->status == 'returned') selected @endif>Returned</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
