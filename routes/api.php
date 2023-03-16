<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\VoteController;

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
Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('characters', CharacterController::class);
});


Route::controller(VoteController::class)->group(function () {
    Route::get('/votes', 'index');
    Route::post('/votes', 'store');
    Route::get('/votes/characters', 'getCharacters');
    Route::get('/votes/daily', 'getAllDailyVotes');
    Route::get('/votes/daily/{id}', 'getCharacterDailyVotes');
    Route::get('/votes/top5', 'getTopFiveCharacters');
});
