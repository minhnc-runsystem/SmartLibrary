@extends('layouts.admin')

@section('title', 'Detail Book')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Detail Book</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong>
                <p class="form-control">{{ $book->title }}</p>
            </div>

            <div class="mb-3">
                <strong>Author:</strong>
                <p class="form-control">{{ $book->author }}</p>
            </div>

            <div class="mb-3">
                <strong>Category:</strong>
                <p class="form-control">{{ $book->category->name }}</p>
            </div>  

            <div class="mb-3">
                <strong>Published Year:</strong>
                <p class="form-control">{{ $book->published_year }}</p>
            </div>

            <div class="mb-3">
                <strong>Status:</strong>
                <p>
                    <span class="badge {{ $book->status == 'available' ? 'bg-success' : 'bg-warning' }}">
                        {{ $book->status == 'available' ? 'Available' : 'Not Available' }}
                    </span>
                </p>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.books') }}" class="btn btn-secondary">Quay lại</a>
                <div>
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this book?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection