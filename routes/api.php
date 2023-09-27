<?php

use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login'])
        ->name('api_login');

    Route::post('register', [LoginController::class, 'register'])
        ->name('api_register');

    Route::post('reset-password', [LoginController::class, 'resetPassword'])
        ->name('api_reset_password');
});
Route::group(['prefix' => 'properties'], function () {

    Route::get('property/{id}', [PropertyController::class, 'property'])->name('get_property');
    Route::get('list', [PropertyController::class, 'list'])->name('list_properties');
    Route::get('types', [PropertyController::class, 'types'])->name('list_types');
    Route::get('features', [PropertyController::class, 'features'])->name('list_features');



});
Route::group(['prefix' => 'location'], function () {

    Route::get('counties', [LocationController::class, 'counties'])->name('get_counties');
    Route::get('county/{id}', [LocationController::class, 'county'])->name('get_county');


});


Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('profile', [LoginController::class, 'profile'])
            ->name('api_profile');
        Route::put('profile', [ClientsController::class, 'updateProfile'])
            ->name('api_update_profile');
    });
    Route::group(['prefix' => 'client'], function () {

        Route::get('bookings', [ClientsController::class, 'bookings'])->name('bookings');
        Route::post('bookings', [ClientsController::class, 'addBooking'])->name('add_bookings');
        Route::post('review', [ClientsController::class, 'addReview'])->name('add_review');
    });

});