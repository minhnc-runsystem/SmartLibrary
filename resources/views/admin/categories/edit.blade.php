@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="container mt-4">
    <h2>Edit Category</h2>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">💾 Save</button>
    </form>
</div>
@endsection
