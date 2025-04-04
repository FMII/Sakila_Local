<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmActorController;
use App\Http\Controllers\FilmCategoryController;
use App\Http\Controllers\FilmTextController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::get('/factor/{user}', [AuthController::class, 'factor'])->name('factor');
Route::post('/twofa/{user}', [AuthController::class, 'twofa'])->name('twofa');
Route::post('/resend-code/{user}', [AuthController::class, 'resendCode'])->name('resendCode');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::get('2fapassword/{user}',[AuthController::class, 'show2fapassword'])->name('2fapassword');
Route::get('2fapassword/{user}',[AuthController::class, 'show2fapassword'])->name('2fapassword');
Route::post('2fapassword/{user}',[AuthController::class, 'twofapassword'])->name('twofapassword');
Route::get('showpassword/{user}',[AuthController::class, 'showchangepassword'])->name('showpassword');
Route::post('updatePassword/{user}',[AuthController::class, 'updatePassword'])->name('updatePassword');
Route::post('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

// Middleware para verificar autenticación
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return app(DashboardController::class)->index();
    })->name('dashboard')->middleware('admin.only');

    Route::group(['middleware' => ['admin']], function () {
        Route::resource('addresses', AddressController::class);
        Route::resource('cities', CityController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('languages', LanguageController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('rentals', RentalController::class);
        Route::resource('staffs', StaffController::class);
        Route::resource('stores', StoreController::class);
        Route::resource('film-actors', FilmActorController::class);
        Route::resource('film-categories', FilmCategoryController::class);
        Route::resource('film_texts', FilmTextController::class);
    });

    Route::group(['middleware' => ['customer']], function () {
        Route::resource('films', FilmController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('actors', ActorController::class);
        Route::resource('inventories', InventoryController::class);
    });
});