<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "courier_id", "timeout", "address", "regency", "province", "total", "shipping_cost", "subtotal", "proof_of_payment", "status"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courier()
    {
        return $this->belongsTo(courier::class);
    }

    public function transaction_detail()
    {
        return $this->hasMany(transaction_detail::class, "transaction_id");
    }
}
