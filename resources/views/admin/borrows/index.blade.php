@extends('layouts.admin')

@section('title', 'List Borrow History')

@section('content')
    <div class="container">
        <h1 class="mb-4">List Borrow History</h1>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.borrows') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name or book title" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('admin.borrows') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>

        @if($borrowRecords->isEmpty())
            <div class="alert alert-info">No borrow record.</div>
        @else
            <div class="table-responsive">
                    
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Borrower</th>
                            <th>Borrowed Date</th>
                            <th>Returned Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowRecords as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->book->title }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ $record->borrowed_at ? $record->borrowed_at->format('d/m/Y') : 'Not Borrowed' }}</td>
                                <td>{{ $record->returned_at ? $record->returned_at->format('d/m/Y') : 'Not Returned' }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $record->returned_at ? 'bg-primary' : 'bg-warning' }}">
                                        {{ $record->returned_at ? 'Returned' : 'Borrowed' }}
                                    </span>
                                </td>
                                <td>
                                    @if(!$record->returned_at)
                                        <form action="{{ route('admin.borrow.confirm-return', $record->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Confirm Return</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Confirmed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $borrowRecords->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
