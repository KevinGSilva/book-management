<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Book extends Model implements HasMedia
{
    use InteractsWithMedia;

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
    }
}
