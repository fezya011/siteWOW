<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'category',
        'author', 'author_initials', 'excerpt',
        'likes', 'comments', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
