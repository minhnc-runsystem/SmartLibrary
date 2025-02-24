@extends('layouts.admin')

@section('title', 'List Book')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>List Book</h1>
        <a href="{{ route('admin.books.create') }}" class="btn btn-success">➕ Add Book</a>
    </div>

    <div class="table-responsive">
        <form method="GET" action="{{ route('admin.books') }}" class="mb-4 d-flex gap-2">
            <!-- search input -->
            <input type="text" name="search" class="form-control" placeholder="Search by title or author" value="{{ request('search') }}">
            
            <!-- select category -->
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        
            <!-- select status -->
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Not available</option>
            </select>
        
            <!-- search button -->
            <button type="submit" class="btn btn-primary">Search</button>
            
            <!-- reset button -->
            <a href="{{ route('admin.books') }}" class="btn btn-secondary">Reset</a>
        </form>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Published Year</th>
                    <th>Total Quantity</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->published_year }}</td>
                        <td>{{ $book->total_quantity }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>        
                            <span class="badge {{ $book->status == 'available' ? 'bg-success' : 'bg-warning' }}">
                                {{ $book->status == 'available' ? 'Available' : 'Not Available' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.books.show', $book) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
    
    
@endsection