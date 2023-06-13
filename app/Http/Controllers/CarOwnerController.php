<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ProfilePicture;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Models\CarData;

class CarOwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'car_owner']);
    }

    public function index()
    {
        return view('car_owner.dashboard');
    }
    public function dashboard()
    {
        $user = Auth::user();
        $latestProfilePicture = $user->profilepicture()->latest()->first();
        $cars = Car::where('car_owner_id', auth()->id())->get();
        $users = User::where('id', auth()->id())->get();
        
        $bookedCarsCount = Car::where('car_owner_id', auth()->id())
                              ->where('status', 'booked')
                              ->count();
        
        return view('car_owner.dashboard', [
            'addCarLink' => route('car_owner.car_details'),
            'cars' => $cars,
            'users' => $users,
            'user' => $user,
            'latestProfilePicture' => $latestProfilePicture,
            'bookedCarsCount' => $bookedCarsCount
        ]);
    }
    

    public function addCarDetails(Request $request)
{
    $addCarLink = route('car_owner.car_details');
    if ($request->isMethod('get')) {
        $user = Auth::user();
        $carBrands = CarData::pluck('brand')->unique();
        $carModels = CarData::pluck('model')->unique();
        $carTypes = CarData::pluck('type')->unique();
    
        $latestProfilePicture = $user->profilepicture()->latest()->first();
        $bookedCarsCount = Car::where('car_owner_id', auth()->id())->where('status', 'booked')->count();
    
        $carModelsData = CarData::select('brand', 'model')->get();
        $carTypesData = CarData::select('model', 'type')->get();
    
        return view('car_owner.car_details', [
            'latestProfilePicture' => $latestProfilePicture,
            'bookedCarsCount' => $bookedCarsCount,
            'carBrands' => $carBrands,
            'carModels' => $carModels,
            'carTypes' => $carTypes,
            'carModelsData' => $carModelsData,
            'carTypesData' => $carTypesData,
        ]);
    }
    
    
        $user = Auth::user();
       
        $latestProfilePicture = $user->profilepicture()->latest()->first();
        $bookedCarsCount = Car::where('car_owner_id', auth()->id())
        ->where('status', 'booked')
        ->count();
    // Validate the request data
    $request->validate([
        'display_picture' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
        'car_brand' => ['required', 'string', 'max:30'],
        'car_model' => ['required', 'string', 'max:30'],
        'car_type' => ['required', 'string', 'max:30'],
        'transmission' => ['required', 'string', 'max:10'],
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
    $car->car_type = $request->car_type;
    $car->transmission = $request->transmission;
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
    $car->status = 'pending';
    $car->car_owner_id = Auth::id();
    $car->save();


    // Redirect to car details page
    return redirect()->route('car_owner.dashboard', ['addCarLink' => $addCarLink, 'latestProfilePicture' => $latestProfilePicture, 'bookedCarsCount' => $bookedCarsCount])->with('success', 'Car added successfully!');
}

public function deleteCar(Request $request, $car_id)
{
    $car = Car::find($car_id);

    if ($car->status == 'booked') {
        return redirect()->back()->with('error', 'You cannot unlist this car because it is booked.');
    }

    // Soft delete the car
    $car->delete();

    // Redirect back to the car owner dashboard
    return redirect()->route('car_owner.dashboard')->with('success', 'Car unlisted successfully.');
}

public function profile()
{
    $user = Auth::user();
    $latestProfilePicture = $user->profilepicture()->latest()->first();
    $bookedCarsCount = Car::where('car_owner_id', auth()->id())
    ->where('status', 'booked')
    ->count();
    return view('car_owner.profile', ['user' => $user, 'latestProfilePicture' => $latestProfilePicture, 'bookedCarsCount' => $bookedCarsCount]);
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
    $validated = $request->validate([
        'display_picture' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture1' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture2' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture3' => ['mimes:jpg,jpeg,png', 'max:2048'],
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
    if ($request->hasFile('display_picture')) {
        $displaypicture = $request->file('display_picture')->store('public/dp');
        $validated['display_picture'] = $displaypicture;
    }

    if ($request->hasFile('add_picture1')) {
        $add_picture1 = $request->file('add_picture1')->store('public/dp');
        $validated['add_picture1'] = $add_picture1;
    }
    if ($request->hasFile('add_picture2')) {
        $add_picture2 = $request->file('add_picture2')->store('public/dp');
        $validated['add_picture2'] = $add_picture2;
    }
    if ($request->hasFile('add_picture3')) {
        $add_picture3 = $request->file('add_picture3')->store('public/dp');
        $validated['add_picture3'] = $add_picture3;
    }

   
    $car->update($validated);
   

    // Redirect back to the car owner dashboard with a success message
    return redirect()->route('car_owner.dashboard')->with('success', 'Car details updated successfully!');
}


public function earnings()
{
    $user = Auth::user();
    $carOwner = auth()->user();
    $bookedCarsCount = Car::where('car_owner_id', auth()->id())
    ->where('status', 'booked')
    ->count();
    // Retrieve the returned cars with customer name and total rental fee
    $returnedCars = Booking::whereHas('car', function ($query) use ($carOwner) {
        $query->where('car_owner_id', $carOwner->id);
    })
    ->whereNotNull('returned_at')
    ->with(['customer', 'car'])
    ->select('car_id', 'user_id', DB::raw('SUM(total_rental_fee) as total_rental_fee'))
    ->groupBy('car_id', 'user_id')
    ->get();

    $totalRentalFee = $returnedCars->sum('total_rental_fee');
    $latestProfilePicture = $user->profilePicture()->latest()->first();
    return view('car_owner.earnings', compact('returnedCars', 'totalRentalFee','latestProfilePicture', 'bookedCarsCount'));
}

public function rentedcars()
{
    $user = Auth::user();
    $carOwner = auth()->user();
    $bookedCarsCount = Car::where('car_owner_id', auth()->id())
    ->where('status', 'booked')
    ->count();
    // Retrieve the booked cars with customer name, total rental fee, car owner, and car owner's user information
    $bookedCars = Car::where('car_owner_id', $carOwner->id)
    ->where('status', 'booked')
    ->with(['owner'])
    ->get();



    $latestProfilePicture = $user->profilepicture()->latest()->first();
    return view('car_owner.rentedcars', ['bookedCars' => $bookedCars, 'user' => $user, 'carOwner' => $carOwner, 'latestProfilePicture' => $latestProfilePicture, 'bookedCarsCount' => $bookedCarsCount]);
}

}
