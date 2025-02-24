@extends('layouts.user')

@section('title', 'Rejected Requests')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Rejected Requests</h1>
    </div>
    @if($rejectedRequests->isEmpty())
        <div class="alert alert-danger">You have no requests rejected.</div>
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
                    @foreach($rejectedRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->book->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($request->requested_at)->format('d/m/Y H:i') }}</td>
                            <td><span class="badge bg-danger">Rejected</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $rejectedRequests->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
@endsection
