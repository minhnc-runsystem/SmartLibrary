<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestRecord extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'requested_at',
    ];

    // protected $dates = ['requested_at'];
    protected $casts = [
        'requested_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
