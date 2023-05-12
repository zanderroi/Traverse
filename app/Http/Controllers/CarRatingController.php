<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use App\Models\CarRating;

class CarRatingController extends Controller
{
    //
    public function store(Request $request, $booking_id, $car_owner_id, $customer_id)
{
    // Retrieve the booking, car, and car owner objects
    $booking = Booking::findOrFail($booking_id);
    $car = $booking->car;
    $car_owner = $car->owner;

    // Make sure the user is the customer who booked the car
    $customer = User::findOrFail($customer_id);
    if ($customer->id !== $request->user()->id) {
        abort(403, 'You are not authorized to perform this action.');
    }

    // Check if the customer has already rated the car
    $existingRating = CarRating::where('customer_id', $customer_id)
        ->where('car_id', $car->id)
        ->first();
    if ($existingRating) {
        abort(400, 'You have already rated this car.');
    }

    // Create and save the car rating
    $carRating = new CarRating();
    $carRating->rating = $request->input('rating');
    $carRating->description = $request->input('description');
    $carRating->customer_id = $customer_id;
    $carRating->car_id = $car->id;
    $carRating->car_owner_id = $car_owner_id;
    $carRating->save();

    // Calculate and update car rating
    $car->ratings = $car->carRatings()->avg('rating');
    $car->save();

    return redirect()->back()->with('success', 'Thank you for your rating and review.');
}

   

    

}
