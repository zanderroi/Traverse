<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use PDF;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'customer']);
    }
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
        $latestProfilePicture = $user->profilepicture()->latest()->first();
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
    
        $car->status = 'booked';
        $car->save();

        // Store the necessary data in session to be retrieved after redirect
        $request->session()->flash('booking', $booking);
        $request->session()->flash('user', $user);
        $request->session()->flash('car', $car);
        $request->session()->flash('car_owner_first_name', $car_owner_first_name);
        $request->session()->flash('car_owner_last_name', $car_owner_last_name);
        $request->session()->flash('total_rental_fee', $total_rental_fee);
        $request->session()->flash('car_owner_email', $car_owner_email);
        $request->session()->flash('car_owner_phone_number', $car_owner_phone_number);

        // Redirect to a different route or URL
        return redirect()->route('booking.confirmation');
}

//Function to prevent double entry of booking
public function confirmation(Request $request)
{
    $user = Auth::user();
    $latestProfilePicture = $user->profilepicture()->latest()->first();
    // Retrieve the data stored in session
    $booking = $request->session()->get('booking');
    $user = $request->session()->get('user');
    $car = $request->session()->get('car');
    $car_owner_first_name = $request->session()->get('car_owner_first_name');
    $car_owner_last_name = $request->session()->get('car_owner_last_name');
    $total_rental_fee = $request->session()->get('total_rental_fee');
    $car_owner_email = $request->session()->get('car_owner_email');
    $car_owner_phone_number = $request->session()->get('car_owner_phone_number');

    // Clear the session data
    $request->session()->forget([
        'booking',
        'user',
        'car',
        'car_owner_first_name',
        'car_owner_last_name',
        'total_rental_fee',
        'car_owner_email',
        'car_owner_phone_number',
    ]);
    // Debug statements
    // dd($user); // Check the value of $user object
 // Check if the user object is null
 if ($user === null) {
    // Redirect to an error page or handle the error in an appropriate way
    return redirect()->back()->with('error', 'User not found.');
}
    // Check if the objects are not null before accessing their properties
    $car_owner_first_name = $car_owner_first_name ?? 'Unknown';
    $car_owner_last_name = $car_owner_last_name ?? 'Unknown';
    $car_owner_email = $car_owner_email ?? 'Unknown';
    $car_owner_phone_number = $car_owner_phone_number ?? 'Unknown';
    return view('bookings.confirm', compact('booking', 'user', 'car', 'car_owner_first_name', 'car_owner_last_name', 'total_rental_fee', 'car_owner_email', 'car_owner_phone_number','latestProfilePicture'));
}

public function download(Booking $booking)
{
    $pdf = PDF::loadView('bookings.receipt', [
        'booking' => $booking,
        'car_owner' => $booking->car->user,
        'customer' => $booking->user,
    ]);
    
    $fileName = 'booking_receipt.pdf';
    
    // Download the PDF file
    return $pdf->download($fileName)
                ->withHeaders([
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
                ]);

    // Set the success message and redirect to the dashboard
    return redirect()->route('customer.dashboard')->with('success', 'Receipt downloaded successfully!');
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

public function extend(Request $request, Booking $booking)
{
    if ($booking->is_extended) {
        return redirect()->route('bookings.index')->with('error', 'You have already extended this booking.');
    }

    $booking->return_date_time = Carbon::parse($booking->return_date_time)->addDay();
    $booking->total_rental_fee += $booking->car->rental_fee; // Add one day rental fee
    $booking->is_extended = true;
    $booking->save();

    return redirect()->route('customer.garage')->with('success', 'Booking extended successfully.');
}





}
