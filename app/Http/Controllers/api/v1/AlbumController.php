<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SaveAlbumRequest;
use App\Http\Resources\v1\AlbumResource;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::paginate(10);
        return AlbumResource::collection($albums);
    }


    public function store(SaveAlbumRequest $request)
    {
        $artist = Artist::find($request->artist_id);
        $genre = Genre::find($request->genre_id);

        if (!$artist) {
            return response()->json([
                "message" => "Artist not found",
                "errors" => [
                    "Artist not found"
                ]
            ], 404);
        }

        if (!$genre) {
            return response()->json([
                "message" => "Genre not found",
                "errors" => [
                    "Genre not found"
                ]
            ], 404);
        }

        if ($request->hasFile('cover')) {
            $img = $request->file('cover')->store('uploads', 'public');

            $album = Album::create([
                'title' => $request->title,
                'cover' => $img,
                'label' => $request->label,
                'release_date' => $request->release_date,
                'artist_id' => $request->artist_id,
                'genre_id' => $request->genre_id,
            ]);

            return new AlbumResource($album);
        }

        $album = Album::create($request->all());
        return new AlbumResource($album);
    }


    public function show($id)
    {
        $album = Album::find($id);

        if (!$album) {
            return response()->json([
                "message" => "Album not found",
                "errors" => [
                    "Album not found"
                ]
            ], 404);
        }

        return new AlbumResource($album);
    }


    public function update(SaveAlbumRequest $request, $id)
    {
        $album = Album::find($id);
        $artist = Artist::find($request->artist_id);
        $genre = Genre::find($request->genre_id);

        if (!$album) {
            return response()->json([
                "message" => "Album not found",
                "errors" => [
                    "Album not found"
                ]
            ], 404);
        }

        if (!$artist) {
            return response()->json([
                "message" => "Artist not found",
                "errors" => [
                    "Artist not found"
                ]
            ], 404);
        }

        if (!$genre) {
            return response()->json([
                "message" => "Genre not found",
                "errors" => [
                    "Genre not found"
                ]
            ], 404);
        }

        if ($request->hasFile('cover')) {
            Storage::delete('public/' . $album->cover);
            $img = $request->file('cover')->store('uploads', 'public');

            $album->update([
                'title' => $request->title,
                'cover' => $img,
                'label' => $request->label,
                'release_date' => $request->release_date,
                'artist_id' => $request->artist_id,
                'genre_id' => $request->genre_id,
            ]);
        } else {
            $album->update([
                'title' => $request->title,
                'label' => $request->label,
                'release_date' => $request->release_date,
                'artist_id' => $request->artist_id,
                'genre_id' => $request->genre_id,
            ]);
        }

        return new AlbumResource($album);
    }


    public function destroy($id)
    {
        $album = Album::find($id);

        if (!$album) {
            return response()->json([
                "message" => "Album not found",
                "errors" => [
                    "Album not found"
                ]
            ], 404);
        }

        Storage::delete('public/' . $album->cover);

        $album->delete();

        return response()->json([
            "message" => "Album deleted"
        ], 200);
    }
}
