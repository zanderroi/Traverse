<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        .section-heading {
            font-size: 18px;
            font-weight: bold;
        }

        .customer-details {
            margin-bottom: 40px;
        }

        .car-details {
            margin-bottom: 40px;
        }

        .booking-details {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <h1>Booking Receipt</h1>

    <div class="customer-details">
        <h2 class="section-heading">Customer Details</h2>
        <ul>
            <li><strong>Name:</strong> {{ $booking->user->first_name }} {{ $booking->user->last_name }}</li>
            <li><strong>Email:</strong> {{ $booking->user->email }}</li>
        </ul>
    </div>

    <div class="car-details">
        <h2 class="section-heading">Car Owner Details</h2>
        <ul>
            <li><strong>Name:</strong> {{ $booking->car->owner->first_name }} {{ $booking->car->owner->last_name }}</li>
            <li><strong>Email:</strong> {{ $booking->car->owner->email }}</li>
            <li><strong>Phone Number:</strong> {{ $booking->car->owner->phone_number }}</li>
        </ul>
    </div>

    <div class="car-details">
        <h2 class="section-heading">Car Details</h2>
        <ul>
            <li><strong>Brand:</strong> {{ $booking->car->car_brand }}</li>
            <li><strong>Model:</strong> {{ $booking->car->car_model }}</li>
            <li><strong>Year:</strong> {{ $booking->car->year }}</li>
            <li><strong>Seats:</strong> {{ $booking->car->seats }}</li>
            <li><strong>License Plate:</strong> {{ $booking->car->plate_number }}</li>
        </ul>
    </div>

    <div class="booking-details">
        <h2 class="section-heading">Booking Details</h2>
        <ul>
            <li><strong>Pickup Date/Time:</strong> {{ $booking->pickup_date_time }}</li>
            <li><strong>Return Date/Time:</strong> {{ $booking->return_date_time }}</li>
            <li><strong>Note:</strong> {{ $booking->notes }}</li>
            <li><strong>Total Rental Fee:</strong> Php {{ $booking->total_rental_fee }}</li>
        </ul>
    </div>

</body>
</html>
