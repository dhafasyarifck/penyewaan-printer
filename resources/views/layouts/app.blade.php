<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penyewaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            
            background-size: cover; /* Menutupi seluruh latar belakang */
            background-position: center; /* Mengatur posisi gambar */
            background-repeat: no-repeat; /* Mencegah gambar diulang */
        }
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Mitra Copierindo</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <!-- Item Menu Khusus Admin -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.devices.index') }}">Kelola Perangkat</a>
                            </li>
                            <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.rentals.index') }}">Manajemen Rental</a> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLaporan" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownLaporan">
                                <li><a class="dropdown-item" href="{{ route('admin.reports.devices') }}">Laporan Perangkat</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.reports.rentals') }}">Laporan Rental</a></li>
                            </ul>
                        </li>
                    </li>

                        @else
                            <!-- Item Menu Khusus Pelanggan -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rentals.index') }}">Rental Saya</a>
                            </li>
                            
                            
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Notifikasi Kesalahan -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Notifikasi Kesalahan Validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3" style="background-color: #f1f1f1;">
            © {{ date('Y') }} Mitra Copierindo. All rights reserved.
            <a class="text-dark" href="#">Privacy Policy</a> | 
            <a class="text-dark" href="#">Terms of Service</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
