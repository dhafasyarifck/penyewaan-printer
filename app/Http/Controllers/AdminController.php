<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Data penyewaan harian
        $dailyRentals = Rental::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date')
            ->toArray();

        return view('admin.dashboard', compact('totalDevices', 'totalRentals', 'recentRentals', 'dailyRentals'));
    }
}
