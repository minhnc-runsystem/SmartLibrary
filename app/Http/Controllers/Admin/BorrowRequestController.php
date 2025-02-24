<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestRecord;
use App\Models\BorrowRecord;
use App\Models\Book;

class BorrowRequestController extends Controller
{
    public function getBorrowRequests(Request $request)
    {
        $query = RequestRecord::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';

            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'like', $searchTerm);
                })->orWhereHas('book', function ($bookQuery) use ($searchTerm) {
                    $bookQuery->where('title', 'like', $searchTerm);
                });
            });
        }

        $requests = $query->orderBy('requested_at', 'desc')->paginate(10);

        return view('admin.borrow-requests.index', compact('requests'));
    }


    public function approveRequest($id)
    {
        $request = RequestRecord::findOrFail($id);
        $request->status = 'approved';
        $request->save();

        $borrow = new BorrowRecord();
        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->borrowed_at = now();
        $borrow->save();

        $book = Book::findOrFail($request->book_id);
        $book->borrow($request->user_id);

        return redirect()->back()->with('success', 'Yêu cầu đã được duyệt');
    }

    public function rejectRequest($id)
    {
        $request = RequestRecord::findOrFail($id);
        $request->status = 'rejected';
        $request->save();
        return redirect()->back()->with('success', 'Yêu cầu đã được từ chối');
    }
}
