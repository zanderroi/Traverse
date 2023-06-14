<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilePicture;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }

    public function index(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
    
            $latestProfilePicture = $user->profilepicture()->latest()->first();
    
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
    
            // Pass the cars and avatar to the view to display
            return view('customer.dashboard', ['cars' => $cars, 'location' => $location, 'user' => $user, 'latestProfilePicture'=>$latestProfilePicture]);
        }
    
        // Redirect to the login page if the user is not authenticated
        return redirect()->route('login');
    }
    
    
    

    public function availableCars(Request $request)
    {
        $user = Auth::user();
        
        $latestProfilePicture = $user->profilepicture()->latest()->first();
        $location = $request->input('location', '');
        $sort_by_rental_fee = $request->input('sort_by_rental_fee', 'asc');
        $transmission = $request->input('transmission', ''); // Get the selected transmission value
        
        // Query for all available cars (where deleted_at is null and status is available)
        $cars = Car::whereNull('deleted_at')
            ->where('status', 'available')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', $location);
            })
            ->when($transmission, function ($query) use ($transmission) {
                return $query->where('transmission', $transmission);
            })
            ->orderBy('rental_fee', $sort_by_rental_fee)
            ->get();
        
        // Pass the cars to the view to display
        return view('customer.dashboard', ['cars' => $cars,'transmission' => $transmission, 'location' => $location, 'user' => $user, 'latestProfilePicture' => $latestProfilePicture]);
    }
    

    public function garage()
    {
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $latestProfilePicture = $user->profilepicture()->latest()->first();
    
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
    
        return view('customer.garage', ['bookings' => $bookings, 'user' => $user, 'latestProfilePicture' => $latestProfilePicture]);
    }
    
    public function history()
    {
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $latestProfilePicture = $user->profilepicture()->latest()->first();
    
        // Get bookings for the logged-in customer where the booking status is "Returned" and paginate the results
        $bookings = Booking::where('user_id', $user_id)
            ->whereNotNull('returned_at')
            ->with('car.carRatings')
            ->orderByDesc('created_at')
            ->paginate(5);

    
        return view('customer.history', compact('bookings', 'user', 'latestProfilePicture'));
    }
    
    
    public function profile()
    {
        $user = Auth::user();
        $latestProfilePicture = $user->profilepicture()->latest()->first();
        return view('customer.profile', ['user' => $user, 'latestProfilePicture' => $latestProfilePicture]);
    }

    public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validate the input data
    $request->validate([
        'email' => 'required|email',
        'birthday' => 'required|date',
        'phone_number' => 'required',
        'address' => 'required',
        'contactperson1' => 'required',
        'contactperson1number' => 'required',
        'contactperson2' => 'required',
        'contactperson2number' => 'required',
    ]);

    // Update the user details
    $user->email = $request->input('email');
    $user->birthday = $request->input('birthday');
    $user->phone_number = $request->input('phone_number');
    $user->address = $request->input('address');
    $user->contactperson1 = $request->input('contactperson1');
    $user->contactperson1number = $request->input('contactperson1number');
    $user->contactperson2 = $request->input('contactperson2');
    $user->contactperson2number = $request->input('contactperson2number');
    $user->save();

    // Redirect back to the profile page with a success message
    return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
}
public function changePassword(Request $request)
{
    // Validate the request data
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    // Retrieve the authenticated user
    $user = Auth::user();

    // Verify if the old password matches the current password
    if (!Hash::check($request->old_password, $user->password)) {
        return redirect()->route('customer.profile')->with('error', 'The old password is incorrect.');
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('customer.profile')->with('success', 'Password changed successfully.');
}

    
}
