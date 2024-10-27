<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua perangkat dari database
        $devices = Device::all(); // Pertimbangkan pagination jika datanya banyak

        // Kirim data perangkat ke tampilan dashboard
        return view('dashboard', compact('devices'));
    }
}
