<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_image extends Model
{
    use HasFactory;
    protected $fillable = ["book_id", "image_name"];

    public function book(){
        return $this->belongsTo(book::class);
    }
}
