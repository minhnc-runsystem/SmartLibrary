<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UserBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
        // if ($request->has('search') && !empty($request->search)) {
        //     $query->where('title', 'like', '%' . $request->search . '%')
        //         ->orWhere('author', 'like', '%' . $request->search . '%');
        // }

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // filter by status available
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $books = $query->paginate(10);
        $categories = Category::all();
        return view('user.books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        return view('user.books.show', compact('book'));
    }

    public function borrow(Book $book)
    {
        $book->status = 'borrowed';
        $book->save();
        $borrowRecord = new BorrowRecord();
        $borrowRecord->user_id = Auth::user()->id;
        $borrowRecord->book_id = $book->id;
        $borrowRecord->save();
        $borrowRecords = BorrowRecord::where('user_id', Auth::user()->id)->get();

        return view('user.borrow.index', compact('book', 'borrowRecords'));
    }
}
