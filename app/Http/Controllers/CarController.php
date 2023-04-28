<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;

class CarController extends Controller
{
    // Booking Screen
    public function show($id)
    {
        $car = Car::findOrFail($id);
        $car_images = $car->carImages;
        return view('cars.show', compact('car', 'car_images'));
    }
    
    public function book($id)
{
    $car = Car::findOrFail($id);
    return view('cars.book', compact('car'));
}

    


}
