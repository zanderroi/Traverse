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
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    public function graph(Request $request)
{
    // Get the selected month and week from the request
    $selectedMonth = $request->input('month');
    $selectedWeek = $request->input('week');
    $year = date('Y');

    // Get the start and end dates for the selected month and week
    $weeks = [];
    $startMonth = $selectedMonth ?? 1;
    $endMonth = $selectedMonth ?? 12;

    for ($month = $startMonth; $month <= $endMonth; $month++) {
        $startWeek = ($month == $selectedMonth) ? 1 : 0;
        $endWeek = ($month == $selectedMonth) ? 5 : 4;

        for ($weekNumber = $startWeek; $weekNumber <= $endWeek; $weekNumber++) {
            $startDate = Carbon::parse("{$year}-{$month}-01")->startOfWeek(Carbon::SUNDAY);
            $weekStart = $startDate->copy()->addWeeks($weekNumber - 1);
            $weekEnd = $weekStart->copy()->endOfWeek(Carbon::SATURDAY);
            $weekLabel = $weekStart->format('F j') . ' - ' . $weekEnd->format('F j');
            $weeks[] = [
                'month' => $month,
                'week' => $weekNumber,
                'label' => $weekLabel
            ];
        }
    }

    // Fetch user registration data for each day of the week
    $weekData = [];

    if ($selectedWeek) {
        $startDate = Carbon::parse("{$year}-{$selectedMonth}-01")->startOfWeek(Carbon::SUNDAY);
        $weekStart = $startDate->copy()->addWeeks($selectedWeek - 1);
        $weekEnd = $weekStart->copy()->endOfWeek(Carbon::SATURDAY);

        for ($date = $weekStart; $date <= $weekEnd; $date->addDay()) {
            $day = $date->format('Y-m-d');
            $nextDay = $date->copy()->addDay(); // Get the next day
            $carOwnerCount = User::where('user_type', 'car_owner')
            ->whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $customerCount = User::where('user_type', 'customer')
            ->whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $bookingCount = Booking::whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $carCount = Car::whereBetween('created_at', [$day, $nextDay])
            ->count();
    
        $weekData[$day] = [
            'carOwnerCount' => $carOwnerCount,
            'customerCount' => $customerCount,
            'bookingCount' => $bookingCount,
            'carCount' => $carCount
        ];
        }
    }

    // Pass the selected month and week to the view
    $selectedMonth = $selectedMonth ?? Carbon::now()->format('m');
    $selectedWeek = $selectedWeek ?? Carbon::now()->weekOfMonth;
            // Get the labels for the x-axis (dates)
            $labels = $this->getLabels();

            // Get the counts for customers, car owners, cars, and bookings
            $customerCounts = $this->getUserTypeCounts('customer');
            $carOwnerCounts = $this->getUserTypeCounts('car_owner');
            $carCounts = $this->getCarCounts();
            $bookingCounts = $this->getBookingCounts();


            return view('graph.main', compact('weekData', 'labels', 'customerCounts', 'carOwnerCounts', 'carCounts', 'bookingCounts', 'selectedMonth', 'selectedWeek', 'weeks'));
        }
    

        private function getLabels()
        {
        // Generate an array of labels for the last 7 days (Sunday to Saturday)
        $labels = [];
        $startDay = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        for ($i = 0; $i < 7; $i++) {
            $date = $startDay->copy()->addDays($i)->format('Y-m-d');
            $labels[] = $date;
        }
        return $labels;
        }

        private function getUserTypeCounts($userType)
        {
            // Get the counts for a specific user type (customer or car owner) for the last 7 days
            $counts = [];
            $startDay = Carbon::now()->startOfWeek(Carbon::SUNDAY);
            $date = $startDay;
            while (count($counts) < 7) {
                $day = $date->format('Y-m-d');
                $count = User::where('user_type', $userType)
                    ->whereDate('created_at', $day)
                    ->count();
                $counts[] = $count;
                $date->addDay();
            }
            return $counts;
        }

        private function getCarCounts()
        {
            // Get the counts for listed cars for the last 7 days
            $counts = [];
            $startDay = Carbon::now()->startOfWeek(Carbon::SUNDAY);
            $date = $startDay;
            while (count($counts) < 7) {
                $day = $date->format('Y-m-d');
                $count = Car::whereDate('created_at', $date)
                    ->count();
                $counts[] = $count;
                $date->addDay();
            }
            return $counts;
        }

        private function getBookingCounts()
        {
            // Get the counts for bookings for the last 7 days
            $counts = [];
            $startDay = Carbon::now()->startOfWeek(Carbon::SUNDAY);
            $date = $startDay;
            while (count($counts) < 7) {
                $day = $date->format('Y-m-d');
                $count = Booking::whereDate('created_at', $date)
                    ->count();
                $counts[] = $count;
                $date->addDay();
            }
            return $counts;
        }

    }


