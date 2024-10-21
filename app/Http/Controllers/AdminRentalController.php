<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class AdminRentalController extends Controller
{
    public function index()
    {
        // Mengambil semua rental dengan relasi ke perangkat dan pengguna
        $rentals = Rental::with('device', 'user')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    public function edit($id)
    {
        // Mengambil rental berdasarkan ID
        $rental = Rental::findOrFail($id);
        return view('admin.rentals.edit', compact('rental'));
    }

    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);
        $request->validate([
            'status' => 'required|in:pending,approved,rejected', // Misalnya status yang diperbolehkan
        ]);

        $rental->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.rentals.index')->with('success', 'Status rental berhasil diupdate.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected', // Sesuaikan dengan status yang Anda miliki
        ]);

        $rental = Rental::findOrFail($id);
        $rental->status = $request->status;
        $rental->save();

        return redirect()->route('admin.rentals.index')->with('success', 'Status rental berhasil diperbarui.');
    }
}
