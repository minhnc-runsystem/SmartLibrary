@extends('layouts.user')

@section('title', 'Pending Requests')

@section('content')
    <h1 class="mt-5">Pending Requests</h1>
    @if($pendingRequests->isEmpty())
        <div class="alert alert-warning">You have no requests pending approval.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Requested Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->book->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($request->requested_at)->format('d/m/Y H:i') }}</td>
                            <td><span class="badge bg-info">Pending</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $pendingRequests->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
@endsection
