@include('components.header')
@section('content')
@vite(['resources/js/carfilter.js'])
<div class="flex">
    <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C; min-height: 100vh;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center {{ Request::is('cars/details') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;">
                <i class="fa-solid fa-car mr-2"></i>
                <a href="/cars/details" class="{{ Request::is('cars/details') ? 'text-white' : 'text-gray-300' }}">Cars</a>
            </li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details"> Car Owners</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i><a href="/reservation/details">Bookings</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
            {{-- <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/graph/details">Sales</a></li> --}}
          </ul>
        </div>
    </div>
    <div  class="w-full" style="background-color: #E5E7EB;">
        <div class="flex justify-between items-center py-4 px-6">
            <!-- Filter Options -->
            <div>
                <select id="filterOption" class="bg-white border border-gray-300 rounded px-3 py-2">
                    <option value="all">All</option>
                    <option value="rented">Available</option>
                    <option value="not_returned">Not Returned</option>
                </select>
            </div>
        
            <!-- Search Button -->
            <div>
                <div class="flex">
                    <input type="text" id="searchInput" placeholder="Search..." class="bg-white border border-gray-300 rounded-l px-3 py-2 outline-none">
                    <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r">
                        Search
                    </button>
                </div>
            </div>
        </div>
    <table class="table mt-4 pt-4">
        <thead id="carsHeader">
            <tr>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">ID</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Brand</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Model</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Year</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Price</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Owner</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Rented Count</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Status</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500"></th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500"></th>


            </tr>
        </thead>
        <tbody id="carsContainer">
            @foreach ($cars as $index => $car)
                <tr>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $car->id }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $car->car_brand }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $car->car_model }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $car->year }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $car->rental_fee }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $carOwnersWithCars[$index]->first_name. ' ' .$carOwnersWithCars[$index]->last_name }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500"> 
                        <button type="button" class="btn btn-link text-primary text-center" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $car->id }}">
                            {{ $car->bookings->count() }}
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="bookingModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel{{ $car->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookingModalLabel{{ $car->id }}">History</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($car->bookings as $loopIndex => $booking)
                                        <p><strong>{{ $loopIndex + 1 }}</strong></p>
                                            <p><strong>Customer:  </strong>{{$booking->customer->first_name}} {{$booking->customer->last_name}}<br></p>
                                            
                                            <p><strong>Pick-up Date:  </strong>{{$booking->pickup_date_time}}<br></p>  
                                            <p><strong>Return Date:  </strong>{{$booking->return_date_time}}<br></p> 
                                            <p><strong>Returned:  </strong>{{$booking->returned_at}}<hr><br><br></p>
                                            @if (!$loop->last)
                                            <hr>
                                            @endif
                                                

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div></td>

                    <td class="py-2 px-6 border-b border-dashed border-gray-500"> {{ $car->status }} </td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">
                        <a href="/car/{{$car->id}}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-1 rounded">
                            Edit
                        </a></td>
                    <td class="border-b border-dashed border-gray-500"><form action="/car/{{$car->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="bg-gray-900 hover:bg-red-800 text-white py-1 px-4 rounded shadow-lg hover:shadow-xl transition duration-duration-200" type="submit">Delete</button>
                        </form></td>
                </tr>
               
            @endforeach
        </tbody>
    </table>
    <div class="pagination mx-64 max-w-lg pt-6 p-4 ">
        {{-- {{ $cars->appends(request()->except('page'))->links('pagination::bootstrap-5') }} --}}
    </div>
</div>
</div>
@include('components.footer')