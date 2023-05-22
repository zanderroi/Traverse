<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarRatingController;
use App\Http\Controllers\GraphController;
use App\Models\Car;
use App\Http\Controllers\CarLocationController;
use App\Http\Controllers\AvatarController;
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
    $cars = Car::where('status', 'available')->get();
    return view('welcome', compact('cars'));
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route::get('/traverse-chats', function () {
//     return view('traverse-chats');
// })->name('traverse-chats');



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
Route::get('/customers/{id}', [AdminController::class, 'showCustomer']);
Route::put('/customer/{user}', [AdminController::class, 'customerUpdate']);
Route::delete('/customer/{user}', [AdminController::class, 'customerDestroy']);

Route::get('/reservation/details', [AdminController::class, 'bookshow']);

Route::get('/graph/bookings', [GraphController::class, 'showGraph']);
Route::get('/graph/cars', [GraphController::class, 'carGraph']);
Route::get('/graph/customers', [GraphController::class, 'customerGraph']);
Route::get('/graph/owners', [GraphController::class, 'ownerGraph']);
Route::get('/graph', [GraphController::class, 'graph']);



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

//Track Location
Route::get('/car_owner/location/{carId}', [CarLocationController::class,'showLocation'])->name('car_owner.location');

//Customer Profile
Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');

//Customer Profile Picture
Route::post('/customer/profile', [AvatarController::class, 'store'])->name('avatar.store');

//Customer Update Profile
Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');

//Customer Change Password
Route::post('/change-password', [CustomerController::class, 'changePassword'])->name('change-password');

//Car Owner Profile
Route::get('/car_owner/profile', [CarOwnerController::class, 'profile'])->name('car_owner.profile');

//Car Owner Profile Picture
Route::post('/car_owner/profile', [AvatarController::class, 'store'])->name('carowneravatar.store');

//Car Owner Update Profile
Route::put('/profile', [CarOwnerController::class, 'updateProfile'])->name('carowner.updateProfile');

//Car Owner Change Password
Route::post('/change-password', [CarOwnerController::class, 'changePassword'])->name('carowner.change-password');



