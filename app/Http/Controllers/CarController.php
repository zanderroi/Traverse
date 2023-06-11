<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use App\Models\CarRating;
use app\Models\CarLocation;
use Illuminate\Support\Facades\DB;
use App\Models\ProfilePicture;
class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function show($car_id)
{

    $car = Car::find($car_id);
    $car_owner = $car->owner;

    // Fetch the booking status for the customer
    $user = auth()->user();
    $latestProfilePicture = $user->profilepicture()->latest()->first();
    $bookingStatus = $user->booking_status ?? null;

    // Fetch the ratings for the car
    $ratings = CarRating::where('car_id', $car->id)->get();

    // Calculate the average rating
    $averageRating = $ratings->avg('rating');

    // Calculate the percentage for each rating category
    $totalRatings = $ratings->count();
    $percentageArray = [];

    for ($i = 5; $i >= 1; $i--) {
        $count = $ratings->where('rating', $i)->count();
        $percentage = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
        $percentageArray[] = $percentage;
    }

    return view('cars.show')->with([
        'car' => $car,
        'user' => $user,
        'car_owner' => $car_owner,
        'bookingStatus' => $bookingStatus,
        'averageRating' => $averageRating,
        'ratings' => $ratings, // Add the 'ratings' variable to the view data
        'percentageArray' => $percentageArray,
        'latestProfilePicture' => $latestProfilePicture,
    ]);
}
public function showLocation($car_id)
{
    $car = Car::findOrFail($car_id);

    // Fetch the booking status for the customer
    $user = auth()->user();
    $bookingStatus = $user->booking_status ?? null;

    // Fetch the GPS location data for the car
    $locations = CarLocation::where('car_id', $car->id)->orderBy('timestamp', 'desc')->get();

    return view('cars.location')->with([
        'car' => $car,
        'bookingStatus' => $bookingStatus,
        'locations' => $locations,
    ]);
}   

}
