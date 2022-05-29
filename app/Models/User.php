<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_notification()
    {
        return $this->hasMany(user_notification::class, "notifiable_id");
    }

    public function transaction()
    {
        return $this->hasMany(transaction::class, "user_id");
    }

    public function cart()
    {
        return $this->hasMany(cart::class, "user_id");
    }

    public function book_review()
    {
        return $this->hasMany(book_review::class, "user_id");
    }

    public function createNotifUser($data)
    {
        $notif = new user_notification();
        $notif->type = 'App\Notifications\AdminNotification';
        $notif->notifiable_type = 'App\Models\User';
        $notif->notifiable_id = $this->id;
        $notif->data = $data;
        $notif->read_at =null;
        $notif->save();
    }
}
