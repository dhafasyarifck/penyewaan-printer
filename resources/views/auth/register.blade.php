@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #007bff, #00c6ff);">
    <div class="row justify-content-center w-100">
        <div class="col-12 col-md-8 col-lg-6 mt-4 mb-4">
            <div class="card shadow-lg border-0" style="border-radius: 12px;">
                <div class="card-body p-5">
                    <h3 class="text-center mb-4" style="font-weight: bold; color: #333;">Register</h3>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label" style="font-weight: 500;">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required style="padding: 0.75rem; border-radius: 8px;">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required style="padding: 0.75rem; border-radius: 8px;">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label" style="font-weight: 500;">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required style="padding: 0.75rem; border-radius: 8px;">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label" style="font-weight: 500;">Role</label>
                            <select class="form-control" id="role" name="role" required style="padding: 0.75rem; border-radius: 8px;">
                                <option value="pelanggan">Pelanggan</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" style="padding: 0.75rem; font-weight: bold; border-radius: 8px;">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
