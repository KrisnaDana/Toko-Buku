<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_review extends Model
{
    use HasFactory;
    protected $fillable = ["book_id", "user_id", "transaction_detail_id", "rate", "content"];

    public function book()
    {
        return $this->belongsTo(book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
