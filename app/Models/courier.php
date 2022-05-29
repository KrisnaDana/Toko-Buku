<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courier extends Model
{
    use HasFactory;
    protected $fillable = ["courier"];

    public function transaction(){
        return $this->hasMany(transaction::class, "courier_id");
    }
}
