<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'paper_size' => 'required',
            'print_resolution' => 'required',
            'print_speed' => 'required',
            'print_result' => 'required',
            'capacity' => 'required',
            'recommended_volume' => 'required',
            'power_consumption' => 'required',
            'connectivity' => 'required',
            'stock' => 'required|integer',
            'rental_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'available' => 'boolean',
        ]);
        

        $data = $request->all();

        // Handle upload image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/devices'), $imageName);
            $data['image'] = $imageName;
        }

        Device::create($data);

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil ditambahkan.');
    }
    public function rent(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Menyimpan data sewa ke tabel rentals
        Rental::create([
            'device_id' => $device->id, // Menghubungkan perangkat dengan sewa
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil disewa.');
    }
    public function show(Device $device)
    {
        
        return view('devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required',
            'paper_size' => 'required',
            'print_resolution' => 'required',
            'print_speed' => 'required',
            'print_result' => 'required',
            'capacity' => 'required',
            'recommended_volume' => 'required',
            'power_consumption' => 'required',
            'connectivity' => 'required',
            'stock' => 'required|integer',
            'rental_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'available' => 'boolean',
        ]);

        $data = $request->all();

        // Handle image update
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/devices'), $imageName);

            // Delete old image if exists
            if ($device->image && File::exists(public_path('images/devices/' . $device->image))) {
                File::delete(public_path('images/devices/' . $device->image));
            }

            $data['image'] = $imageName;
        }

        $device->update($data);

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil diupdate.');
    }

    public function destroy(Device $device)
    {
        // Delete associated image if exists
        if ($device->image && File::exists(public_path('images/devices/' . $device->image))) {
            File::delete(public_path('images/devices/' . $device->image));
        }

        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil dihapus.');
    }
}
