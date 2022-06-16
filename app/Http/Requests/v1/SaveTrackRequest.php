<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class SaveTrackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'title_short' => 'required|string|max:50',
            'duration_secons' => 'required|integer',
            'preview_url' => 'required|string|max:255',
            'song_url' => 'required|string|max:255',
            'lyrics' => 'required|string|max:255',
            'release_date' => 'required|date',
            'album_id' => 'required|integer',
        ];
    }
}
