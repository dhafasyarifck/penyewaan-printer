@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Selamat datang di Sistem Penyewaan PT Mitra Copierindo Mandiri!</p>

    <a href="{{ route('devices.index') }}" class="btn btn-primary">Lihat Perangkat</a>
    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Lihat Penyewaan</a>
</div>
@endsection