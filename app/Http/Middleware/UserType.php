<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$userTypes)
    {
        $user = Auth::user();
    
        if ($user && in_array($user->type, $userTypes)) {
            return $next($request);
        }
    
        return redirect('/login');
    }
    
}
