<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Rules\UnderEighteen;
use App\Models\Booking;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function dashboard()
    {
        $carsCount = DB::table('cars')->whereNull('deleted_at')->count();
    
        $bookedCarsCount = DB::table('bookings')->count();
        $availableCarsCount = $carsCount - $bookedCarsCount;
    
        $carOwnersOnTransactions = User::where('user_type', 'car_owner')
                                ->whereHas('cars', function ($query) {
                                    $query->whereHas('bookings');
                                })
                                ->count();
    
        $carOwnersVacant = User::where('user_type', 'car_owner')
                        ->whereDoesntHave('cars', function ($query) {
                            $query->whereHas('bookings');
                        })
                        ->count();
    
        $customersOnTransactions = User::where('user_type', 'customer')
                                ->whereHas('bookings')
                                ->count();
    
        $customersVacant = User::where('user_type', 'customer')
                        ->whereDoesntHave('bookings')
                        ->count();
    
        $carOwners = $carOwnersOnTransactions + $carOwnersVacant;
        $customers = $customersOnTransactions + $customersVacant;
    
        $totalBookings = DB::table('bookings')->count();
        $bookingsDone = Booking::whereNotNull('returned_at')->count();
        $bookingsOngoing = Booking::whereNull('returned_at')->count();
    
        return view('admin.dashboard', compact(
            'carsCount',
            'carOwners',
            'customers',
            'bookedCarsCount',
            'availableCarsCount',
            'carOwnersOnTransactions',
            'carOwnersVacant',
            'customersOnTransactions',
            'customersVacant',
            'totalBookings',
            'bookingsDone',
            'bookingsOngoing'
        ));
    }
    public function carshow()
    {
        $cars = Car::with('owner', 'bookings.customer')->paginate(10);
        $carOwnersWithCars = DB::table('users')
        ->join('cars', 'users.id', '=', 'cars.car_owner_id')
        ->select('users.first_name', 'users.last_name')
        ->get();
        return view('admin.cars', compact('cars', 'carOwnersWithCars'));
  
    }
    public function ownershow()
    {
        $users = User::where('user_type', 'car_owner')->paginate(10);
        $carsWithOwners = DB::table('cars')
        ->join('users', 'cars.car_owner_id', '=', 'users.id' )
        ->select('users.first_name', 'users.last_name', 'cars.car_brand', 'cars.car_model', 'cars.year', 'cars.car_owner_id')
        ->get();
        return view('admin.owners', compact('users', 'carsWithOwners'));
  
    }
    public function customershow()
    {
        $users = User::where('user_type', 'customer')->withCount('bookings')->paginate(10);

        // Load the related bookings, cars, and their owners
        $users->load('bookings.car.owner');

        return view('admin.customers',compact('users'));
    }
    
    public function show($id)
    {
        $data = Car::findOrFail($id);
        // dd($data);
        $carOwnersWithCars = DB::table('users')
        ->join('cars', 'users.id', '=', 'cars.car_owner_id')
        ->select('users.first_name', 'users.last_name')
        ->where('cars.id', $id)
        ->get();
        return view('admin.edit', ['car' => $data, 'carOwnersWithCars' => $carOwnersWithCars]);
    }
    public function showOwner($id)
    {
        $user = User::findOrFail($id);

        return view('admin.ownerEdit', ['user' => $user]);
    }
    public function showCustomer($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editCustomer', ['user' => $user]);
    }
    public function update(Request $request, Car $car){
      
        $validated = $request->validate([
        'display_picture' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'car_brand' => ['required', 'string', 'max:255'],
        'car_model' => ['required', 'string', 'max:255'],
        'year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
        'seats' => ['required', 'integer', 'min:1'],
        'plate_number' => ['required', 'string', 'max:255'],
        'vehicle_identification_number' => ['required', 'string', 'max:255'],
        'location' => ['required', 'string', 'max:255'],
        'certificate_of_registration' => ['mimes:jpg,jpeg,png,pdf', 'max:2048'],
        'car_description' => ['required', 'string', 'max:1000'],
        'rental_fee' => 'required|numeric|min:0',
        'add_picture1' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture2' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture3' => ['mimes:jpg,jpeg,png', 'max:2048'],

        ]);
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
        if ($request->hasFile('certificate_of_registration')) {
            $certificate_of_registration = $request->file('certificate_of_registration')->store('public/cor');
            $validated['certificate_of_registration'] = $certificate_of_registration;
        }
       
        $car->update($validated);
        
        return redirect('/cars/details')->with('message', 'Data was successfully updated');
    }
    public function ownerUpdate(Request $request, User $user){
            $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['string', 'min:8'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date', new UnderEighteen],
            'govtid' => ['required', 'string', 'max:255'],
            'govtid_image' => ['mimes:jpg,jpeg,png', 'max:2048'],
            'driverslicense' => ['required', 'string', 'max:255'],
            'driverslicense_image' => [ 'image', 'max:2048'],
            'driverslicense2_image' => [ 'image', 'max:2048'],
            'selfie_image' => ['image', 'max:2048'],
            'contactperson1' => ['required', 'string', 'max:255'],
            'contactperson1number' => ['required', 'string', 'max:255'],
            'contactperson2' => ['required', 'string', 'max:255'],
            'contactperson2number' => ['required', 'string', 'max:255'],
        ]);
        if ($request->hasFile('govtid_image')) {
            $govtidImage = $request->file('govtid_image')->store('public/images');
            $validated['govtid_image'] = $govtidImage;
        }
    
        if ($request->hasFile('driverslicense_image')) {
            $driversLicenseImage = $request->file('driverslicense_image')->store('public/images');
            $validated['driverslicense_image'] = $driversLicenseImage;
        }
    
        if ($request->hasFile('driverslicense2_image')) {
            $driversLicense2Image = $request->file('driverslicense2_image')->store('public/images');
            $validated['driverslicense2_image'] = $driversLicense2Image;
        }
    
        if ($request->hasFile('selfie_image')) {
            $selfieImage = $request->file('selfie_image')->store('public/images');
            $validated['selfie_image'] = $selfieImage;
        }
        $user->update($validated);
        
        return redirect('/owners/details')->with('message', 'Data was successfully updated');
    }
    public function customerUpdate(Request $request, User $user){
        $validated = $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['string', 'min:8'],
        'address' => ['required', 'string', 'max:255'],
        'phone_number' => ['required', 'string', 'max:255'],
        'birthday' => ['required', 'date', new UnderEighteen],
        'govtid' => ['required', 'string', 'max:255'],
        'govtid_image' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'driverslicense' => ['required', 'string', 'max:255'],
        'driverslicense_image' => [ 'image', 'max:2048'],
        'driverslicense2_image' => [ 'image', 'max:2048'],
        'selfie_image' => ['image', 'max:2048'],
        'contactperson1' => ['required', 'string', 'max:255'],
        'contactperson1number' => ['required', 'string', 'max:255'],
        'contactperson2' => ['required', 'string', 'max:255'],
        'contactperson2number' => ['required', 'string', 'max:255'],
    ]);

    if ($request->hasFile('govtid_image')) {
        $govtidImage = $request->file('govtid_image')->store('public/images');
        $validated['govtid_image'] = $govtidImage;
    }

    if ($request->hasFile('driverslicense_image')) {
        $driversLicenseImage = $request->file('driverslicense_image')->store('public/images');
        $validated['driverslicense_image'] = $driversLicenseImage;
    }

    if ($request->hasFile('driverslicense2_image')) {
        $driversLicense2Image = $request->file('driverslicense2_image')->store('public/images');
        $validated['driverslicense2_image'] = $driversLicense2Image;
    }

    if ($request->hasFile('selfie_image')) {
        $selfieImage = $request->file('selfie_image')->store('public/images');
        $validated['selfie_image'] = $selfieImage;
    }
    $user->update($validated);
    
    return redirect('/customers/details')->with('message', 'Data was successfully updated');
}
    
    public function destroy(Car $car){
        $car->delete();
        return redirect('/cars/details')->with('message', 'Data was successfully deleted');
    }
    public function ownerDestroy(User $user){
        $user->cars()->delete(); // Delete associated cars
        $user->delete(); // Delete the owner
        return redirect('/owners/details')->with('message', 'Data was successfully deleted');
    }
    public function customerDestroy(User $user){
        $user->bookings()->delete(); // Delete associated bookings
        $user->delete(); // Delete the customer
        return redirect('/customers/details')->with('message', 'Data was successfully deleted');
    }

    public function bookshow()
    {
        $bookings = Booking::paginate(10);
        $bookings->load('car.owner');
        $bookingClient = DB::table('users')
        ->join('bookings', 'users.id', '=', 'bookings.user_id')
        ->select('users.first_name', 'users.last_name')
        ->get();
        

        return view('admin.bookings', compact('bookings', 'bookingClient'));
    }

}

