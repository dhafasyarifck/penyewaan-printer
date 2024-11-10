@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #007bff, #00c6ff);">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8 col-md-12"> <!-- Mengatur lebar card untuk ukuran yang lebih besar -->
            <div class="card shadow-lg border-0" style="border-radius: 12px;">
                <div class="card-body p-5"> <!-- Memperbesar padding untuk tampilan yang lebih lebar -->
                    <h3 class="text-center mb-4" style="font-weight: bold; color: #333;">Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required style="padding: 0.75rem; border-radius: 8px;">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label" style="font-weight: 500;">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required style="padding: 0.75rem; border-radius: 8px;">
                        </div>

                        <button type="submit" class="btn btn-primary w-100" style="padding: 0.75rem; font-weight: bold; border-radius: 8px;">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
