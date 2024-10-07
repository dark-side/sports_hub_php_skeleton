<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image_url'
    ];

    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }

    public function reaction()
    {
        return $this->hasOne(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
