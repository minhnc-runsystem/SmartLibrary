<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Models\Book;

class BorrowController extends Controller
{
    public function getBorrows(Request $request)
    {
        $query = BorrowRecord::query();

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

        $borrowRecords = $query->orderBy('borrowed_at', 'desc')->paginate(10);

        return view('admin.borrows.index', compact('borrowRecords'));
    }


    public function returnBook($id)
    {
        $borrowRecord = BorrowRecord::findOrFail($id);
        $borrowRecord->returned_at = now();
        $borrowRecord->save();

        $book = Book::findOrFail($borrowRecord->book_id);
        $book->return();
        return redirect()->back()->with('success', 'Sách đã được trả lại');
    }
}
