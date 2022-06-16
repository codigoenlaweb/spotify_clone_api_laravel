<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\v1\AlbumController as AlbumControllerV1;
use App\Http\Controllers\api\v1\ArtistController as ArtistControllerV1;
use App\Http\Controllers\api\v1\GenreController as GenreControllerV1;
use App\Http\Controllers\api\v1\TrackController as TrackControllerV1;

// Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// routes with auth:sanctum
Route::group(['middleware' => 'auth:sanctum'], function () {
    // auth
    Route::get('/user', [UserController::class, 'userProfile']);
    Route::post('/logout', [UserController::class, 'logout']);

    // genres
    Route::get('/genre', [GenreControllerV1::class, 'index']);
    Route::post('/genre/create', [GenreControllerV1::class, 'store']);
    Route::get('/genre/{id}', [GenreControllerV1::class, 'show']);
    Route::put('/genre/{id}/update', [GenreControllerV1::class, 'update']);
    Route::delete('/genre/{id}/delete', [GenreControllerV1::class, 'destroy']);

    // artists
    Route::get('/artist', [ArtistControllerV1::class, 'index']);
    Route::post('/artist/create', [ArtistControllerV1::class, 'store']);
    Route::get('/artist/{id}', [ArtistControllerV1::class, 'show']);
    Route::put('/artist/{id}/update', [ArtistControllerV1::class, 'update']);
    Route::delete('/artist/{id}/delete', [ArtistControllerV1::class, 'destroy']);

    // albums
    Route::get('/album', [AlbumControllerV1::class, 'index']);
    Route::post('/album/create', [AlbumControllerV1::class, 'store']);
    Route::get('/album/{id}', [AlbumControllerV1::class, 'show']);
    Route::put('/album/{id}/update', [AlbumControllerV1::class, 'update']);
    Route::delete('/album/{id}/delete', [AlbumControllerV1::class, 'destroy']);

    // tracks
    Route::get('/track', [TrackControllerV1::class, 'index']);
    Route::post('/track/create', [TrackControllerV1::class, 'store']);
    Route::get('/track/{id}', [TrackControllerV1::class, 'show']);
    Route::put('/track/{id}/update', [TrackControllerV1::class, 'update']);
    Route::delete('/track/{id}/delete', [TrackControllerV1::class, 'destroy']);
    Route::get('search/track', [TrackControllerV1::class, 'searchTrack']);
});





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
