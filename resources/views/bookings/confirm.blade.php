@include('components.customer_header')

<body class="bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}');">
    <div class="bg-black bg-opacity-50 backdrop-blur-lg fixed inset-0 flex items-center justify-center">

        <div class="bg-white p-6 rounded-lg">
            <h1 class="text-lg font-bold text-center">Booking Confirmation</h1>

            <p>Customer Name: {{ $user->first_name }} {{ $user->last_name }}</p>
            <p>Car Owner Name: {{ $car_owner_first_name }} {{ $car_owner_last_name }}</p>
            
            <h2>Car Details</h2>
            <p>Brand: {{ $car->car_brand }}</p>
            <p>Model: {{ $car->car_model }}</p>
            <p>Year: {{ $car->year }}</p>
            
            <h2>Booking Details</h2>
            <p>Pickup Date and Time: {{ $booking->pickup_date_time }}</p>
            <p>Return Date and Time: {{ $booking->return_date_time }}</p>
            <p>Notes: {{ $booking->notes }}</p>
            
            <h2>Total Rental Fee</h2>
            <p>Php {{ $total_rental_fee }}</p>
            
            <div class="mt-5">
                <a href="{{ route('bookings.receipt', ['booking' => $booking->id]) }}" class="btn btn-primary">Download Receipt</a>
            </div>
            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel Booking</button>
            </form>
        </div>
    </div>
</body>
