<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\UnderEighteen;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function registered(Request $request, $user)
    {
        if (in_array($user->user_type, ['car_owner', 'customer'])) {
            $this->guard()->logout(); // Log out the user
            $request->session()->invalidate(); // Invalidate the session
            return redirect()->route('auth.registrationconfirm');
        }
    
        return redirect($this->redirectPath());
    }
    

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,13'],
            'birthday' => ['required', 'date', new UnderEighteen],
            'govtid' => ['required', 'string', 'max:255'],
            'govtid_image' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
            'driverslicense' => ['required', 'string', 'max:255'],
            'driverslicense_image' => ['required', 'image', 'max:2048'],
            'driverslicense2_image' => ['required', 'image', 'max:2048'],
            'selfie_image' => ['required', 'image', 'max:2048'],
            'contactperson1' => ['required', 'string', 'max:255'],
            'contactperson1number' => ['required', 'numeric', 'digits_between:10,13'],
            'contactperson2' => ['required', 'string', 'max:255'],
            'contactperson2number' => ['required', 'numeric', 'digits_between:10,13'],
            'user_type' => ['required', 'in:admin,customer,car_owner'],
        ]);
    }

    protected function create(array $data)
    {
        $uploadedImages = $this->storeUploadedImages($data, [
            'govtid_image',
            'driverslicense_image',
            'driverslicense2_image',
            'selfie_image',
        ]);

        $userType = $this->getUserType($data['user_type']);

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'govtid' => $data['govtid'],
            'govtid_image' => $uploadedImages['govtid_image'],
            'driverslicense' => $data['driverslicense'],
            'driverslicense_image' => $uploadedImages['driverslicense_image'],
            'driverslicense2_image' => $uploadedImages['driverslicense2_image'],
            'selfie_image' => $uploadedImages['selfie_image'],
            'contactperson1' => $data['contactperson1'],
            'contactperson1number' => $data['contactperson1number'],
            'contactperson2' => $data['contactperson2'],
            'contactperson2number' => $data['contactperson2number'],
            'user_type' => $userType,
            'account_status' => 'Deactivated',
            'booking_status' => 'Available',
        ]);
     
    }

    protected function storeUploadedImages(array $data, array $imageFields)
    {
        $uploadedImages = [];

        foreach ($imageFields as $field) {
            $uploadedImages[$field] = request()->file($field)->store('public/images');
        }

        return $uploadedImages;
    }

    protected function getUserType($userType)
    {
        $validUserTypes = ['admin', 'customer', 'car_owner'];

        if (in_array($userType, $validUserTypes)) {
            return $userType;
        }

        return 'customer'; // Default user type if invalid type provided
    }
}
