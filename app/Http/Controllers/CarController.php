<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;

class CarController extends Controller
{

public function show($car_id) {
    $car = Car::find($car_id);
    $car_owner = $car->owner;

    return view('cars.show')->with([
        'car' => $car,
        'car_owner' => $car_owner
    ]);
}

}
