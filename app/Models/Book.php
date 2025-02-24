<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'total_quantity',
        'quantity',
        'status',
        'category_id'
    ];

    public function borrow($user)
    {
        $this->decrement('quantity');
        if ($this->quantity == 0) {
            $this->update(['status' => 'borrowed']);
        }
    }
    
    public function return()
    {
        $this->update(['status' => 'available']);
        $this->increment('quantity');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

} 