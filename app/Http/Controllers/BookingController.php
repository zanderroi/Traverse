<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function createBooking(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        return view('bookings.create', compact('car'));
    }
    

    //Booking process
    public function store(Request $request, $car_id)
    {
        $validatedData = $request->validate([
            'pickup_date_time' => 'required|date',
            'return_date_time' => 'required|date|after:pickup_date_time',
        ]);

        $user_id = Auth::id(); // retrieve user_id from authenticated user

        $car = Car::findOrFail($car_id);

        // calculate total rental fee and late fee
        $daysRented = strtotime($validatedData['return_date_time']) - strtotime($validatedData['pickup_date_time']);
        $daysRented = round($daysRented / (60 * 60 * 24));
        $totalRentalFee = $car->rental_fee * $daysRented;
        $late_fee = 0;

        $booking = new Booking([
            'pickup_date_time' => $validatedData['pickup_date_time'],
            'return_date_time' => $validatedData['return_date_time'],
            'total_rental_fee' => $totalRentalFee,
            'late_fee' => $late_fee,
            'notes' => $request->input('notes') ?? '',
        ]);

        $booking->car()->associate($car);
        $booking->user_id = $user_id; // associate the booking with the user

        $booking->save();
        $car->status = 'booked';
        $car->save();
        $bookingDetails = [
           'car' => $car,
           'booking' => $booking
          ];        
                return view('bookings.create', compact('bookingDetails'));
    }


}
