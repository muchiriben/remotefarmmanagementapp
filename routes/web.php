<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Urban\UrbanRequestController;
use App\Http\Controllers\Rural\RuralRequestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderKeyController;
use App\Http\Controllers\TaskController;

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
Route::resource('orders', OrderController::class)->middleware('auth');
Route::resource('order-keys', OrderKeyController::class)->middleware('auth');
Route::resource('tasks', TaskController::class)->middleware('auth');

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
    Route::resource('shop', ShopController::class);
    Route::resource('cart', CartController::class);
    Route::resource('checkout', CheckoutController::class);
    Route::get('/confirmed', function () {
        return view('shop.confirmation');
    })->name('payment.confirmation');
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
    Route::resource('products', ProductController::class);
    Route::resource('product-categories', CategoryController::class);
});

require __DIR__ . '/auth.php';
