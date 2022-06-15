<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\ArtistBasicResource;
use App\Http\Resources\v1\GenreResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'label' => $this->label,
            'cover' => asset('storage/' . $this->picture),
            'release_date' => $this->release_date,
            'artist_id' => new ArtistBasicResource($this->artist),
            'genre_id' => new GenreResource($this->genre),
        ];
    }
}
