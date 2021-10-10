<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\RegisterController;
use App\Http\Controllers\api\v1\SportController;
use App\Http\Controllers\api\v1\ChampionshipController;
use App\Http\Controllers\api\v1\GameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::resource('sports', SportController::class);
Route::resource('championship', ChampionshipController::class);
Route::resource('games', GameController::class);

Route::get('getChampionshipBySportID/{sport_id}', [App\Http\Controllers\Api\v1\ChampionshipController::class,'getChampionshipBySportID'])->name('getChampionshipBySportID');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
