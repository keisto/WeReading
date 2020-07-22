<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'lookup_id',
        'title',
        'authors',
        'image',
        'sort_order'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            $lastBook = $book->user->books->last();
            $book->sort_order = $lastBook ? (Int) $lastBook->sort_order + 1 : 1;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOrdered($q) {
        return $q->orderBy('sort_order', 'asc');
    }
}
