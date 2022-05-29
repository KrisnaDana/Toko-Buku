<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $fillable = ["book_name", "price", "description", "book_rate", "stock", "weight"];

    public function discount(){
        return $this->hasMany(discount::class, "book_id");
    }

    public function book_image(){
        return $this->hasMany(book_image::class, "book_id");
    }

    public function book_category_detail(){
        return $this->hasMany(book_category_detail::class, "book_id");
    }

    public function cart(){
        return $this->hasMany(cart::class, "book_id");
    }

    public function book_review(){
        return $this->hasMany(book_review::class, "book_id");
    }

    public function transaction_detail(){
        return $this->hasMany(transaction_detail::class, "book_id");
    }
}
