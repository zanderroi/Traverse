<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // ...
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $location = $request->input('location');

        // Query for all available cars (where deleted_at is null)
        $cars = Car::whereNull('deleted_at');
        
        // If location is provided, filter cars by location
        if ($location) {
            $cars = $cars->where('location', 'like', '%' . $location . '%');
        }
    
        $cars = $cars->get();
    
        // Pass the cars and location to the view to display
        return view('customer.dashboard', ['cars' => $cars, 'location' => $location]);
    }
    
    // ...
    public function availableCars(Request $request)
{
    $location = $request->input('location');

    // Query for all available cars (where deleted_at is null)
    $cars = Car::whereNull('deleted_at');
    
    // If location is provided, filter cars by location
    if ($location) {
        $cars = $cars->where('location', 'like', '%' . $location . '%');
    }

    $cars = $cars->get();

    // Pass the cars and location to the view to display
    return view('customer.dashboard', ['cars' => $cars, 'location' => $location]);
}

}
