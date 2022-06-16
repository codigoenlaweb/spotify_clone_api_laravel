<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackBasicResource extends JsonResource
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
            'title_short' => $this->title_short,
            'duration_seconds' => $this->duration_secons,
            'preview_url' => $this->preview_url,
            'song_url' => $this->song_url,
            'lyrics' => $this->lyrics,
            'release_date' => $this->release_date,
        ];
    }
}
