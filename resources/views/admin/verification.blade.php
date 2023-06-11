@include('components.header')
@section('content')


<div class="flex">
    <div class="sidebar text-white pt-8" style="background-color: #0C0C0C; min-height:100vh; width: 400px;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/owners/details"> Account Verification</a></li>
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
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Birthday
                </th>
                <th scope="col" class="px-6 py-3">
                    Governtment ID Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Governtment ID Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Drivers License ID Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Drivers License ID Photo
                </th>
                <th scope="col" class="px-6 py-3">
                    Selfie Photo
                </th>
                <th scope="col" class="px-6 py-3">
                    Contact Persons
                </th>
                <th scope="col" class="px-6 py-3">
                    User Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Account Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Joined Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                @foreach($deactivatedUsers as $user)
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->first_name }} {{ $user->last_name }}
                </th>
                <td class="px-6 py-2">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-2">
                    {{ $user->phone_number }}
                </td>
                <td class="px-6 py-2">
                    {{ $user->birthday }}
                </td>
                <td class="px-6 py-2">
                    {{ $user->govtid }}
                </td>
                <td class="px-6 py-2">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$user->govtid_image) }}">
                </td>
                <td class="px-6 py-2">
                    {{ $user->driverslicense }}
                </td>
                <td class="px-6 py-2">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$user->driverslicense_image) }}"> <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$user->driverslicense2_image) }}">
                </td>
                <td class="px-6 py-2">
                    <img class="rounded-full w-8 h-8" src="{{ asset('storage/'.$user->selfie_image) }}">
                </td>
                <td class="px-6 py-2">
                <button type="button" class="text-xs btn btn-primary bg-gray-700 hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#contactPersonsModal{{ $user->id }}">
                    Contact Persons
                </button>
            </td>
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
                </div>
                <td class="px-6 py-2">
                    {{$user->user_type}}
                </td>
                <td class="px-6 py-2">
                    {{$user->account_status}}
                </td>
                <td class="px-6 py-2">
                    {{$user->created_at}}
                </td>
                <td class="flex items-center px-6 py-2 space-x-3">
                    <a href="{{ route('admin.approveUser', ['userId' => $user->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Approve</a>
                    <a href="{{ route('admin.declineUser', ['userId' => $user->id]) }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Decline</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $deactivatedUsers->links() }}
</div>

{{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Birthday
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Governtment ID Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Governtment ID Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Drivers License ID Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Drivers License ID Photo
                </th>
                <th scope="col" class="px-6 py-3">
                    Selfie Photo
                </th>
                <th scope="col" class="px-6 py-3">
                    Contact Persons
                </th>
                <th scope="col" class="px-6 py-3">
                    User Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Account Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Joined Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4">
                    Silver
                </td>
                <td class="px-6 py-4">
                    Laptop
                </td>
                <td class="px-6 py-4">
                    $2999
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Microsoft Surface Pro
                </th>
                <td class="px-6 py-4">
                    White
                </td>
                <td class="px-6 py-4">
                    Laptop PC
                </td>
                <td class="px-6 py-4">
                    $1999
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Magic Mouse 2
                </th>
                <td class="px-6 py-4">
                    Black
                </td>
                <td class="px-6 py-4">
                    Accessories
                </td>
                <td class="px-6 py-4">
                    $99
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div> --}}
</div>
