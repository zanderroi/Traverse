<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;




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
Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
Route::get('/car_owner/dashboard', [CarOwnerController::class, 'dashboard'])->name('car_owner.dashboard');
Route::get('/car_owner/car_details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.car_details');
Route::get('/car_owner/add-car-details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.addCarDetails');
Route::post('/car-owner/car-details', [CarOwnerController::class, 'addCarDetails'])->name('car_owner.add_car_details');
Route::delete('/car_owner/car/{car_id}', [CarOwnerController::class, 'deleteCar'])->name('car_owner.delete_car');

// Route to display all available cars
Route::get('/customer/cars', [CustomerController::class, 'availableCars'])->name('customer.available_cars');








