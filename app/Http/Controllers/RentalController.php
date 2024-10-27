<?php

namespace App\Http\Controllers;

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
    // Mengambil perangkat berdasarkan ID dan memeriksa ketersediaannya
    $device = Device::findOrFail($id); // Mengambil perangkat berdasarkan ID

    if (!$device->available) {
        return back()->with('error', 'Perangkat ini tidak tersedia untuk disewa.');
    }

    return view('rentals.create', compact('device')); // Mengirimkan data perangkat ke tampilan
}

    public function show($id)
{
    $rental = Rental::with('device')->findOrFail($id);
    return view('rentals.show', compact('rental'));
}

public function edit($id)
{
    $rental = Rental::findOrFail($id); // Ambil rental berdasarkan ID
    $device = Device::findOrFail($rental->device_id); // Ambil device berdasarkan device_id dari rental
    return view('rentals.edit', compact('rental', 'device'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'device_id' => 'required|exists:devices,id',
        'quantity' => 'required|integer|min:1',
        'rental_date' => 'required|date',
        'return_date' => 'required|date|after_or_equal:rental_date',
    ]);

    $rental = Rental::findOrFail($id);
    $rental->update([
        'device_id' => $request->device_id,
        'quantity' => $request->quantity,
        'rental_date' => $request->rental_date,
        'return_date' => $request->return_date,
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
    ]);

    $device = Device::find($request->device_id);
    if ($device->stock < $request->quantity) {
        return redirect()->back()->withErrors(['quantity' => 'Stok perangkat tidak cukup.']);
    }

    DB::transaction(function () use ($request, $device) {
        // Mengurangi stok perangkat
        $device->decrement('stock', $request->quantity);

        // Membuat entry rental
        Rental::create([
            'user_id' => Auth::id(),
            'device_id' => $request->device_id,
            'quantity' => $request->quantity,
            'rental_date' => $request->rental_date,
            'return_date' => $request->return_date,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
            'status' => 'pending',
        ]);
    });

    return redirect()->route('rentals.index')->with('success', 'Rental berhasil dibuat.');
}
}
