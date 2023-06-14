@include('components.header')
@section('content')
<div class="flex">
    <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C; min-height: 100vh;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-car-side mr-2"></i><a href="/admin/carapproval"> Car Verification</a></li>
            <li class="flex items-center ml-4"><i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
            <li class="flex items-center {{ Request::is('owners/details') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;">
                 <i class="fa-solid fa-user-group mr-2"></i>
                 <a href="/owners/details" class="{{ Request::is('owners/details') ? 'text-white' : 'text-gray-300' }}">Car Owners</a>
            </li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i><a href="/reservation/details">Bookings</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/admin/sales">Sales</a></li>
          </ul>
        </div>
    </div>
    <div class="w-full" style="background-color: #E5E7EB;">
        <div class="flex justify-between mb-4 pt-2"> 
            <form action="/owners/details" method="GET">
                <div class="flex items-center ml-4">
                    <select name="filter" class="bg-white border border-gray-300 rounded px-3 py-2 outline-none">
                        <option value="">All Owners</option>
                        <option value="bookings" {{ Request::input('filter') === 'bookings' ? 'selected' : '' }}>With Bookings</option>
                        <option value="no_bookings" {{ Request::input('filter') === 'no_bookings' ? 'selected' : '' }}>Without Bookings</option>
                    </select>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r-md">Filter</button>
                </div>
            </form>
            <form action="/owners/details" method="GET">
                <div class="flex items-center">
                    <input type="text" name="search" placeholder="Search" class="bg-white border border-gray-300 rounded-l px-3 py-2 outline-none">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r-md">Search</button>
                </div>
            </form>
        </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">ID</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Name</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Email</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Address</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Contact Number</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Contact Persons</th>
                <th scope="col" class="py-3 px-6 text-center border-b border-dashed border-gray-500">Documents Provided</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Car Owned</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500">Account Status</th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500"> </th>
                <th scope="col" class="py-3 px-6 border-b border-dashed border-gray-500"> </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $user->id }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $user->first_name. ' ' .$user->last_name }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $user->email }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $user->address }}</td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">{{ $user->phone_number }}</td>
                 <td class="py-2 px-6 border-b border-dashed border-gray-500"><!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary bg-gray-700 hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#contactPersonsModal{{ $user->id }}">
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
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary bg-gray-700 hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#documentsModal{{ $user->id }}">
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
                                            <li>  @if ($user->govtid_image)
                                                <div>
                                                    <img src="{{ asset('storage/'.$user->govtid_image) }}" class="h-20">
                                                </div>
                                            @endif</li>
                                        <br/><br/>
                                            <li>Driver's License</li>
                                            <li>{{ $user->driverslicense }}</li>
                                            <li>  @if ($user->driverslicense_image)
                                                <div>
                                                    <img src="{{ asset('storage/'.$user->driverslicense_image) }}" class="h-20">
                                                </div>
                                            @endif</li>
                                            <br/><br/>
                                            <li>Driver's License Back</li>
                                            <li>{{ $user->driverslicense }}</li>
                                            <li>  @if ($user->driverslicense2_image)
                                                <div>
                                                    <img src="{{ asset('storage/'.$user->driverslicense2_image) }}" class="h-40 w-auto">
                                                </div>
                                            @endif</li>
                                            <br/><br/>
                                            <li>Selfie</li>
                                            <li>{{ $user->first_name. ' ' .$user->last_name }}</li>
                                            <li>  @if ($user->selfie_image)
                                                <div>
                                                    <img src="{{ asset('storage/'.$user->selfie_image) }}" class="h-40 w-auto">
                                                </div>
                                            @endif</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary bg-gray-600" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td class="py-2 px-6 border-b border-dashed border-gray-500">
                     <!-- Button trigger modal -->
                    <td class="py-2 px-6 border-b border-dashed border-gray-500"><button type="button" class="btn btn-primary  bg-gray-700 hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#carModal{{ $user->id }}">
                            View Cars
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="carModal{{ $user->id }}" tabindex="-1" aria-labelledby="carModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="carModalLabel{{ $user->id }}">Car/s Owned</h5>
                                        <button type="button" class="btn-close bg-red-800 text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($carsWithOwners as $car)
                                            @if ($car->car_owner_id == $user->id)
                                            <li>{{ $car->car_brand }} {{ $car->car_model }} {{ $car->year }}<br/><br/></li>
                                             @endif
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
                    <td class='mx-auto py-2 px-6 border-b border-dashed border-gray-500'>
                        {{ $user->account_status }}
                    </td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500">
                        <a href="/owner/{{$user->id}}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-1 rounded">
                            Edit
                        </a></td>
                    <td class="py-2 px-6 border-b border-dashed border-gray-500"><form action="/owner/{{$user->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="bg-gray-900 hover:bg-red-800 text-white py-1 px-4 rounded shadow-lg hover:shadow-xl transition duration-duration-200" type="submit">Delete</button>
                    </form></td> 

                </tr>
               
            @endforeach
        </tbody>
    </table>
    <div class="pagination mx-64 max-w-lg pt-6 p-4 ">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
</div>
@include('components.footer')