@include('components.header')
@section('content')


<div class="flex">
    <div class="sidebar text-white pt-8" style="background-color: #0C0C0C; min-height:100vh; width: 400px;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center {{ Request::is('admin/verification') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;"> 
                <i class="fa-solid fa-user-shield mr-2"></i>
                <a href="/admin/verification" class="{{ Request::is('admin/verification') ? 'text-white' : 'text-gray-300' }}"> Account Verification</a>
            </li>
            <li class="flex items-center {{ Request::is('admin/carapproval') ? 'bg-indigo-600' : '' }} w-full" style="padding: 12px 16px; height: 48px;"> 
                <i class="fa-solid fa-car-side mr-2"></i>
                <a href="/admin/carapproval" class="{{ Request::is('admin/carapproval') ? 'text-white' : 'text-gray-300' }}"> Car Verification</a>
            </li>
            <li class="flex items-center ml-4"><i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details"> Car Owners</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i><a href="/reservation/details">Bookings</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
            {{-- <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/graph/details">Sales</a></li> --}}
          </ul>
        </div>
    </div>
    
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Car Owner
                </th>
                <th scope="col" class="px-6 py-3">
                    Car Brand and Model
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Year
                </th>
                <th scope="col" class="px-6 py-3">
                    Transmission
                </th>
                <th scope="col" class="px-6 py-3">
                    Seats
                </th>
                <th scope="col" class="px-6 py-3">
                    Plate Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Vehicle Identification Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
                <th scope="col" class="px-6 py-3">
                    ORCR
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Rental Fee
                </th>
                <th scope="col" class="px-6 py-3">
                    Pictures
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Listed Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                @foreach($pendingCars as $car)
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $car->owner->first_name }} {{ $car->owner->last_name }}
                </th>
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $car->car_brand }} {{ $car->car_model }}
                </th>
                <td class="px-6 py-2">
                    {{ $car->car_type }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->year }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->transmission }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->seats }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->plate_number }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->vehicle_identification_number }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->location }}
                </td>
                <td class="px-6 py-2">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$car->certificate_of_registration) }}">
                </td>
                <td class="px-6 py-2">
                    {{ $car->car_description }}
                </td>
                <td class="px-6 py-2">
                    Php {{ $car->rental_fee }}
                </td>
                <td class="px-6 py-2">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$car->add_picture1) }}">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$car->add_picture2) }}">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$car->add_picture3) }}">
                </td>
                <td class="px-6 py-2">
                    {{ $car->status }}
                </td>
                <td class="px-6 py-2">
                    {{ $car->created_at }}
                </td>
                <td class="flex items-center px-6 py-2 space-x-3">
                    <a href="{{ route('admin.car.approve', ['carId' => $car->id, 'ownerId' => $car->car_owner_id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Approve</a>
                    <a href="{{ route('admin.car.decline', ['carId' => $car->id, 'ownerId' => $car->car_owner_id]) }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Decline</a>
                </td>
                
                
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pendingCars->links() }}
</div>
