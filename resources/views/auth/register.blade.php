@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg p-4 border-0 rounded-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Register</h3>
                <p class="text-muted">Create an account now!</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Name" value="{{ old('name') }}" required autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Email" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control" 
                           placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Register</button>

                <div class="text-center mt-3">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="text-center text-muted mt-5 py-3">
    <p class="mb-0">© 2025 Library Online | Designed by <a href="#" class="text-decoration-none text-primary fw-bold">Dev Team</a></p>
</footer>
@endsection
