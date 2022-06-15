<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Model
use App\Models\Genre;

// Request
use App\Http\Requests\v1\SaveGenreRequest;

// Resource
use App\Http\Resources\v1\GenreResource;


class GenreController extends Controller
{

    public function index()
    {
        $genres = Genre::paginate(20);
        return GenreResource::collection($genres);
    }


    public function store(SaveGenreRequest $request)
    {
        $genre = Genre::create($request->all());
        return new GenreResource($genre);
    }


    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "message" => "Genre not found",
                "errors" => [
                    "Genre not found"
                ]
            ], 404);
        }

        return new GenreResource($genre);
    }


    public function update(SaveGenreRequest $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "message" => "Genre not found",
                "errors" => [
                    "Genre not found"
                ]
            ], 404);
        }

        $genre->update($request->all());

        return new GenreResource($genre);
    }


    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                "message" => "Genre not found",
                "errors" => [
                    "Genre not found"
                ]
            ], 404);
        }

        $genre->delete();
        return response()->json([
            "message" => "Successfully deleted genre"
        ], 200);
    }
}
