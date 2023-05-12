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
        // $data = Car::all();
        $data = DB::table('users')->count();
        $carsCount = DB::table('cars')->count();
        $carOwners = DB::table('users')->where('user_type', 'car_owner')->count();
        $customers = DB::table('users')->where('user_type', 'customer')->count(); 
        // return view('admin.dashboard', ['cars' => $data]);
        return view('admin.dashboard', compact('data', 'carsCount', 'carOwners', 'customers'));
    }
    public function carshow()
    {
        $cars = Car::all();
        $carOwnersWithCars = DB::table('users')
        ->join('cars', 'users.id', '=', 'cars.car_owner_id')
        ->select('users.first_name', 'users.last_name')
        ->get();
        return view('admin.cars', compact('cars', 'carOwnersWithCars'));
  
    }
    public function ownershow()
    {
        $users = User::where('user_type', 'car_owner')->get();
        $carsWithOwners = DB::table('cars')
        ->join('users', 'cars.car_owner_id', '=', 'users.id' )
        ->select('users.first_name', 'users.last_name', 'cars.car_brand', 'cars.car_model', 'cars.year', 'cars.car_owner_id')
        ->get();
        return view('admin.owners', compact('users', 'carsWithOwners'));
  
    }
    public function customershow()
    {
        $users = User::where('user_type', 'customer')->withCount('bookings')->get();
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
        'car_description' => ['required', 'string', 'max:255'],
        'rental_fee' => 'required|numeric|min:0',
        'add_picture1' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture2' => ['mimes:jpg,jpeg,png', 'max:2048'],
        'add_picture3' => ['mimes:jpg,jpeg,png', 'max:2048'],

        ]);
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

}
