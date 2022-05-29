<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_category_detail extends Model
{
    use HasFactory;
    protected $fillable = ["book_id", "category_id"];

    public function book_category(){
        return $this->belongsTo(book_category::class);
    }

    public function book(){
        return $this->belongsTo(book::class);
    }
}
