@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Lupa Kata Sandi</h3>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input id="email" type="email" name="email" class="form-control" required>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
    </form>
</div>
@endsection
