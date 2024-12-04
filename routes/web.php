<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\AdminRentalController;
use App\Http\Controllers\AdminDeviceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Arahkan '/' ke login jika belum login
Route::get('/', function () {
    return redirect()->route('login'); // Arahkan ke login sebagai halaman utama
});

// Routes untuk Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Routes untuk Rentals (CRUD hanya untuk Pelanggan)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes untuk Devices
    Route::resource('devices', DeviceController::class)->names([
        'index' => 'devices.index',
        'create' => 'devices.create',
        'store' => 'devices.store',
        'show' => 'devices.show',
        'edit' => 'devices.edit',
        'update' => 'devices.update',
        'destroy' => 'devices.destroy',
        

        
    ]);
    // Rute untuk menyewa perangkat
Route::post('devices/{device}/rent', [DeviceController::class, 'rent'])->name('devices.rent');
   


   // Routes untuk Rental
Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index'); // Daftar rental
Route::get('/rentals/create/{id}', [RentalController::class, 'create'])->name('rentals.create'); // Form tambah rental
Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store'); // Proses penyimpanan rental baru
Route::get('/rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show'); // Detail rental
Route::get('/rentals/{rental}/edit', [RentalController::class, 'edit'])->name('rentals.edit'); // Form untuk mengedit rental
Route::put('/rentals/{rental}', [RentalController::class, 'update'])->name('rentals.update'); // Proses pembaruan rental
Route::delete('/rentals/{rental}', [RentalController::class, 'destroy'])->name('rentals.destroy'); // Proses penghapusan rental
Route::get('/rentals/{id}/pdf', [RentalController::class, 'generatePdf'])->name('rentals.pdf')->middleware('auth'); // Generate PDF
});



// Route untuk Dashboard Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/rentals', [AdminRentalController::class, 'index'])->name('admin.rentals.index');
    Route::get('/admin/rentals/{id}/edit', [AdminRentalController::class, 'edit'])->name('admin.rentals.edit');
    Route::put('/admin/rentals/{id}', [AdminRentalController::class, 'update'])->name('admin.rentals.update');
    Route::patch('/admin/rentals/{rental}/status', [AdminRentalController::class, 'updateStatus'])->name('admin.rentals.updateStatus');
    Route::get('/admin/rentals/{id}/pdf', [AdminRentalController::class, 'generatePdf'])->name('admin.rentals.pdf');
    Route::get('/admin/devices/export-pdf', [AdminDeviceController::class, 'exportPdf'])->name('admin.devices.exportPdf');
    Route::resource('admin/devices', AdminDeviceController::class)->names([
        'index' => 'admin.devices.index',
        'create' => 'admin.devices.create',
        'store' => 'admin.devices.store',
        'show' => 'admin.devices.show',
        'edit' => 'admin.devices.edit',
        'update' => 'admin.devices.update',
        'destroy' => 'admin.devices.destroy',
    ]);
    Route::get('/reports/devices', [ReportController::class, 'devices'])->name('admin.reports.devices');
    Route::get('/reports/rentals', [ReportController::class, 'rentals'])->name('admin.reports.rentals');

    
});
