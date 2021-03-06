<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/login_v2', function () {
    return view('auth/login_v2');
});



Route::group(['middleware' => ['auth'] ] , function (){
	Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::get('home_v2', function () { return view('home_v2'); });
});

Route::group( ['prefix' => 'admin','middleware' => ['auth'] ] , function (){	
	Route::get('users',[App\Http\Controllers\Admin\UserController::class,'index'])->name('users');
	Route::get('userDetail/{id}', 'App\Http\Controllers\Admin\UserController@userDetail')->name('userDetail');
	Route::get('userEdit/{id}', 'App\Http\Controllers\Admin\UserController@edit')->name('userEdit');
	Route::post('userUpdate/{id}', 'App\Http\Controllers\Admin\UserController@update')->name('userUpdate');
	Route::post('users/userDelete/{id}', 'App\Http\Controllers\Admin\UserController@destroy')->name('userDelete');
	Route::resource('sports',App\Http\Controllers\Admin\SportController::class);
	Route::resource('championships',App\Http\Controllers\Admin\ChampionshipController::class);
	Route::resource('teams',App\Http\Controllers\Admin\TeamController::class);
	Route::resource('games',App\Http\Controllers\Admin\GameController::class);
	Route::resource('payment_method',App\Http\Controllers\Admin\PaymentMethodController::class);
	Route::resource('withdraws',App\Http\Controllers\Admin\WithdrawController::class);
	Route::resource('notifications',App\Http\Controllers\Admin\NotificationController::class);
	Route::resource('contact_us',App\Http\Controllers\Admin\ContactUsController::class);
	Route::resource('packages',App\Http\Controllers\Admin\PackageController::class);
	Route::post('championships/getChampionshipBySportID',[App\Http\Controllers\Admin\ChampionshipController::class,'LoadChampionshipListBySportID'])->name('getChampionshipBySportID');
	Route::post('games/removeQuestionById',[App\Http\Controllers\Admin\GameController::class,'removeQuestionById'])->name('removeQuestionById');
	Route::post('games/removeAnswerById',[App\Http\Controllers\Admin\GameController::class,'removeAnswerById'])->name('removeAnswerById');
	Route::post('games/allocateRewardByGameID',[App\Http\Controllers\Admin\GameController::class,'allocateRewardByGameID'])->name('allocateRewardByGameID');
	Route::get('users/CheckUserExpiryDate',[App\Http\Controllers\Admin\UserController::class,'CheckUserExpiryDate'])->name('CheckUserExpiryDate');
});



/*


Route::resource('admin/user', App\Http\Controllers\Admin\UserController::class, [
    'names' => [
        'index' => 'admin.user.index',
        'store' => 'admin.user.new',
    ]
]);

Route::resource('admin/sport', App\Http\Controllers\Admin\SportController::class, [
    'names' => [
        'index' => 'admin.sport.index',
        'store' => 'admin.sport.new',
    ]
]);

Route::resource('admin/championship', App\Http\Controllers\Admin\ChampionshipController::class, [
    'names' => [
        'index' => 'admin.championship.index',
        'store' => 'admin.championship.new',
    ]
]);

Route::resource('admin/game', App\Http\Controllers\Admin\GameController::class, [
    'names' => [
        'index' => 'admin.game.index',
        'store' => 'admin.game.new',
        'create' => 'admin.game.create'
    ]
]);

*/