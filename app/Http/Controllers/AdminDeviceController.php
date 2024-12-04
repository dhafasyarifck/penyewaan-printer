<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminDeviceController extends Controller
{
    // Menampilkan semua perangkat
    public function index()
    {
        $devices = Device::all();
        return view('admin.devices.index', compact('devices'));
    }

    // Menampilkan form untuk membuat perangkat baru
    public function create()
    {
        return view('admin.devices.create');
    }

    // Menyimpan perangkat baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'paper_size' => 'required|string|max:50',
            'print_resolution' => 'required|string|max:50',
            'print_speed' => 'required|string|max:50',
            'print_result' => 'required|string|max:50',
            'capacity' => 'required|integer',
            'recommended_volume' => 'required|integer',
            'power_consumption' => 'required|string|max:50',
            'connectivity' => 'required|string|max:50',
            'stock' => 'required|integer',
            'rental_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'available' => 'nullable|boolean',
        ]);

        $data = $request->all();

        // Menangani upload gambar
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/devices'), $imageName);
            $data['image'] = $imageName;
        }

        Device::create($data);

        return redirect()->route('admin.devices.index')->with('success', 'Perangkat berhasil ditambahkan.');
    }

    // Menampilkan detail perangkat
    public function show(Device $device)
    {
        return view('admin.devices.show', compact('device'));
    }

    // Menampilkan form untuk mengedit perangkat
    public function edit(Device $device)
    {
        return view('admin.devices.edit', compact('device'));
    }

    // Mengupdate perangkat di database
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'paper_size' => 'required|string|max:50',
            'print_resolution' => 'required|string|max:50',
            'print_speed' => 'required|string|max:50',
            'print_result' => 'required|string|max:50',
            'capacity' => 'required|integer',
            'recommended_volume' => 'required|integer',
            'power_consumption' => 'required|string|max:50',
            'connectivity' => 'required|string|max:50',
            'stock' => 'required|integer',
            'rental_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'available' => 'nullable|boolean',
        ]);

        $data = $request->all();

        // Menangani update gambar
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/devices'), $imageName);

            // Menghapus gambar lama jika ada
            if ($device->image && File::exists(public_path('images/devices/' . $device->image))) {
                File::delete(public_path('images/devices/' . $device->image));
            }

            $data['image'] = $imageName;
        }

        $device->update($data);

        return redirect()->route('admin.devices.index')->with('success', 'Perangkat berhasil diupdate.');
    }

    // Menghapus perangkat dari database
    public function destroy(Device $device)
    {
        // Menghapus gambar terkait jika ada
        if ($device->image && File::exists(public_path('images/devices/' . $device->image))) {
            File::delete(public_path('images/devices/' . $device->image));
        }

        $device->delete();

        return redirect()->route('admin.devices.index')->with('success', 'Perangkat berhasil dihapus.');
    }

    public function exportPdf()
    {
        try {
            $devices = Device::all(); // Ambil semua data perangkat
            $pdf = PDF::loadView('admin.devices.pdf', compact('devices'));
            return $pdf->download('laporan_perangkat.pdf');
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
