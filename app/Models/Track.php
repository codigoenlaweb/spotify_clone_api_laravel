<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    // many to one relationship
    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }
}
