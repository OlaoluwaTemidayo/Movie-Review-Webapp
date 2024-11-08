<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    
}

