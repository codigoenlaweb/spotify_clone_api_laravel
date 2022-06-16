<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SaveTrackRequest;
use App\Http\Resources\v1\TrackBasicResource;
use App\Http\Resources\v1\TrackResource;
use App\Models\Album;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{

    public function index()
    {
        $tracks = Track::paginate(25);
        return TrackResource::collection($tracks);
    }


    public function store(SaveTrackRequest $request)
    {
        $album = Album::find($request->album_id);

        if (!$album) {
            return response()->json([
                'message' => 'Album not found',
                "errors" => [
                    "Album not found"
                ]
            ], 404);
        }

        $track = Track::create($request->all());

        return new TrackResource($track);

    }


    public function show($id)
    {
        $track = Track::find($id);

        if (!$track) {
            return response()->json([
                'message' => 'Track not found',
                "errors" => [
                    "Track not found"
                ]
            ], 404);
        }

        return new TrackResource($track);
    }


    public function update(SaveTrackRequest $request, $id)
    {
        $track = Track::find($id);
        $album = Album::find($request->album_id);

        if (!$track) {
            return response()->json([
                'message' => 'Track not found',
                "errors" => [
                    "Track not found"
                ]
            ], 404);
        }

        if (!$album) {
            return response()->json([
                'message' => 'Album not found',
                "errors" => [
                    "Album not found"
                ]
            ], 404);
        }

        $track->update($request->all());

        return new TrackBasicResource($track);
    }


    public function destroy($id)
    {
        $track = Track::find($id);

        if (!$track) {
            return response()->json([
                'message' => 'Track not found',
                "errors" => [
                    "Track not found"
                ]

            ], 404);
        }

        $track->delete();

        return response()->json([
            'message' => 'Track deleted'
        ], 200);
    }

    public function searchTrack(Request $request)
    {
        $query = $request->query('q');
        $tracks = Track::where('title', 'like', "%$query%")->paginate(25);
        return TrackResource::collection($tracks);
    }
}
