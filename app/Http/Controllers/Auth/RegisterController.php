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
use Illuminate\Http\Request;


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

    protected function registered(Request $request, $user)
    {
        if ($user->user_type === 'car_owner' || $user->user_type === 'customer') {
            return redirect()->route('auth.registrationconfirm');
        }

        return redirect($this->redirectPath());
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

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
        if ($validator->passes()) {
            $govtidImage = request()->file('govtid_image')->store('public/images');
            $driversLicenseImage = request()->file('driverslicense_image')->store('public/images');
            $driversLicense2Image = request()->file('driverslicense2_image')->store('public/images');
            $selfieImage = request()->file('selfie_image')->store('public/images');
        }
    
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
        $driversLicense2Image = $data['driverslicense2_image']->store('public/images');
        $selfieImage = $data['selfie_image']->store('public/images');
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'govtid' => $data['govtid'],
            'govtid_image' => $govtidImage,
            'driverslicense' => $data['driverslicense'],
            'driverslicense_image' => $driversLicenseImage,
            'driverslicense2_image' => $driversLicense2Image,
            'selfie_image'=> $selfieImage,
            'contactperson1' => $data['contactperson1'],
            'contactperson1number' => $data['contactperson1number'],
            'contactperson2' => $data['contactperson2'],
            'contactperson2number' => $data['contactperson2number'],
            'user_type' => $data['user_type'] == 'car_owner' ? 'car_owner' : ($data['user_type'] == 'admin' ? 'admin' : 'customer'),
            'account_status' => 'Deactivated',
            'booking_status' => 'Available'

        ]);
    }
}
