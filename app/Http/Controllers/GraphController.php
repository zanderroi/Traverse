<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class GraphController extends Controller
{
//     public function showGraph()
//     {
//         // Fetch the booking data from the database
//         $bookings = DB::table('bookings')
//             ->select(
//                 DB::raw('DATE(created_at) AS date'),
//                 DB::raw('COUNT(*) AS count')
//             )
//             ->groupBy('date')
//             ->get();

//         // Process the data and extract necessary information for the chart
//         $labels = $bookings->pluck('date')->toArray();
//         $bookingCounts = $bookings->pluck('count')->toArray();

//         // Return the processed data to the view
//         return view('graph.bookings', compact('labels', 'bookingCounts'));
//     }
    
//     public function carGraph()
//     {
//         // Get the labels and car counts for the graph
//         $labels = $this->getLabels();
//         $carCounts = $this->getCarCounts();

//         return view('graph.cars', compact('labels', 'carCounts'));
//     }

//     private function getLabels()
//     {
//         // Logic to generate the labels for the x-axis of the graph
//         // Return an array of labels (e.g., ['Label 1', 'Label 2', ...])
//     }

//     private function getCarCounts()
//     {
//         // Logic to retrieve the car counts for the y-axis of the graph
//         // Return an array of car counts (e.g., [10, 20, ...])
//     }
//     public function customerGraph()
// {
//     // Get the labels and customer counts for the graph
//     $labels = $this->getLabels();
//     $customerCounts = $this->getCustomerCounts();

//     return view('graph.customers', compact('labels', 'customerCounts'));
// }


// private function getCustomerCounts()
// {
//     // Logic to retrieve the customer counts for the y-axis of the graph
//     // Return an array of customer counts (e.g., [10, 20, ...])
// }
public function graph()
    {
        // Get the labels for the x-axis (dates)
        $labels = $this->getLabels();

        // Get the counts for customers, car owners, cars, and bookings
        $customerCounts = $this->getUserTypeCounts('customer');
        $carOwnerCounts = $this->getUserTypeCounts('car_owner');
        $carCounts = $this->getCarCounts();
        $bookingCounts = $this->getBookingCounts();

        return view('graph.main', compact('labels', 'customerCounts', 'carOwnerCounts', 'carCounts', 'bookingCounts'));
    }

    private function getLabels()
    {
        // Generate an array of labels for the last 7 days
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = $date;
        }
        return $labels;
    }

    private function getUserTypeCounts($userType)
    {
        // Get the counts for a specific user type (customer or car owner) for the last 7 days
        $counts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = User::where('user_type', $userType)
                ->whereDate('created_at', $date)
                ->count();
            $counts[] = $count;
        }
        return $counts;
    }

    private function getCarCounts()
    {
        // Get the counts for listed cars for the last 7 days
        $counts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = Car::whereDate('created_at', $date)
                ->count();
            $counts[] = $count;
        }
        return $counts;
    }

    private function getBookingCounts()
    {
        // Get the counts for bookings for the last 7 days
        $counts = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $count = Booking::whereDate('created_at', $date)
                ->count();
            $counts[] = $count;
        }
        return $counts;
    }
}


