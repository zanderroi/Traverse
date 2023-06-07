<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\TrackingData;
use App\Http\Controllers\API\CarLocationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/update-location', function (Request $request) {
    $data = $request->json()->all();
    // Retrieve latitude and longitude from the JSON data
    $latitude = $data['latitude'];
    $longitude = $data['longitude'];

    // Retrieve other necessary data (car ID, customer ID, booking ID, etc.) from the JSON data
    $carId = $data['carId'];
    $customerId = $data['customerId'];
    $bookingId = $data['bookingId'];

    // // Retrieve latitude and longitude from the request
    // $latitude = $request->input('latitude');
    // $longitude = $request->input('longitude');

    // // Retrieve other necessary data (car ID, customer ID, booking ID, etc.) from the request
    // $carId = $request->input('carId');
    // $customerId = $request->input('customerId');
    // $bookingId = $request->input('bookingId');

    // You can perform additional processing or validation here if needed

    // Save the latitude, longitude, and other data to the database
    // Assuming you have a database table called "tracking_data"
    $trackingData = new TrackingData();
    $trackingData->car_id = $carId;
    $trackingData->customer_id = $customerId;
    $trackingData->latitude = $latitude;
    $trackingData->longitude = $longitude;
    $trackingData->booking_id = $bookingId;
    $trackingData->save();

    // Return the latitude, longitude, car ID, customer ID, and booking ID as a JSON response
    $response = [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'carId' => $carId,
        'customerId' => $customerId,
        'bookingId' => $bookingId
    ];

    return response()->json($response);
});
