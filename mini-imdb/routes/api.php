<?php

use App\Http\Controllers\CrewController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('crews', CrewController::class);

Route::apiResource('genres', GenreController::class);

Route::get('/movies/search',[MovieController::class,'search']);
Route::get('movies/search-elastic',[MovieController::class, 'searchElastic']);
Route::apiResource('movies', MovieController::class);


