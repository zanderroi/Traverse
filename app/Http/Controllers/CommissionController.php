<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Car;

class CommissionController extends Controller
{
    public function saveReceipt(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'receipt_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Get the booking ID from the request
        $bookingId = $validatedData['booking_id'];

        // Store the receipt image in the storage
        $receiptPath = $request->file('receipt_image')->store('receipts');

        // Save the commission data to the commission table
        // Replace this with your actual code to save the commission data
        $commission = new Commission();
        $commission->booking_id = $bookingId;
        $commission->car_owner_id = auth()->user()->id;
        $commission->total_rental_fee = $returnedCars->where('id', $bookingId)->first()->total_rental_fee;
        $commission->commission = $returnedCars->where('id', $bookingId)->first()->getCommissionAmount();
        $commission->receipt_path = $receiptPath;
        $commission->save();

        // Return a response or redirect to a success page
        return redirect()->route('car_owner.earnings')->with('success', 'Receipt uploaded successfully.');
    }
}
