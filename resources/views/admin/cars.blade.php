@include('components.header')
@section('content')
    <h1 class="pt-4 pb-2">All Cars</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Brand</th>
                <th scope="col" class="py-3 px-6">Model</th>
                <th scope="col" class="py-3 px-6">Year</th>
                <th scope="col" class="py-3 px-6">Price</th>
                <th scope="col" class="py-3 px-6">Owner</th>
                <th scope="col" class="py-3 px-6">Rented Count</th>
                <th scope="col" class="py-3 px-6">Status</th>
                <th scope="col" class="py-3 px-6"></th>
                <th scope="col" class="py-3 px-6"></th>


            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $index => $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->car_brand }}</td>
                    <td>{{ $car->car_model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ $car->rental_fee }}</td>
                    <td>{{ $carOwnersWithCars[$index]->first_name. ' ' .$carOwnersWithCars[$index]->last_name }}</td>
                    <td>
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
                                            <p><strong>Return Date:  </strong>{{$booking->return_date_time}}<hr><br><br></p> 
                                            @if (!$loop->last)
                                            <hr>
                                            @endif
                                                

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div></td>

                    <td> {{ $car->status }} </td>
                    <td class="py-2 px-6">
                        <a href="/car/{{$car->id}}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-1 rounded">
                            Edit
                        </a></td>
                    <td><form action="/car/{{$car->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white py-1 px-4 rounded shadow-lg hover:shadow-xl transition duration-duration-200" type="submit">Delete</button>
                        </form></td>
                </tr>
               
            @endforeach
        </tbody>
    </table>
@include('components.footer')