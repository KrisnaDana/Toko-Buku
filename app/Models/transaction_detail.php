<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    use HasFactory;
    protected $fillable = ["transaction_id", "book_id", "qty", "discount", "selling_price"];

    public function transaction(){
        return $this->belongsTo(transaction::class);
    }

    public function book(){
        return $this->belongsTo(book::class);
    }
}
