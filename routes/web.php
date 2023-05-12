<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarRatingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



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


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/cars/details', [AdminController::class, 'carshow'])->name('car.details');
Route::get('/car/{id}', [AdminController::class, 'show']);
Route::put('/car/{car}', [AdminController::class, 'update']);
Route::delete('/car/{car}', [AdminController::class, 'destroy']);

Route::get('/owners/details', [AdminController::class, 'ownershow'])->name('owners.details');
Route::get('/owner/{id}', [AdminController::class, 'showOwner']);
Route::put('/owner/{user}', [AdminController::class, 'ownerUpdate']);
Route::delete('/owner/{user}', [AdminController::class, 'ownerDestroy']);

Route::get('/customers/details', [AdminController::class, 'customershow'])->name('customers.details');
Route::get('/customer/{id}', [AdminController::class, 'showCustomer'])->name('customer.show');
Route::put('/customer/{user}', [AdminController::class, 'customerUpdate']);
Route::delete('/customer/{user}', [AdminController::class, 'customerDestroy']);


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

//Route to Book Now
Route::post('/bookings/confirm/{car_id}', [BookingController::class, 'confirm'])->name('bookings.confirm');

// Route::get('/bookings/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');

Route::get('bookings/{booking}/receipt', [BookingController::class, 'download'])->name('bookings.receipt');
// Route::get('/bookings/confirm/{id}', [BookingController::class, 'confirmBooking'])->name('bookings.confirm');

//Cancel Booking
Route::delete('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

//Customer Garage
Route::get('/customer/garage', [CustomerController::class, 'garage'])->name('customer.garage');

//Return Car
Route::get('/bookings/{booking_id}', [BookingController::class, 'returnCar'])->name('returncar');

//Booking History
Route::get('/history', [CustomerController::class, 'history'])->name('customer.history');

//Car Rating
Route::post('car/rating/{booking_id}/{car_owner_id}/{customer_id}', [CarRatingController::class, 'store'])->name('car.rating.store');

