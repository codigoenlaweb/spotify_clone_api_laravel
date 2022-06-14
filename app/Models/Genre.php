<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    // one to many relationship
    public function albums()
    {
        return $this->hasMany('App\Models\Album');
    }
}
