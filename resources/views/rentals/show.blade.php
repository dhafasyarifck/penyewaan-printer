@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Rental</h1>

    <p><strong>Perangkat:</strong> {{ $rental->device->name }}</p>
    <p><strong>Jumlah:</strong> {{ $rental->quantity }}</p>
    <p><strong>Tanggal Rental:</strong> {{ $rental->rental_date }}</p>
    <p><strong>Tanggal Pengembalian:</strong> {{ $rental->return_date }}</p>
    <p><strong>Status:</strong> {{ $rental->status }}</p>

    <a href="{{ route('rentals.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
