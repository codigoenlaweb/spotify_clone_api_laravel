<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\ArtistBasicResource;
use App\Http\Resources\v1\GenreResource;

class AlbumBasicResource extends JsonResource
{

    public function toArray($request)
    {
        $durations_secons_album = $this->tracks->sum('duration_secons');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'label' => $this->label,
            'cover' => asset('storage/' . $this->picture),
            'release_date' => $this->release_date,
            'duration_seconds' => $durations_secons_album,
            'artist_id' => new ArtistBasicResource($this->artist),
            'genre_id' => new GenreResource($this->genre),
        ];
    }
}
