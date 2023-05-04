<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Auth;
use DateTime;



class BookingController extends Controller
{

    //Booking process
    public function store(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'pickup_date_time' => 'required|date',
            'return_date_time' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);
    
        $booking = new Booking;
        $booking->car_id = $car->id;
        $booking->user_id = Auth::id();
        $booking->pickup_date_time = $validatedData['pickup_date_time'];
        $booking->return_date_time = $validatedData['return_date_time'];
        $booking->note = $validatedData['note'];
        $booking->save();
    
        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }
    

    public function confirm(Request $request)
    {
        $request->validate([
            'pickup_date_time' => 'required|date|after_or_equal:today',
            'return_date_time' => 'required|date|after_or_equal:pickup_date_time',
            'notes' => 'nullable|string|max:255',
        ]);
    
        $user_id = Auth::id();
        $user = Auth::user();
        $car_id = $request->input('car_id');
    
        $pickup_date_time = $request->input('pickup_date_time');
        $return_date_time = $request->input('return_date_time');
        $notes = $request->input('notes');
        $car = Car::with('owner')->findOrFail($car_id);
    
        if (!$car) {
            // The car with the given $car_id was not found
            return redirect()->back()->with('error', 'Car not found.');
        }
    
        $rental_fee = $car->rental_fee;
        $car_owner_name = $car->owner ? $car->owner->name : 'Unknown';
        $car_owner_email = $car->owner ? $car->owner->email : 'Unknown';
        $car_owner_phone_number = $car->owner ? $car->owner->phone_number : 'Unknown';
    
        $pickup_date = new DateTime($pickup_date_time);
        $return_date = new DateTime($return_date_time);
        $duration = $pickup_date->diff($return_date)->days;
    
        $total_rental_fee = $duration * $rental_fee;
    
        $booking = Booking::create([
            'user_id' => $user_id,
            'car_id' => $car_id,
            'pickup_date_time' => $pickup_date_time,
            'return_date_time' => $return_date_time,
            'notes' => $notes,
            'total_rental_fee' => $total_rental_fee,
        ]);
    
        $user->booking_status = 'Pending';
        $user->save();
    
        $car->status = 'booked';
        $car->save();
    return view('bookings.confirm', compact('booking', 'user', 'car', 'car_owner_name', 'total_rental_fee', 'car_owner_email', 'car_owner_phone_number'));
}


    public function download(Booking $booking)
    {
        $pdf = PDF::loadView('bookings.receipt', [
            'booking' => $booking,
            'car_owner' => $booking->car->user,
            'customer' => $booking->user,
        ]);
        return $pdf->download('booking_receipt.pdf');
    }

    
    public function cancel($id)
{
    $booking = Booking::findOrFail($id);
    $car = $booking->car;
    $car->status = 'Available';
    $car->save();
    $booking->delete();
    $user = Auth::user();
    $user->booking_status = 'Available';
    $user->save();
    return redirect()->route('customer.dashboard')->with('success', 'Booking cancelled successfully.');
}


}
