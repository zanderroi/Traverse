<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class GraphController extends Controller
{
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


