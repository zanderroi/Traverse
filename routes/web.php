<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */
 Route::get('/', function () {
     return view('welcome');

    
 });

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin', 'dashboard');
});


Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
Route::get('/car_owner/dashboard', [CarOwnerController::class, 'dashboard'])->name('car_owner.dashboard');
Route::get('/car_owner/car_details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.car_details');
Route::get('/car_owner/add-car-details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.addCarDetails');
Route::post('/car-owner/car-details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.add_car_details');
Route::delete('/car_owner/car/{car_id}', [CarOwnerController::class, 'deleteCar'])->name('car_owner.delete_car');

// Route to display all available cars
Route::get('/customer/cars', [CustomerController::class, 'availableCars'])->name('customer.available_cars');

//Booking Screen
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');

Route::get('/cars/{id}/book', [CarController::class, 'book'])->name('cars.book');

//Booking Form Submission
Route::post('/bookings/store/{car}', [BookingController::class, 'store'])->name('bookings.store');


//Route to Book Now
Route::get('/bookings/create/{id}', [BookingController::class, 'createBooking'])->name('bookings.create');

//Booking Form





















