<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Author extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'status',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*'])->logOnlyDirty()->dontSubmitEmptyLogs();
    }
}
