<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Cek level pengguna
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai admin!');
            } elseif ($user->role === 'pelanggan') { // Tambahkan kondisi untuk pelanggan
                return redirect()->route('dashboard')->with('success', 'Login berhasil sebagai pelanggan!');
            }
    
            // Tambahkan penanganan untuk role lain jika ada
            return redirect()->route('')->with('success', 'Login berhasil!');
        }
    
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,pelanggan', // Validasi role
    ]);

    // Tambahkan log untuk mengecek input
    \Log::info('Role yang dipilih:', ['role' => $request->role]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role, // Simpan role
    ]);

    return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
}
    
}
