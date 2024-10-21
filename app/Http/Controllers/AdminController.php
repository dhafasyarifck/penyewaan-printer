<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Rental;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung total perangkat
        $totalDevices = Device::count();

        // Hitung total penyewaan
        $totalRentals = Rental::count();

        // Ambil 5 penyewaan terbaru
        $recentRentals = Rental::with('device')->latest()->take(5)->get();

        // Data penyewaan bulanan (contoh berdasarkan bulan berjalan)
        $monthlyRentals = Rental::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        return view('admin.dashboard', compact('totalDevices', 'totalRentals', 'recentRentals', 'monthlyRentals'));
    }

}
