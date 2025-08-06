@extends('layouts.head') {{-- Ini wajib dipake --}}

@section('body-class', 'register-page')

@section('main')
<style>
    body.register-page {
        margin: 0;
        background-color: #7A1C1C !important;
        color: white;
    }

    .top-bar {
        background-color: white;
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 10;
    }

    .top-bar .brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .top-bar .brand img {
        height: 40px;
    }

    .top-bar .brand span {
        font-weight: 600;
        color: black;
        font-size: 1.2rem;
    }

    .top-bar .btn-login {
        background-color: #EF5350;
        color: black;
        font-weight: 600;
        border-radius: 999px;
        border: none;
        padding: 6px 20px;
    }

    .login-hero {
        text-align: center;
    }

    .login-hero h1 {
        font-weight: 700;
        font-size: 2.5rem;
        line-height: 1.4;
    }

    .login-hero p {
        font-size: 1.1rem;
        margin-top: 10px;
    }

    .login-card {
        background-color: white;
        border: 1px solid #C62828;
        border-radius: 10px;
        padding: 30px;
        max-width: 50%;
        width: 100%;
        margin: 30px auto 0;
        color: #333;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .btn-register-submit {
        background-color: #C62828;
        color: white;
        border: none;
    }

    .btn-register-submit:hover {
        background-color: #a32121;
    }

    @media (min-width: 768px) {
        .login-hero h1 {
            font-size: 3rem;
        }

        .login-hero p {
            font-size: 1.2rem;
        }
    }
</style>

<!-- Header Atas Putih -->
<div class="top-bar">
    <div class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <span>Kalkulator</span>
    </div>
    <a href="{{ route('login') }}" class="btn btn-login">Login</a>
</div>

<!-- Section Hero Background Merah -->
<div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center px-3">
    <div class="login-hero text-center pt-3 pb-5">
        <h1>DAFTAR AKUN<br>UNTUK MENGAKSES</h1>
        <p>Silakan isi form pendaftaran berikut.</p>
    </div>

    <!-- Register Card -->
    <div class="login-card m-0 mb-5">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="mb-2">
            <h4 class="fw-bold text-danger m-0">Register</h4>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name"
                       class="form-control rounded-3 py-2 px-3"
                       placeholder="Masukan nama lengkap" required autofocus>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email"
                       class="form-control rounded-3 py-2 px-3"
                       placeholder="Masukan email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password"
                       class="form-control rounded-3 py-2 px-3"
                       placeholder="Masukan password" required>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control rounded-3 py-2 px-3"
                       placeholder="Masukan ulang password" required>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-register-submit py-2 rounded-3">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
