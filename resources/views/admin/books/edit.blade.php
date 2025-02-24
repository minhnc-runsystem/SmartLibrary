@extends('layouts.admin')

@section('title', 'Edit Book')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit Book</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $book->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" 
                           id="author" name="author" value="{{ old('author', $book->author) }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>

                <div class="mb-3">
                    <label for="published_year" class="form-label">Published Year</label>
                    <input type="number" class="form-control @error('published_year') is-invalid @enderror" 
                           id="published_year" name="published_year" 
                           value="{{ old('published_year', $book->published_year) }}" required>
                    @error('published_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>
                            Available
                        </option>
                        <option value="borrowed" {{ old('status', $book->status) == 'borrowed' ? 'selected' : '' }}>
                            Not Available
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.books') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection