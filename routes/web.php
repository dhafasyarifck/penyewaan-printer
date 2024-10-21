<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\AdminRentalController;
use Illuminate\Support\Facades\Route;

// Route untuk Dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Routes untuk Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Routes untuk Rentals (CRUD hanya untuk Pelanggan)
Route::middleware(['auth', 'user'])->group(function () {
    // Rute untuk menampilkan detail rental
    Route::get('/rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');

    // Rute untuk menampilkan daftar rental
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');

    // Rute untuk membuat rental baru
    Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');

    // Rute untuk edit dan update rental
    Route::get('/rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
    Route::put('/rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update');

    // Rute untuk menghapus rental (opsional, jika ingin)
    Route::delete('/rentals/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy');
});

// Route untuk Dashboard Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Routes untuk Manajemen Rentals Admin
    Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('admin.rentals.index');
    Route::get('/admin/rentals/{id}/edit', [AdminRentalController::class, 'edit'])->name('admin.rentals.edit');
    Route::put('/admin/rentals/{id}', [AdminRentalController::class, 'update'])->name('admin.rentals.update');

    // Rute untuk mengubah status rental
    Route::patch('/admin/rentals/{rental}/status', [AdminRentalController::class, 'updateStatus'])->name('admin.rentals.updateStatus');

    // Routes untuk Devices (CRUD hanya untuk Admin)
    Route::resource('devices', DeviceController::class);
});
