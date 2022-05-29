<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    use HasFactory;
    protected $fillable = ["book_id", "percentage", "start", "end"];

    public function book(){
        return $this->belongsTo(book::class);
    }
}
