<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarRatingController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\CarLocationController;
use App\Http\Controllers\ProfilePictureController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Car;





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
})->name('welcome');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/ourteam', function () {
    return view('ourteam');
})->name('ourteam');

// Route for registration form submission
Route::post('auth/register', [RegisterController::class, 'register'])->name('auth.register');

// Route for displaying registration confirmation view
Route::get('auth/registrationconfirm', function () {
    return view('auth.registrationconfirm');
})->name('auth.registrationconfirm');

Route::get('login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [ForgotPasswordController::class, 'handleGoogleCallback']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Auth::routes();

//ADMIN ROUTES
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
Route::get('/graph', [GraphController::class, 'graph']);

Route::get('/admin/verification', [AdminController::class, 'verify'])->name('admin.verification');
Route::get('users/{userId}/approve', [AdminController::class, 'approveUser'])->name('admin.approveUser');
Route::get('users/{userId}/decline', [AdminController::class, 'declineUser'])->name('admin.declineUser');
Route::get('/admin/carapproval', [AdminController::class, 'carapprove'])->name('admin.carapproval');
Route::get('/admin/car/approve/{carId}/{ownerId}', [AdminController::class, 'approveCar'])->name('admin.car.approve');
Route::get('/admin/car/decline/{carId}/{ownerId}', [AdminController::class, 'declineCar'])->name('admin.car.decline');
Route::get('/admin/sales', [AdminController::class, 'sales'])->name('admin.sales');
Route::get('admin/sales-data', [AdminController::class, 'getSalesData'])->name('admin.sales.data');



//CAR OWNER ROUTES
Route::get('/car_owner/dashboard', [CarOwnerController::class, 'dashboard'])->name('car_owner.dashboard');
Route::get('/car_owner/car_details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.car_details');
Route::get('/car_owner/add-car-details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.addCarDetails');
Route::post('/car-owner/car-details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.add_car_details');
Route::delete('/car_owner/car/{car_id}', [CarOwnerController::class, 'deleteCar'])->name('car_owner.delete_car');
//Car Rating
Route::post('car/rating/{booking_id}/{car_owner_id}/{customer_id}', [CarRatingController::class, 'store'])->name('car.rating.store');
//Track Location
Route::get('/car_owner/location/{carId}', [CarLocationController::class,'showLocation'])->name('car_owner.location');
//Car Owner Profile
Route::get('/car_owner/profile', [CarOwnerController::class, 'profile'])->name('car_owner.profile');
//Car Owner Profile Picture
Route::post('/car_owner/profile', [ProfilePictureController::class, 'ownerstore'])->name('carownerpicture.ownerstore');
//Car Owner Update Profile
Route::put('/profile', [CarOwnerController::class, 'updateProfile'])->name('carowner.updateProfile');
//Car Owner Change Password
Route::post('/change-password', [CarOwnerController::class, 'changePassword'])->name('carowner.change-password');
//Car Owner Update Car Details
Route::put('/car_owner/update-car-details/{car_id}', [CarOwnerController::class, 'updateCarDetails'])->name('car_owner.update_car_details');
//Car Owner Earnings
Route::get('/car_owner/earnings', [CarOwnerController::class, 'earnings'])->name('car_owner.earnings');
//Car Owner Rented Cars
Route::get('/car_owner/rentedcars', [CarOwnerController::class, 'rentedcars'])->name('car_owner.rentedcars');
//Car Owner Earnings Send Receipt
Route::post('/store-commission', [CarOwnerController::class, 'storeCommission'])->name('store.commission');



//CUSTOMER ROUTES
Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
// Route to display all available cars
Route::get('/customer/cars', [CustomerController::class, 'availableCars'])->name('customer.available_cars');
//Booking Screen
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');
//Prevent double entry of booking
Route::get('booking/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
//Route to Book Now
Route::post('/bookings/confirm/{car_id}', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::get('bookings/{booking}/receipt', [BookingController::class, 'download'])->name('bookings.receipt');
//Email owner for booking
Route::get('booking/confirmemail/{car_id}', [BookingController::class, 'confirmemail'])->name('booking.confirmemail');

//Cancel Booking
Route::delete('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
//Customer Garage
Route::get('/customer/garage', [CustomerController::class, 'garage'])->name('customer.garage');
//Return Car
Route::get('/bookings/{booking_id}', [BookingController::class, 'returnCar'])->name('returncar');
//Extend Booking
Route::post('/bookings/{booking}/extend', [BookingController::class, 'extend'])->name('bookings.extend');
//Booking History
Route::get('/history', [CustomerController::class, 'history'])->name('customer.history');
//Customer Profile
Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
//Customer Profile Picture
Route::post('/customer/profile', [ProfilePictureController::class, 'store'])->name('profilepicture.store');
// Customer Update Profile
Route::put('/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');
// Customer Change Password
Route::post('/profile/change-password', [CustomerController::class, 'changePassword'])->name('change-password');

Route::post('/download-week-data-pdf', [AdminController::class, 'weeklyDL'])->name('downloadWeekDataPDF');
Route::post('/download-month-data-pdf', [AdminController::class, 'monthlyDL'])->name('downloadMonthDataPDF');