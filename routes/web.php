<?php

use App\Http\Controllers\ApartmentsController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::match(['GET', 'POST'], 'login', [AuthController::class, 'login'])->name('login');

Route::match(['GET', 'POST'], 'logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(RedirectIfAuthenticated::class)->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    //clients 
    Route::group(['prefix' => 'clients'], function () {
        Route::get('', [ClientsController::class, 'index'])->name('clients');
        Route::match(['GET', 'POST'], '/create', [ClientsController::class, 'create'])->name('client_add');
        Route::put('/edit/{id}', [ClientsController::class, 'edit'])->name('client_edit');
        Route::delete('/delete/{id}', [ClientsController::class, 'delete'])->name('client_delete');

    });
    //clients 
    Route::group(['prefix' => 'customers'], function () {
        Route::get('', [CustomersController::class, 'index'])->name('customers');
        Route::get('/bookings/{id}', [CustomersController::class, 'viewBookings'])->name('customer_bookings');

    });
    //apartments
    Route::group(['prefix' => 'apartments'], function () {
        Route::get('', [ApartmentsController::class, 'index'])->name('apartments');
        Route::match(['GET', 'POST'], '/create', [ApartmentsController::class, 'create'])->name('apartment_add');
        Route::put('/edit/{id}', [ApartmentsController::class, 'edit'])->name('apartment_edit');
        Route::delete('/delete/{id}', [ApartmentsController::class, 'delete'])->name('apartment_delete');
    });
    //properties
    Route::group(['prefix' => 'properties'], function () {
        Route::get('', [PropertyController::class, 'index'])->name('properties');
        Route::get('view/{id}', [PropertyController::class, 'view'])->name('property_view');
        Route::match(['GET', 'POST'], '/create', [PropertyController::class, 'create'])->name('property_add');
        Route::match(['POST'], '/upload-image/{id}', [PropertyController::class, 'uploadImage'])->name('property_image_upload');
        Route::put('/edit/{id}', [PropertyController::class, 'edit'])->name('property_edit');
        Route::match(['GET','DELETE'],'/delete/{id}', [PropertyController::class, 'delete'])->name('property_delete');
        Route::post('/assign-feature/{id}', [PropertyController::class, 'assignFeature'])->name('property_assign_feature');
        Route::post('/de-assign-feature/{id}', [PropertyController::class, 'deAssignFeature'])->name('property_de_assign_feature');

        Route::group(['prefix' => 'bookings'], function () {
            Route::get('', [PropertyController::class, 'bookings'])->name('property_bookings');
            Route::match(['GET', 'POST'], 'create', [FeaturesController::class, 'create'])->name('feature_add');
            Route::put('/edit/{id}', [FeaturesController::class, 'edit'])->name('feature_edit');
            Route::match(['GET', 'DELETE'], 'delete/{id}', [FeaturesController::class, 'delete'])->name('feature_delete');
        });    

    });

    Route::match(['GET',"DELETE"],'photo/delete/{id}',[PropertyController::class,'deletePhoto'])->name('remove_image');
    //features
    Route::group(['prefix' => 'features'], function () {
        Route::get('', [FeaturesController::class, 'index'])->name('features');
        Route::match(['GET', 'POST'], 'create', [FeaturesController::class, 'create'])->name('feature_add');
        Route::put('/edit/{id}', [FeaturesController::class, 'edit'])->name('feature_edit');
        Route::match(['GET', 'DELETE'], 'delete/{id}', [FeaturesController::class, 'delete'])->name('feature_delete');
    });

});