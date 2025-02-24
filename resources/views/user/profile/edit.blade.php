@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <form method="POST" action="{{ route('user.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank if not change)</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('user.profile.show') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
