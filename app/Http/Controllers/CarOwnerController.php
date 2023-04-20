<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CarOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('car_owner.dashboard');
    }
    public function dashboard()
    {
        $cars = Car::where('car_owner_id', auth()->id())->get();

        return view('car_owner.dashboard', [
            'addCarLink' => route('car_owner.car_details'),
            'cars' => $cars
        ]);
    }    

    public function addCarDetails(Request $request)
{
    $addCarLink = route('car_owner.car_details');
    if ($request->isMethod('get')) {
        return view('car_owner.car_details');
    }

    // Validate the request data
    $request->validate([
        'display_picture' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        'car_brand' => ['required', 'string', 'max:255'],
        'car_model' => ['required', 'string', 'max:255'],
        'plate_number' => ['required', 'string', 'max:255'],
        'vehicle_identification_number' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'certificate_of_registration' => ['required', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        'car_description' => ['required', 'string', 'max:255'],
        'rental_fee' => 'required|numeric|min:0',
        'car_images' => 'required|array|min:1',
        'car_images.*' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);

    // Create new car instance
    $car = new Car;
    $car->display_picture = $request->file('display_picture')->store('public/dp');
    $car->car_brand = $request->car_brand;
    $car->car_model = $request->car_model;
    $car->plate_number = $request->plate_number;
    $car->vehicle_identification_number = $request->vehicle_identification_number;
    $car->location = $request->location;
    $car->certificate_of_registration = $request->file('certificate_of_registration')->store('public/cor');
    $car->car_description = $request->car_description;
    $car->rental_fee = $request->rental_fee;
    $car->status = 'available';
    $car->car_owner_id = Auth::id();
    $car->save();

    // Save car images
    foreach ($request->car_images as $image) {
        $filename = $image->store('public/car_images');
        CarImage::create([
            'car_id' => $car->id,
            'filename' => $filename
        ]);
    }

    // Redirect to car details page
    return redirect()->route('car_owner.dashboard', ['addCarLink' => $addCarLink])->with('success', 'Car details added successfully!');
}

}
