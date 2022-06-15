<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SaveArtistRequest;
use App\Http\Resources\v1\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all();
        return ArtistResource::collection($artists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveArtistRequest $request)
    {

        if ($request->hasFile('picture')) {
            $img = $request->file('picture')->store('uploads', 'public');

            $artist = Artist::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'picture' => $img,
            ]);

            return new ArtistResource($artist);
        }

        $artist = Artist::create($request->all());

        return new ArtistResource($artist);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json([
                "message" => "Artist not found",
                "errors" => [
                    "Artist not found"
                ]
            ], 404);
        }

        return new ArtistResource($artist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveArtistRequest $request, $id)
    {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json([
                "message" => "Artist not found",
                "errors" => [
                    "Artist not found"
                ]
            ], 404);
        }

        if ($request->hasFile('picture')) {
            Storage::delete('public/' . $artist->picture);
            $img = $request->file('picture')->store('uploads', 'public');

            $artist->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'picture' => $img,
            ]);
        } else {
            $artist->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
            ]);
        }
        $artist->update($request->all());

        return new ArtistResource($artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json([
                "message" => "Artist not found",
                "errors" => [
                    "Artist not found"
                ]
            ], 404);
        }

        Storage::delete('public/' . $artist->picture);

        $artist->delete();

        return response()->json([
            "message" => "Artist deleted"
        ], 200);
    }
}
