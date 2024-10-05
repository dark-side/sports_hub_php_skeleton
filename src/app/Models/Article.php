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
    ];
}
