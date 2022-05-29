<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_category extends Model
{
    use HasFactory;
    protected $fillable = ["category_name"];

    public function book_category_detail(){
        return $this->hasMany(book_category_detail::class, "category_id");
    }
}
