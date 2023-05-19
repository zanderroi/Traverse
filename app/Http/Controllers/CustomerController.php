<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Avatar;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $location = $request->input('location', '');
        $sort_by_rental_fee = $request->input('sort_by_rental_fee', 'asc');
    
        // Query for all available cars (where deleted_at is null and status is available)
        $cars = Car::whereNull('deleted_at')
            ->where('status', 'available')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', $location);
            })
            ->orderBy('rental_fee', $sort_by_rental_fee)
            ->get();
            
        // Pass the cars to the view to display
        return view('customer.dashboard', ['cars' => $cars, 'location' => $location, 'user' => $user]);
    }

    public function availableCars(Request $request)
    {
        $user = Auth::user();
        $location = $request->input('location', '');
        $sort_by_rental_fee = $request->input('sort_by_rental_fee', 'asc');
    
        // Query for all available cars (where deleted_at is null and status is available)
        $cars = Car::whereNull('deleted_at')
            ->where('status', 'available')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', $location);
            })
            ->orderBy('rental_fee', $sort_by_rental_fee)
            ->get();
        
        // Pass the cars to the view to display
        return view('customer.dashboard', ['cars' => $cars, 'location' => $location, 'user' => $user]);
    }

    public function garage()
    {
        $user_id = Auth::user()->id;
        $user = Auth::user();
    
        // Get bookings for the logged-in customer where the booking status is "Pending" and the car has not been returned yet
        $bookings = Booking::where('user_id', $user_id)
            ->whereHas('user', function($query) {
                $query->where('booking_status', 'Pending');
            })
            ->whereHas('car', function($query) {
                $query->where('status', 'booked');
            })
            ->whereNull('returned_at')
            ->with('car')
            ->get();
    
        return view('customer.garage', ['bookings' => $bookings, 'user' => $user]);
    }
    
    public function history()
    {
        $user_id = Auth::user()->id;
        $user = Auth::user();
    
        // Get bookings for the logged-in customer where the booking status is "Returned"
        $bookings = Booking::where('user_id', $user_id)
            ->whereNotNull('returned_at')
            ->with('car.carRatings')
            ->get();
    
        return view('customer.history', ['bookings' => $bookings, 'user' => $user]);
    }
    
    public function profile()
    {
        $user = Auth::user();
        return view('customer.profile', ['user' => $user]);
    }
    
}
