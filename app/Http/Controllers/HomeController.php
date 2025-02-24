<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            $books = Book::all();
            return view('user.dashboard', compact('books'));
        }
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        return view('user.dashboard');
    }
}
