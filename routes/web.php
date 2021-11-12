<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Urban\UrbanRequestController;
use App\Http\Controllers\Rural\RuralRequestController;

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

//guest routes
Route::get('/', function () {
    return view('welcome');
});

//auth routes
Route::get('/dashboard', DashboardController::class)->middleware('auth')->name('dashboard');
Route::resource('profile', ProfileController::class)->middleware('auth');

//Admin routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'auth.isAdmin']
], function () {
    Route::resource('users', UserController::class);
});

//Urban routes
Route::group([
    'prefix' => 'urban-farmer',
    'as' => 'urban.',
    'middleware' => ['auth', 'auth.isUrban']
], function () {
    Route::resource('requests', UrbanRequestController::class);
});

//Rural routes
Route::group([
    'prefix' => 'rural-farmer',
    'as' => 'rural.',
    'middleware' => ['auth', 'auth.isRural']
], function () {
    Route::resource('requests', RuralRequestController::class);
});

//Agro-company routes
Route::group([
    'prefix' => 'agro-company',
    'as' => 'agro.',
    'middleware' => ['auth', 'auth.isAgro']
], function () {
    //
});

require __DIR__ . '/auth.php';