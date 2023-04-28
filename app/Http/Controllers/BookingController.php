<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\CarImage;

class BookingController extends Controller
{
    public function createBooking(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        return view('bookings.create', compact('car'));
    }
    
    //Booking details
    public function showBookingDetails($booking_id)
{
    // Retrieve the booking based on the ID
    $booking = Booking::findOrFail($booking_id);

    // Calculate the total rental fee based on the number of days rented
    $daysRented = $booking->check_out_date->diffInDays($booking->check_in_date);
    $totalRentalFee = $booking->car->rental_fee * $daysRented;

    // Load the view and pass the booking and total rental fee
    return view('bookings.show', compact('booking', 'totalRentalFee'));
}

//Booking process
public function store(Request $request, $car_id)
{
    $booking = new Booking;

    // set booking properties from request
    $booking->user_id = Auth::user()->id;
    $booking->car_id = $car_id;
    $booking->pickup_location = $request->input('pickup_location');
    $booking->return_location = $request->input('return_location');
    $booking->pickup_date_time = $request->input('pickup_date_time');
    $booking->return_date_time = $request->input('return_date_time');
    $booking->note = $request->input('note');

    // calculate rental fee and late fee
    $car = Car::findOrFail($car_id);
    $pickup_date_time = Carbon::parse($booking->pickup_date_time);
    $return_date_time = Carbon::parse($booking->return_date_time);
    $num_hours_rented = $return_date_time->diffInHours($pickup_date_time);
    $total_rental_fee = $car->rental_fee * $num_hours_rented;
    $late_fee_per_hour = 500;
    $late_fee = max(0, $return_date_time->diffInMinutes($booking->car->rental_due_time) / 60) * $late_fee_per_hour;
    $booking->total_rental_fee = $total_rental_fee;
    $booking->late_fee = $late_fee;

    $booking->save();

    // update car status to booked
    $car->status = 'booked';
    $car->save();

    return redirect()->route('customer.dashboard')->with('success', 'Booking created successfully');
}


}
