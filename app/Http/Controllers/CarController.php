<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;

class CarController extends Controller
{
    // Booking Screen
// In your controller method for displaying the cars.show view
public function show($car_id) {
    $car = Car::find($car_id);
    $car_owner = $car->owner;

    return view('cars.show')->with([
        'car' => $car,
        'car_owner' => $car_owner
    ]);
}

    
    public function book($id)
{
    $car = Car::findOrFail($id);
    return view('cars.book', compact('car'));
}

    


}
