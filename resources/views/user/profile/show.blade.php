@extends('layouts.user')

@section('title', 'Profile')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4" style="width: 40rem;">
        <div class="card-body p-4">
            <h2 class="text-center text-primary fw-bold">📌 Your Profile</h2>
            <hr class="mb-4">

            <div class="mb-3">
                <strong class="text-muted">👤 Name:</strong>
                <p class="fs-5">{{ $user->name }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-muted">📧 Email:</strong>
                <p class="fs-5">{{ $user->email }}</p>
            </div>

            <div class="mb-3">
                <strong class="text-muted">🔑 Password:</strong>
                <p class="fs-5">{{ str_repeat('•', strlen($user->password)) }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('user.profile.edit') }}" class="btn btn-warning fw-bold">
                    ✏️ Edit Profile
                </a>
                <a href="{{ route('user') }}" class="btn btn-secondary fw-bold">
                    🔙 Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
