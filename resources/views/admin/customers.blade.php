@include('components.header')
@section('content')
    <h1 class="pt-4 pb-2">All Customers</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6">ID</th>
                <th scope="col" class="py-3 px-6">Name</th>
                <th scope="col" class="py-3 px-6">Email</th>
                <th scope="col" class="py-3 px-6">Address</th>
                <th scope="col" class="py-3 px-6">Contact Number</th>
                <th scope="col" class="py-3 px-6">Contact Persons</th>
                <th scope="col" class="py-3 px-6 text-center">Documents Provided</th>
                <th scope="col" class="py-3 px-6">Cars Rented</th>
                <th scope="col" class="py-3 px-6">Account Status</th>
                <th scope="col" class="py-3 px-6">Account Status</th>
                <th scope="col" class="py-3 px-6">Account Status</th>
                <th scope="col" class="py-3 px-6"> </th>
                <th scope="col" class="py-3 px-6"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name. ' ' .$user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone_number }}</td>
                 <td><!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary bg-blue-500" data-bs-toggle="modal" data-bs-target="#contactPersonsModal{{ $user->id }}">
                        View Contact Persons
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="contactPersonsModal{{ $user->id }}" tabindex="-1" aria-labelledby="contactPersonsModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="contactPersonsModal{{ $user->id }}">Contact Persons</h5>
                            <button type="button" class="btn-close bg-red-800 text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                            <ul>
                                <li>{{ $user->contactperson1 }} <span class="float-end">{{ $user->contactperson1number }}</span></li>
                                <li>{{ $user->contactperson2 }} <span class="float-end">{{ $user->contactperson2number }}</span></li>
                            </ul>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary bg-gray-600" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary bg-blue-500" data-bs-toggle="modal" data-bs-target="#documentsModal{{ $user->id }}">
                            View Documents
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="documentsModal{{ $user->id }}" tabindex="-1" aria-labelledby="documentsModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="documentsModalLabel{{ $user->id }}">Documents Provided</h5>
                                        <button type="button" class="btn-close bg-red-800 text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            <li>Government ID</li>
                                            <li>{{ $user->govtid }}</li>
                                        <br/><br/>
                                            <li>Driver's License</li>
                                            <li>{{ $user->driverslicense }}</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary bg-gray-600" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                     <!-- Button trigger modal -->
                    <td><button type="button" class="btn btn-primary bg-blue-500" data-bs-toggle="modal" data-bs-target="#carModal{{ $user->id }}">
                        {{ $user->bookings_count }}
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="carModal{{ $user->id }}" tabindex="-1" aria-labelledby="carModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="carModalLabel{{ $user->id }}">History</h5>
                                        <button type="button" class="btn-close bg-red-800 text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($user->bookings as $booking)
                                            <li>
                                            Date Pick Up: {{ $booking->pickup_date_time->format('Y-m-d') }}<br>
                                            Date Returned: {{ $booking->return_date_time->format('Y-m-d') }}<br>
                                            Type of Car: {{ $booking->car->car_brand }} {{ $booking->car->car_model }} ({{ $booking->car->year }})<br>   
                                            Owner: {{ $booking->car->owner->first_name. ' ' .$booking->car->owner->last_name  }}<br>
                                            <br>
                                            <hr>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary bg-gray-600" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='mx-auto'>
                        {{ $user->account_status }}
                    </td>
                    <td class="py-2 px-6">
                        <a href="/customers/{{$user->id}}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-1 rounded">
                            Edit
                        </a></td>
                    <td><form action="/customer/{{$user->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white py-1 px-4 rounded shadow-lg hover:shadow-xl transition duration-duration-200" type="submit">Delete</button>
                    </form></td> 

                </tr>
               
            @endforeach
        </tbody>
    </table>
@include('components.footer')