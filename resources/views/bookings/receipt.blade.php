<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Receipt</title>
    <style>
    
    </style>
</head>
<body>
    <h1>Booking Receipt</h1>
    <h2>Customer Details</h2>
    <ul>
        <li>Name: {{ $booking->user->first_name }} {{ $booking->user->last_name }} </li>
        <li>Email: {{ $booking->user->email }}</li>
    </ul>
    <h2>Car Owner Details</h2>
    <ul>
        <li>Name: {{ $booking->car->owner->first_name }} {{ $booking->car->owner->last_name }}</li>
        <li>Email: {{ $booking->car->owner->email }}</li>
        <li>Phone Number: {{ $booking->car->owner->phone_number }}</li>
    </ul>
    <h2>Car Details</h2>
    <ul>
        <li>Brand: {{ $booking->car->car_brand }}</li>
        <li>Model: {{ $booking->car->car_model }}</li>
        <li>Year: {{ $booking->car->year }}</li>
        <li>Seats: {{ $booking->car->seats }}</li>
        <li>License Plate: {{ $booking->car->plate_number }}</li>
    </ul>
    <h2>Booking Details</h2>
    <ul>
        <li>Pickup Date/Time: {{ $booking->pickup_date_time }}</li>
        <li>Return Date/Time: {{ $booking->return_date_time }}</li>
        <li>Note: {{ $booking->notes }}</li>
        <li>Total Rental Fee: Php {{ $booking->total_rental_fee }}</li>
    </ul>
    {{-- <button onclick="window.print()">Print Receipt</button> --}}
</body>
</html>
