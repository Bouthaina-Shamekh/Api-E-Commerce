<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ControlPanelUsersController;
use App\Http\Controllers\CopounsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
    return view('welcome');
});

Auth::routes();

Route::prefix(LaravelLocalization::setLocale())->middleware(['auth'])->get('/',  [HomeController::class, 'index'])->name('home');

Route::get('edit', [AdminsController::class, 'edit_admin'])->name('admin.edit1');
Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'middleware' => ['auth']
], function () {
    Route::resource('ad', AdsController::class);
    Route::put('status/ad/{id}', [AdsController::class, 'status']);
    Route::resource('copoun', CopounsController::class);
    Route::put('status/copoun/{id}', [CopounsController::class, 'status']);
    Route::resource('contact', ContactsController::class);
    Route::resource('category', CategoriesController::class);
    Route::put('status/category/{id}', [CategoriesController::class, 'status']);
    Route::resource('setting', SettingsController::class)->only(['index', 'update']);
    Route::get('setting/social', [SettingsController::class, 'social'])->name('setting.social');
    Route::resource('role', RoleController::class);
    Route::resource('admin', ControlPanelUsersController::class);
    Route::put('status/admin/{id}', [ControlPanelUsersController::class, 'status']);
    Route::post('update', [AdminsController::class, 'update_admin'])->name('admin.updat');
    Route::get('resetPassword', [AdminsController::class, 'reset_Password'])->name('admin.resetPassword1');;
    Route::post('reset-Password', [AdminsController::class, 'resetPassword'])->name('admin.resetPassword');
});

