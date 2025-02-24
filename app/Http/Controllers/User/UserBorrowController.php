<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\RequestRecord;

class UserBorrowController extends Controller
{
    public function index()
{
    $userId = Auth::id();

    // list borrow records
    $borrowRecords = BorrowRecord::where('user_id', $userId)->orderBy('borrowed_at', 'desc')->paginate(10);

    return view('user.borrow.index', compact('borrowRecords'));
}

    public function requestBorrow(Book $book)
    {
        if ($book->status !== 'available') {
            return redirect()->back()->with('error', 'Sách không có sẵn để mượn.');
        }
        // Kiểm tra xem đã có yêu cầu chưa
        $existingRequest = RequestRecord::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Bạn đã gửi yêu cầu mượn sách này rồi.');
        }

        // Tạo yêu cầu mượn sách
        RequestRecord::create([
            'user_id' => Auth::user()->id,
            'book_id' => $book->id,
            'status' => 'pending', // Mặc định chờ duyệt
        ]);

        return redirect()->back()->with('success', 'Yêu cầu mượn sách đã được gửi.');
    }

    public function getPendingRequests()
    {   
        $pendingRequests = RequestRecord::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->orderBy('requested_at', 'desc')
            ->paginate(10);
        return view('user.requests.pending', compact('pendingRequests'));
    }

    public function getRejectedRequests()
    {
        $rejectedRequests = RequestRecord::where('user_id', Auth::id())
            ->where('status', 'rejected')
            ->orderBy('requested_at', 'desc')
            ->paginate(10);
        return view('user.requests.rejected', compact('rejectedRequests'));
    }
    

    //
}
