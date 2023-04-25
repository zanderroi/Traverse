<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
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

    public function availableCars(Request $request)
    {
        $location = $request->input('location', '');
        $sort_by_rental_fee = $request->input('sort_by_rental_fee', 'asc');

        // Query for all available cars (where deleted_at is null)
        $cars = Car::whereNull('deleted_at')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', $location);
            })
            ->orderBy('rental_fee', $sort_by_rental_fee)
            ->get();

        // Pass the cars to the view to display
        return view('customer.dashboard', ['cars' => $cars, 'location' => $location]);
    }
}
