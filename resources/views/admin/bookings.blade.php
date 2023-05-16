@include('components.header')
@section('content')
    <h1 class="pt-4 pb-2">All Bookings</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Customer</th>
                <th scope="col" class="py-3 px-6">Auto Details</th>
                <th scope="col" class="py-3 px-6">Pick Up Date</th>
                <th scope="col" class="py-3 px-6">Returned Date</th>
                <th scope="col" class="py-3 px-6 text-center">Booking Status</th>
                <th scope="col" class="py-3 px-6">Total Rental Fee</th>
                <th scope="col" class="py-3 px-6">Extension Fee</th>
                <th scope="col" class="py-3 px-6">Notes</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $index => $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $bookingClient[$index]->first_name. ' ' .$bookingClient[$index]->last_name }}</td>  
                    <td>  Type of Car: {{ $booking->car->car_brand }} {{ $booking->car->car_model }} ({{ $booking->car->year }})<br>   
                        Owner: {{ $booking->car->owner->first_name. ' ' .$booking->car->owner->last_name  }}<br></td>
                    <td>{{ $booking->pickup_date_time }}</td>
                    <td>{{ $booking->return_date_time }}</td>
                    <td class='text-center'>
                    @if($booking->returned_at)
                        Returned<br>
                        {{ \Carbon\Carbon::parse($booking->returned_at)->format('Y-m-d') }}
                    @else
                        Pending
                    @endif</td>
                    <td>{{ number_format($booking->total_rental_fee, 2, '.', ',') }}</td>
                    <td>{{ number_format($booking->late_fee, 2, '.', ',') }}</td>  
                    <td>{{ $booking->notes }}</td>  
                </tr>
               
            @endforeach
        </tbody>
    </table>
@include('components.footer')