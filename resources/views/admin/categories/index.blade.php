@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-4">Manage Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">➕ Add Category</a>
</div>
<div class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">✏ Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this category?');">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
