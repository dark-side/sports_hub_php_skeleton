<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attachment extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'article_id',
        'user_id',
        'filename',
        'content_type',
        'metadata',
        'byte_size',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
