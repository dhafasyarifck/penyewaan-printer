<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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
            'status' => 'required|in:Menunggu Verifikasi,Pesanan Diterima,Pesanan Ditolak,Sedang Masa Penyewaan,Selesai Penyewaan', // Sesuaikan dengan status yang Anda miliki
        ]);

        $rental = Rental::findOrFail($id);
        $rental->status = $request->status;
        $rental->save();

        return redirect()->route('admin.rentals.index')->with('success', 'Status rental berhasil diperbarui.');
    }

    public function generatePdf($id)
    {
        // Ambil data rental berdasarkan ID dengan relasi
        $rental = Rental::with(['device', 'user'])->findOrFail($id);

        // Cek apakah device dan user terhubung
        if (!$rental->device || !$rental->user) {
            return redirect()->route('admin.rentals.index')
                ->with('error', 'Data rental tidak lengkap. Tidak dapat membuat PDF.');
        }

        // Pastikan data rental sudah ada dan valid
        if ($rental) {
            // Render PDF menggunakan view
            $pdf = PDF::loadView('admin.rentals.pdf', compact('rental'));

            // Unduh file PDF dengan nama yang sesuai
            $filename = "Rental_{$rental->id}.pdf";
            return $pdf->download($filename);
        }

        // Jika rental tidak ditemukan
        return redirect()->route('admin.rentals.index')
            ->with('error', 'Rental tidak ditemukan.');
    }
}
