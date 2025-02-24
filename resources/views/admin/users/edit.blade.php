@extends('layouts.app')

@section('title', 'Edit User Information')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit User Information</h2>
        </div>
        <div class="card-body">
            @if(Auth::user()->id !== $user->id && Auth::user()->role !== 'admin')
                <div class="alert alert-danger">You do not have permission to edit this information.</div>
            @else
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $user->email) }}" required
                               @if(Auth::user()->role !== 'admin') readonly @endif>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New password (leave blank if not change)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    @if(Auth::user()->role === 'admin')
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
