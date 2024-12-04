<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Rental;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan perangkat.
     */
    public function devices()
    {
        $devices = Device::all(); // Ambil semua data perangkat
        return view('admin.reports.devices', compact('devices'));
    }

    /**
     * Menampilkan laporan rental.
     */
    public function rentals()
    {
        $rentals = Rental::with('device', 'user')->get(); // Ambil data rental dengan relasi
        return view('admin.reports.rentals', compact('rentals'));
    }

   
}
