@include('components.header')
@section('content')
<div class="flex">
    <div class="sidebar text-white w-48 pt-8 h-screen" style="background-color: #0C0C0C;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center">Dashboard</h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center ml-4"><i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
            <li class="flex items-center ml-4"><i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details">Car Owners</a></li>
            <li class="flex items-center ml-4"><i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center {{ Request::is('reservation/details') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;">
                 <i class="fa-solid fa-book mr-2"></i>
                 <a href="/reservation/details" class="{{ Request::is('reservation/details') ? 'text-white' : 'text-gray-300' }}">Bookings</a>
            </li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
            {{-- <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="#">Sales</a></li> --}}
          </ul>
        </div>
    </div>
    <div class="w-full" style="background-color: #E5E7EB;">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">ID</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Customer</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Auto Details</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Pick Up Date</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Returned Date</th>
                <th scope="col" class="py-3 px-6 text-center border-b border-dashed border-gray-500">Booking Status</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Total Rental Fee</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Notes</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $index => $booking)
                <tr>
                    <td class="border-b border-dashed border-gray-500">{{ $booking->id }}</td>
                    <td class="border-b border-dashed border-gray-500">{{ $bookingClient[$index]->first_name. ' ' .$bookingClient[$index]->last_name }}</td>  
                    <td class="border-b border-dashed border-gray-500">  Type of Car: {{ $booking->car->car_brand }} {{ $booking->car->car_model }} ({{ $booking->car->year }})<br>   
                        Owner: {{ $booking->car->owner->first_name. ' ' .$booking->car->owner->last_name  }}<br></td>
                    <td class="border-b border-dashed border-gray-500">{{ $booking->pickup_date_time }}</td>
                    <td class="border-b border-dashed border-gray-500">{{ $booking->return_date_time }}</td>
                    <td class='text-center border-b border-dashed border-gray-500'>
                    @if($booking->returned_at)
                        Returned<br>
                        {{ \Carbon\Carbon::parse($booking->returned_at)->format('Y-m-d') }}
                    @else
                        Pending
                    @endif</td>
                    <td class="border-b border-dashed border-gray-500">{{ number_format($booking->total_rental_fee, 2, '.', ',') }}</td> 
                    <td class="border-b border-dashed border-gray-500">{{ $booking->notes }}</td>  
                </tr>
               
            @endforeach
        </tbody>
    </table>
    <div class="pagination mx-64 max-w-lg pt-6 p-4 ">
        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
</div>
</div>
@include('components.footer')