<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_short',
        'duration_secons',
        'preview_url',
        'song_url',
        'release_date',
        'album_id',
    ];

    // many to one relationship
    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }
}
