<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // ...
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        // Query for all available cars (where deleted_at is null)
        $cars = Car::whereNull('deleted_at')->get();
    
        return view('customer.dashboard', ['cars' => $cars]);
    }
    
    // ...
}
