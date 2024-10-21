<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

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
            'stock' => 'required|integer',
            'rental_price' => 'required|numeric',
        ]);

        Device::create($request->all());
        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil ditambahkan.');
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'rental_price' => 'required|numeric',
            'available' => 'boolean', // Validasi untuk kolom available
        ]);

        $device->update($request->all());
        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil diupdate.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Perangkat berhasil dihapus.');
    }
}