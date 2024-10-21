@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Rental</h1>

    <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="device_id" class="form-label">Perangkat</label>
            <select name="device_id" id="device_id" class="form-control">
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" 
                        {{ $device->id == $rental->device_id ? 'selected' : '' }}>
                        {{ $device->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="form-control" 
                   value="{{ $rental->quantity }}" required>
        </div>

        <div class="mb-3">
            <label for="rental_date" class="form-label">Tanggal Rental</label>
            <input type="date" name="rental_date" id="rental_date" class="form-control" 
                   value="{{ $rental->rental_date }}" required>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Tanggal Pengembalian</label>
            <input type="date" name="return_date" id="return_date" class="form-control" 
                   value="{{ $rental->return_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Rental</button>
    </form>
</div>
@endsection
