<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Car;
class CarOwnerComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        View::composer('car_owner.dashboard', function ($view) {
            $bookedCarsCount = Car::where('car_owner_id', auth()->user()->id)
                                  ->where('status', 'booked')
                                  ->count();
    
            $view->with('bookedCarsCount', $bookedCarsCount);
        });
    }
    

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('car_owner.dashboard', function ($view) {
            $bookedCarsCount = Car::where('car_owner_id', auth()->user()->id)
                                  ->where('status', 'booked')
                                  ->count();

            $view->with('bookedCarsCount', $bookedCarsCount);
        });
    }
}
