<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\UnderEighteen;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $userType = Auth::user()->user_type;
    
        switch ($userType) {
            case 'admin':
                return route('admin.dashboard');
                break;
            case 'car_owner':
                return route('car_owner.dashboard');
                break;
            case 'customer':
                return route('customer.dashboard');
                break;
            default:
                return route('welcome');
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date', new UnderEighteen],
            'govtid' => ['required', 'string', 'max:255'],
            'govtid_image' => ['required', 'mimes:jpg,jpeg,png', 'max:2048'],
            'driverslicense' => ['required', 'string', 'max:255'],
            'driverslicense_image' => ['required', 'image', 'max:2048'],
            'selfie_image' => ['required', 'image', 'max:2048'],
            'contactperson1' => ['required', 'string', 'max:255'],
            'contactperson1number' => ['required', 'string', 'max:255'],
            'contactperson2' => ['required', 'string', 'max:255'],
            'contactperson2number' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'in:admin,customer,car_owner'],

        ]);
        $govtidImage = $data['govtid_image']->store('public/images');
        $driversLicenseImage = $data['driverslicense_image']->store('public/images');
        $selfieImage = $data['selfie_image']->store('public/images');
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $govtidImage = $data['govtid_image']->store('public/images');
        $driversLicenseImage = $data['driverslicense_image']->store('public/images');
        $selfieImage = $data['selfie_image']->store('public/images');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'govtid' => $data['govtid'],
            'govtid_image' => $govtidImage,
            'driverslicense' => $data['driverslicense'],
            'driverslicense_image' => $driversLicenseImage,
            'selfie_image'=> $selfieImage,
            'contactperson1' => $data['contactperson1'],
            'contactperson1number' => $data['contactperson1number'],
            'contactperson2' => $data['contactperson2'],
            'contactperson2number' => $data['contactperson2number'],
            'user_type' => $data['user_type'] == 'car_owner' ? 'car_owner' : ($data['user_type'] == 'admin' ? 'admin' : 'customer'),
            'account_status' => 'Active',
            'booking_status' => 'Available'

        ]);
    }
}
