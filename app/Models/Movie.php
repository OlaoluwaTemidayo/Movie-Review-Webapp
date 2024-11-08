<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = ['title', 'description' , 'slug','year' ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}