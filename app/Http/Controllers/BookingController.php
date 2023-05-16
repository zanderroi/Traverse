<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;


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
        'return_date_time' => 'required|date|after_or_equal:pickup_date_time|before_or_equal:' . date('Y-m-d H:i:s', strtotime('+3 days', strtotime($request->input('pickup_date_time')))),
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
    $car_owner_first_name = $car->owner ? $car->owner->first_name : 'Unknown';
    $car_owner_last_name = $car->owner ? $car->owner->last_name : 'Unknown';
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

    // Update car status based on booking dates
    $car->status = 'available';
    $car->save();

    $car_bookings = Booking::where('car_id', $car_id)->where('return_date_time', '>', $pickup_date_time)->orderBy('pickup_date_time')->get();

    foreach ($car_bookings as $car_booking) {
        if ($car_booking->pickup_date_time > $return_date_time) {
            break;
        }
        $car->status = 'booked';
        $car->save();
    }

    return view('bookings.confirm', compact('booking', 'user', 'car', 'car_owner_first_name', 'car_owner_last_name', 'total_rental_fee', 'car_owner_email', 'car_owner_phone_number'));
}

public function download(Booking $booking)
{
    $pdf = PDF::loadView('bookings.receipt', [
        'booking' => $booking,
        'car_owner' => $booking->car->user,
        'customer' => $booking->user,
    ]);
    
    $fileName = 'booking_receipt.pdf';
    

    // Save the PDF file to a temporary location
    $pdf->save(public_path('temp/'.$fileName));

    // Set the success message
    session()->flash('success', 'Receipt downloaded successfully!');

    // Redirect to the customer.dashboard route
    return redirect()->route('customer.dashboard');
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
    return redirect()->route('customer.dashboard')->with('cancelled', 'Booking cancelled successfully.');
}

public function returnCar(Request $request, $booking_id)
{
    $booking = Booking::find($booking_id);

    if (!$booking) {
        // If the booking is not found, return an error message or redirect to an error page
        return redirect()->back()->with('error', 'Booking not found');
    }

    // Update car status to "available"
    $booking->car->update(['status' => 'available']);

    // Update customer booking status to "Available"
    $booking->user->update(['booking_status' => 'Available']);

    // Save returned date to booking record
    $booking->returned_at = Carbon::now('Asia/Manila');
    $booking->save();

    return redirect()->route('customer.garage')->with('success', 'Car returned successfully!');
}

public function history()
{
    $user_id = Auth::user()->id;

    // Get bookings for the logged-in customer where the booking status is "Returned"
    $bookings = Booking::where('user_id', $user_id)
        ->whereNotNull('returned_at')
        ->with(['car' => function ($query) {
            $query->withTrashed();
        }])
        ->get();

    return view('customer.history', ['bookings' => $bookings]);
}




}
