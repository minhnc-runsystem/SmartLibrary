@extends('layouts.user')

@section('title', 'Book Details')

@section('content')
    <div class="card shadow-lg p-4">
        <h2 class="mb-4">{{ $book->title }}</h2>

        <div class="row">
            <div class="col-md-4">
                <img src="{{ $book->cover_image ?? asset('default-book-cover.jpg') }}" alt="Book Cover"
                     class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-8">
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
                <p><strong>Category:</strong> {{ $book->category->name }}</p>
                <p><strong>Description:</strong> {{ $book->description }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $book->status == 'available' ? 'bg-success' : 'bg-warning' }}">
                        {{ $book->status == 'available' ? 'Available' : 'Not Available' }}
                    </span>
                </p>

                <div class="mt-3">
                    @if($book->status == 'available')
                        <form action="{{ route('user.books.borrow', $book) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Borrow</button>
                        </form>
                    @else
                        <button class="btn btn-secondary" disabled>Already Borrowed</button>
                    @endif
                    <a href="{{ route('user.books') }}" class="btn btn-outline-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
