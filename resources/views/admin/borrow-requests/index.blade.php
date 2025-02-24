@extends('layouts.admin')

@section('title', 'List Borrow Request')

@section('content')
    <div class="container">
        <h1 class="mb-4">List Borrow Request</h1>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.borrow-requests') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search by name or book title" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('admin.borrow-requests') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
        @if($requests->isEmpty())
            <div class="alert alert-info">No request.</div>
        @else
            <div class="table-responsive">
                
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Borrower</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->book->title }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->requested_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $request->status == 'pending' ? 'bg-warning' : 
                                           ($request->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                        {{ $request->status == 'pending' ? 'Pending' : 
                                           ($request->status == 'approved' ? 'Approved' : 'Rejected') }}
                                    </span>
                                </td>
                                <td>
                                    @if($request->status == 'pending')
                                        <form action="{{ route('admin.requests.approve', $request->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.requests.reject', $request->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-muted">Not Available</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
