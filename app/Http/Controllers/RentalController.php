<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Rental;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('device')->where('user_id', Auth::id())->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create($id)
    {
        $device = Device::findOrFail($id);

        if (!$device->available) {
            return back()->with('error', 'Perangkat ini tidak tersedia untuk disewa.');
        }

        return view('rentals.create', compact('device'));
    }

    public function show($id)
    {
        $rental = Rental::with('device')->findOrFail($id);
        return view('rentals.show', compact('rental'));
    }

    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        $device = Device::findOrFail($rental->device_id);
        return view('rentals.edit', compact('rental', 'device'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'quantity' => 'required|integer|min:1',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rental_date',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'atas_nama' => 'required|string|max:100',
        ]);

        $rental = Rental::findOrFail($id);
        $rental->update([
            'device_id' => $request->device_id,
            'quantity' => $request->quantity,
            'rental_date' => $request->rental_date,
            'return_date' => $request->return_date,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'atas_nama' => $request->atas_nama,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'quantity' => 'required|integer|min:1',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rental_date',
            'delivery_date' => 'nullable|date',
            'delivery_time' => 'nullable|date_format:H:i',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'atas_nama' => 'required|string|max:100',
        ]);

        $device = Device::find($request->device_id);
        if ($device->stock < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok perangkat tidak cukup.']);
        }

        DB::transaction(function () use ($request, $device) {
            $device->decrement('stock', $request->quantity);

            Rental::create([
                'user_id' => Auth::id(),
                'device_id' => $request->device_id,
                'quantity' => $request->quantity,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
                'delivery_date' => $request->delivery_date,
                'delivery_time' => $request->delivery_time,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'atas_nama' => $request->atas_nama,
                'status' => 'Menunggu Verifikasi',
            ]);
        });

        return redirect()->route('rentals.index')->with('success', 'Rental berhasil dibuat.');
    }

    public function generatePdf($id)
    {
        // Ambil data rental berdasarkan ID dengan relasi
        $rental = Rental::with(['device', 'user'])->findOrFail($id);

        // Cek apakah device dan user terhubung
        if (!$rental->device || !$rental->user) {
            return redirect()->route('rentals.index')
                ->with('error', 'Data rental tidak lengkap. Tidak dapat membuat PDF.');
        }

        // Pastikan data rental sudah ada dan valid
        if ($rental) {
            // Render PDF menggunakan view
            $pdf = PDF::loadView('rentals.pdf', compact('rental'));

            // Unduh file PDF dengan nama yang sesuai
            $filename = "Rental_{$rental->id}.pdf";
            return $pdf->download($filename);
        }

        // Jika rental tidak ditemukan
        return redirect()->route('rentals.index')
            ->with('error', 'Rental tidak ditemukan.');
    }
}
