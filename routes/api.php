<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\CatsController;
use App\Http\Controllers\API\V1\HomeController;
//use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\ContactController;
use App\Http\Controllers\API\V1\SettingController;
use App\Http\Controllers\API\V1\ProductsController;
use App\Http\Controllers\API\V1\AddressesController;
use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\FavoritesController;
use App\Http\Controllers\API\V1\LocationsController;
use App\Http\Controllers\API\V1\CategoriesController;
use App\Http\Controllers\API\V1\Auth\AuthBaseController;
use App\Http\Controllers\API\V1\NotificationsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('setLocale')->prefix('V1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('submitcode', [AuthController::class, 'submitCode']);
    Route::get('setting', SettingController::class);
    Route::get('home', HomeController::class);
    Route::get('category', CategoriesController::class);
    Route::get('product', [ProductsController::class , 'index']);
    Route::get('product/{id}', [ProductsController::class , 'show']);
    Route::apiResource('cart', CatsController::class);
  //  Route::apiResource('order', OrderController::class);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('user', [AuthController::class, 'show']);
        Route::put('user/update', [AuthController::class, 'update']);
        Route::get('location', LocationsController::class);
        Route::post('contact', ContactController::class);
        Route::apiResource('favorite', FavoritesController::class);
        Route::apiResource('address', AddressesController::class);
        Route::apiResource('notification', NotificationsController::class);
        Route::delete('destory', [AuthController::class , 'destory']);
        Route::get('logout', [AuthBaseController::class , 'logout']);
    });




});
