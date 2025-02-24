@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<div class="container mt-4">
    <h2>Add New Category</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-success">➕ Add</button>
        </div>
    </form>
</div>
@endsection
