<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $customers = DB::table('users')->where('user_type', 'car_owner')->count();
        // return view('admin.dashboard', ['cars' => $data]);
        return view('admin.dashboard', compact('data', 'carsCount', 'carOwners', 'customers'));
    }
    public function carshow()
    {
        $cars = Car::all();
        return view('admin.cars', ['cars' => $cars]);
  
    }

}
