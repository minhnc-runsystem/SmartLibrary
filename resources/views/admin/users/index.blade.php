@extends('layouts.admin')

@section('title', 'List User')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>List User</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">➕ Add User</a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.users') }}" class="d-flex gap-2 mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            {{-- <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Xem</a> --}}
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
