<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;

    protected $table = 'borrow_records'; // Tên bảng

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
    ];

    // protected $dates = ['borrowed_at', 'returned_at'];
    protected $casts = [
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Kiểm tra sách đã trả chưa
    public function isReturned()
    {
        return !is_null($this->returned_at);
    }
}
