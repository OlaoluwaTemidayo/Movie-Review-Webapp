<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Define the fillable fields
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Optionally, hash the password when creating or updating the user
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = bcrypt($user->password);
            }
        });
    }
}