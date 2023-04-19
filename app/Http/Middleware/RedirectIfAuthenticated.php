<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $userType = Auth::user()->user_type;
                switch ($userType) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'customer':
                        return redirect()->route('customer.dashboard');
                    case 'car_owner':
                        return redirect()->route('car_owner.dashboard');
                    default:
                        return redirect('/home');
                }
            }
        }

        return $next($request);
    }
}
