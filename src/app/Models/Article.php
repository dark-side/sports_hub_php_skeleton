<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Get the like associated with the article.
     */
    public function like()
    {
        return $this->morphOne(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'article');
    }
}
