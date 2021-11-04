<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\v1\RegisterController;
use App\Http\Controllers\api\v1\SportController;
use App\Http\Controllers\api\v1\ChampionshipController;
use App\Http\Controllers\api\v1\GameController;
use App\Http\Controllers\api\v1\PredictionController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\PaymentMethodController;
use App\Http\Controllers\api\v1\WithdrawController;
use App\Http\Controllers\api\v1\NotificationController;
use App\Http\Controllers\api\v1\ContactUsController;
use App\Http\Controllers\api\v1\PackageController;

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
Route::resource('championships', ChampionshipController::class);
Route::resource('games', GameController::class);
Route::resource('contact_us', ContactUsController::class);
//Route::resource('packages',PackageController::class);

Route::get('getChampionshipsBySportID/{sport_id}', [ChampionshipController::class,'getChampionshipsBySportID'])->name('getChampionshipsBySportID');
Route::get('getGamesByChampionshipID/{championship_id}', [GameController::class,'getGamesByChampionshipID'])->name('getGamesByChampionshipID');

Route::post('savePrediction', [PredictionController::class,'savePrediction'])->name('savePrediction');
Route::get('getUsersDetails/{user_id}', [UserController::class,'getUsersDetails'])->name('getUsersDetails');

Route::resource('payment_methods', PaymentMethodController::class);
Route::post('requestForWithdraw', [WithdrawController::class,'requestForWithdraw'])->name('requestForWithdraw');
Route::get('withdrawHistory/{user_id}', [WithdrawController::class,'withdrawHistory'])->name('withdrawHistory');

Route::get('getNotifications', [NotificationController::class,'index'])->name('getNotifications');

Route::get('packages', [PackageController::class,'index'])->name('packages');
Route::post('buyPackage', [PackageController::class,'buyPackage'])->name('buyPackage');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
