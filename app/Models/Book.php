<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'author_id',
        'title',
        'description',
        'published_at',
    ];

    protected $dates = [
        'published_at',
    ];
}
