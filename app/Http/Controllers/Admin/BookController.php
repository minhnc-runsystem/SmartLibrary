<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query(); // create dynamic query

        // search by title or author
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

        // filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // order by created_at desc and paginate 10
        $books = $query->paginate(10);

        $categories = Category::all(); // get categories to display dropdown filter

        return view('admin.books.index', compact('books', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_year' => 'required|integer',
            'status' => 'required|in:available,borrowed',
            'category_id' => 'required|exists:categories,id',
            'total_quantity' => 'required|integer'
        ]);
        $validated['quantity'] = $validated['total_quantity'];

        Book::create($validated);
        return redirect()->route('admin.books')->with('success', 'Thêm sách thành công');
    }


    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'published_year' => 'required|integer',
            'status' => 'required|in:available,borrowed',
            'category_id' => 'required|exists:categories,id'
        ]);

        Log::info('Validated data:', $validated);
        Log::info('Before update - Book category_id:', ['category_id' => $book->category_id]);

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'published_year' => $validated['published_year'],
            'status' => $validated['status'],
            'category_id' => $validated['category_id']
        ]);

        Log::info('After update - Book category_id:', ['category_id' => $book->category_id]);

        return redirect()->route('admin.books')->with('success', 'Cập nhật sách thành công');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books')->with('success', 'Xóa sách thành công');
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }
}
