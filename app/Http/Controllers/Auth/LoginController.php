<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $user = Auth::user();
            if ($user->account_status === 'Active') {
                // Account is active, proceed with login
                switch ($user->user_type) {
                    case 'car_owner':
                        return redirect()->intended('/car_owner/dashboard');
                    case 'customer':
                        return redirect()->intended('/customer/dashboard');
                    case 'admin':
                        return redirect()->intended('/admin/dashboard');
                }
            } else {
                // Account is not active
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is not active. Please contact the administrator.',
                ]);
            }
        } else {
            // Authentication failed
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
    


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->user();
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        // Create a new user if not found
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(Str::random(16)),
        ]);
    }

    // Log in the user
    Auth::login($user);

    // Redirect the user to the desired location
    return redirect()->intended('/home');
}
}