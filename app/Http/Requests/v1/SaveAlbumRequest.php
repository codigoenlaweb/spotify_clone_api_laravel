<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class SaveAlbumRequest extends FormRequest
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
            'title' => 'required|string|max:30',
            'cover' => 'nullable|max:4000|mimes:jpeg,png,jpg',
            'label' => 'required|string|max:120|min:3',
            'release_date' => 'required|date',
            'artist_id' => 'required|integer',
            'genre_id' => 'required|integer',
        ];
    }
}
