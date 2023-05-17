<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\TrackingData;

class CarLocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        // Retrieve latitude and longitude from the request
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Retrieve other necessary data (car ID, customer ID, booking ID) from the request
        $carId = $request->input('carId');
        $customerId = $request->input('customerId');
        $bookingId = $request->input('bookingId');

        // You can perform additional processing or validation here if needed

        // Save the latitude, longitude, and other data to the database
        // Assuming you have a model for the "tracking_data" table
        $trackingData = new TrackingData();
        $trackingData->car_id = $carId;
        $trackingData->customer_id = $customerId;
        $trackingData->latitude = $latitude;
        $trackingData->longitude = $longitude;
        $trackingData->booking_id = $bookingId;
        $trackingData->save();

        // Return a response indicating success
        return response()->json([
            'message' => 'Location updated successfully',
        ]);
    }
//     public function showLocation($carId, Request $request)
// {
//     $latitude = $request->query('latitude');
//     $longitude = $request->query('longitude');

//     // Retrieve the car details
//     $car = Car::find($carId);

//     // Retrieve the customer details
//     $customerId = $car->customer_id;
//     $customer = User::find($customerId);

//     // Retrieve the booking details
//     $bookingId = $car->booking_id;
//     $booking = Booking::find($bookingId);

//     return view('car_owner.location', [
//         'car' => $car,
//         'customer' => $customer,
//         'booking' => $booking,
//         'latitude' => $latitude,
//         'longitude' => $longitude,
//         // Pass any other necessary data to the view
//     ]);
// }



    public function showLocation($carId)
    {
        // Retrieve the car location data from the database based on the car ID
        $carLocation = TrackingData::where('car_id', $carId)->latest()->first();
    
        // Check if the car location data exists
        if ($carLocation) {
            $latitude = $carLocation->latitude;
            $longitude = $carLocation->longitude;
            // Add any other necessary data from the car location
    
            // Retrieve the car details
            $car = Car::find($carId);
    
            if ($car) {
                // Retrieve the customer details
                $customerId = $carLocation->customer_id;
                $customer = User::find($customerId);
    
                // Retrieve the booking details
                $bookingId = $carLocation->booking_id;
                $booking = Booking::find($bookingId);
    
                return view('car_owner.location', [
                    'car' => $car,
                    'customer' => $customer,
                    'booking' => $booking,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    // Pass any other necessary data to the view
                ]);
            }
        }
    
//Return dummy values for latitude and longitude
$defaultLatitude = 51.5074; // Example: London latitude
$defaultLongitude = -0.1278; // Example: London longitude
    
        $car = Car::find($carId);
        $customer = null;
        $booking = null;
    
        return view('car_owner.location', [
            'car' => $car,
            'customer' => $customer,
            'booking' => $booking,
            'latitude' => $carLocation ? $latitude : $defaultLatitude,
            'longitude' => $carLocation ? $longitude : $defaultLongitude,
            // Pass any other necessary data to the view
        ]);
    }
    
    
    
}
