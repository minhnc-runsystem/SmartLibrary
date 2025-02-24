@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
        <div class="card shadow-lg p-4 border-0 rounded-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary">Login</h3>
                <p class="text-muted">Welcome back! Please login to continue.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Email" value="{{ old('email') }}" required autofocus>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Mật khẩu" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none text-primary fw-bold" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Login</button>

                <div class="text-center mt-3">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary">Register now</a>
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
