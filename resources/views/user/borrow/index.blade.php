@extends('layouts.user')

@section('title', 'Borrow History')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Borrow History</h1>
    </div>

    @if($borrowRecords->isEmpty())
        <div class="alert alert-info">You have not borrowed any books.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Borrowed Date</th>
                        <th>Returned Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowRecords as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->book->title }}</td>
                            <td>{{ $record->borrowed_at ? \Carbon\Carbon::parse($record->borrowed_at)->format('d/m/Y') : 'Not Borrowed' }}</td>
                            <td>{{ $record->returned_at ? \Carbon\Carbon::parse($record->returned_at)->format('d/m/Y') : 'Not Returned' }}</td>
                            <td>
                                <span class="badge {{ $record->isReturned() ? 'bg-primary' : 'bg-warning' }}">
                                    {{ $record->isReturned() ? 'Returned' : 'Borrowed' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $borrowRecords->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
@endsection
