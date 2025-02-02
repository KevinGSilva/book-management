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

    protected $casts = [
        'published_at' => 'date',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
