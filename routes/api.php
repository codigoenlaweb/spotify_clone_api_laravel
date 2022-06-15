<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\v1\GenreController as GenreControllerV1;


// Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// routes with auth:sanctum
Route::group(['middleware' => 'auth:sanctum'], function() {
    // auth
    Route::get('/user', [UserController::class, 'userProfile']);
    Route::post('/logout', [UserController::class, 'logout']);

    // genres
    Route::get('/genre', [GenreControllerV1::class, 'index']);
    Route::post('/genre/create', [GenreControllerV1::class, 'store']);
    Route::get('/genre/{id}', [GenreControllerV1::class, 'show']);
    Route::put('/genre/{id}/update', [GenreControllerV1::class, 'update']);
    Route::delete('/genre/{id}/delete', [GenreControllerV1::class, 'destroy']);
});





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

