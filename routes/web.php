<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CopounsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VariantsController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ControlPanelUsersController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
Route::get('/',[HomeController::class,'index'])->name('home');
        });

// Route::prefix(LaravelLocalization::setLocale())->middleware(['auth'])->get('/',  [HomeController::class,'index'])->name('home');

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
    Route::get('/contact', [ContactsController::class, 'contact'])->name('contact');
    Route::resource('category', CategoriesController::class);
    Route::put('status/category/{id}', [CategoriesController::class, 'status']);

    Route::resource('product', ProductController::class);
    Route::put('status/product/{id}', [ProductsController::class, 'status']);


    Route::resource('attribute', AttributeController::class);
    Route::resource('variant', VariantController::class);
    Route::get('ProductAtt/{id}', 'App\Http\Controllers\VariantController@getProductAtt');

    Route::get('showvariant/{id}',[VariantController::class,'showAllVariant']);
    Route::get('addVarint/{id}', [VariantController::class,'addVarint']);

    Route::resource('order', OrderController::class);
    Route::get('order/Status/{id}/{opt}', [OrderController::class , 'ChangeStatus']);



    Route::get('/setting',[SettingsController::class , 'index'])->name('setting.index');
    Route::post('/setting/update',[SettingsController::class , 'update'])->name('setting.update');

    Route::get('setting/social', [SettingsController::class, 'social'])->name('social.index');
    Route::post('setting/social', [SettingsController::class, 'update_social'])->name('social.update');
    Route::resource('role', RoleController::class);
    Route::resource('admin', ControlPanelUsersController::class);
    Route::put('status/admin/{id}', [ControlPanelUsersController::class, 'status']);
    Route::post('update', [AdminsController::class, 'update_admin'])->name('admin.updat');
    Route::get('resetPassword', [AdminsController::class, 'reset_Password'])->name('admin.resetPassword1');;
    Route::post('reset-Password', [AdminsController::class, 'resetPassword'])->name('admin.resetPassword');
    Route::resource('city', CitiesController::class);



});
