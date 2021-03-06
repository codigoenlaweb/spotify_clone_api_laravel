<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover',
        'label',
        'release_date',
        'genre_id',
        'artist_id',
    ];

    // many to one relationship
    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    // many to one relationship
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    // one to many relationship
    public function tracks()
    {
        return $this->hasMany('App\Models\Track');
    }
}
