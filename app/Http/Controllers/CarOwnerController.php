<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Avatar;

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
        $user = Auth::user();
        $cars = Car::where('car_owner_id', auth()->id())->get();
        $users = User::where('id', auth()->id())->get();
        return view('car_owner.dashboard', [
            'addCarLink' => route('car_owner.car_details'),
            'cars' => $cars,
            'users' => $users,
            'user' => $user
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
        'car_brand' => ['required', 'string', 'max:30'],
        'car_model' => ['required', 'string', 'max:30'],
        'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'seats' => ['required', 'integer', 'min:1'],
        'plate_number' => ['required', 'string', 'max:255'],
        'vehicle_identification_number' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'certificate_of_registration' => ['required', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        'car_description' => ['required', 'string', 'max:1000'],
        'rental_fee' => 'required|numeric|min:0',
        'add_picture1' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture2' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture3' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);

    // Create new car instance
    $car = new Car;
    $car->display_picture = $request->file('display_picture')->store('public/dp');
    $car->car_brand = $request->car_brand;
    $car->car_model = $request->car_model;
    $car->year = $request->year;
    $car->seats = $request->seats;
    $car->plate_number = $request->plate_number;
    $car->vehicle_identification_number = $request->vehicle_identification_number;
    $car->location = $request->location;
    $car->certificate_of_registration = $request->file('certificate_of_registration')->store('public/cor');
    $car->car_description = $request->car_description;
    $car->rental_fee = $request->rental_fee;
    $car->add_picture1 = $request->file('add_picture1')->store('public/dp');
    $car->add_picture2 = $request->file('add_picture2')->store('public/dp');
    $car->add_picture3 = $request->file('add_picture3')->store('public/dp');
    $car->status = 'available';
    $car->car_owner_id = Auth::id();
    $car->save();


    // Redirect to car details page
    return redirect()->route('car_owner.dashboard', ['addCarLink' => $addCarLink])->with('success', 'Car details added successfully!');
}

public function deleteCar(Request $request, $car_id)
{
    $car = Car::find($car_id);


    // Soft delete the car
    $car->delete();

    // Redirect back to the car owner dashboard
    return redirect()->route('car_owner.dashboard');
}
public function profile()
{
    $user = Auth::user();
    return view('car_owner.profile', ['user' => $user]);
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
    return redirect()->route('car_owner.profile')->with('success', 'Profile updated successfully!');
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
        return redirect()->route('car_owner.profile')->with('error', 'The old password is incorrect.');
    }

    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('car_owner.profile')->with('success', 'Password changed successfully.');
}

public function updateCarDetails(Request $request, $car_id)
{
    // Find the car by ID
    $car = Car::findOrFail($car_id);

    // Validate the request data
    $request->validate([
        'car_brand' => ['required', 'string', 'max:30'],
        'car_model' => ['required', 'string', 'max:30'],
        'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'seats' => ['required', 'integer', 'min:1'],
        'plate_number' => ['required', 'string', 'max:255'],
        'vehicle_identification_number' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'car_description' => ['required', 'string', 'max:1000'],
        'rental_fee' => 'required|numeric|min:0',
    ]);

    // Update the car details
    $car->car_brand = $request->input('car_brand');
    $car->car_model = $request->input('car_model');
    $car->year = $request->input('year');
    $car->seats = $request->input('seats');
    $car->plate_number = $request->input('plate_number');
    $car->vehicle_identification_number = $request->input('vehicle_identification_number');
    $car->location = $request->input('location');
    $car->car_description = $request->input('car_description');
    $car->rental_fee = $request->input('rental_fee');
    $car->save();

    // Redirect back to the car owner dashboard with a success message
    return redirect()->route('car_owner.dashboard')->with('success', 'Car details updated successfully!');
}



}
