<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse - Customer</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/icon.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Scripts -->
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <style>
      body {
          overflow-x: hidden;
      }
  </style>
</head>
<body class="pt-5 bg-gradient-to-r from-cyan-500 to-blue-500">

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand flex items-center" href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}">
                    <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Traverse</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                      <li>
                        <a href="{{ route('customer.garage') }}" class="mr-5 block py-2 pl-3 pr-4 text-black rounded md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Garage</a>
                      </li>
                      <li>
                        <a href="{{ route('customer.history') }}" class="mr-5 block py-2 pl-3 pr-4 text-black rounded md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">History</a>
                      </li>
                            <li>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>   
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

    @if ($bookings->isEmpty())
    <div class="h-56 grid grid-cols-3 gap-4 content-center bg-slate-100">
    <p class="mt-3"style="font-size:2vw">Your car bookings will display here!</p> 
    <div>
@else
        <div class="mt-6 pt-5  mx-auto " >
            <table class="text-sm text-left text-blue-100 dark:text-blue-100 mx-auto shadow-md sm:rounded-lg max-w-full xs:max-w-none sm:max-w-xs md:max-w-sm  lg:max-w-md xl:max-w-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Car Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Car Owner
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Total Rental Fee
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-12 py-3">
                            Pickup Date and Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Return Date and Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                         </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($bookings as $booking)
                    <tr class="bg-gray-300 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-blue-100">
                            {{ $booking->car->car_brand }} - {{ $booking->car->car_model }}
                        </th>
                        <td class="px-1 py-4 text-gray-800">
                            {{ $booking->car->owner->first_name }} {{ $booking->car->owner->last_name }}
                        </td>
                        <td class="px-1 py-4 text-gray-800">
                            Php {{ $booking->total_rental_fee }}
                        </td>
                        <td class="px-6 py-4 text-gray-800">
                            {{ $booking->user->booking_status }}
                        </td>
                        <td class="pl-1 py-4 text-gray-800">
                            {{ date('F d, Y h:i A', strtotime($booking->pickup_date_time)) }}
                        </td>
                        <td class="px-6 py-4 text-gray-800">
                            {{ date('F d, Y h:i A', strtotime($booking->return_date_time)) }}
                        </td>
                        <td class="px-2 py-4">
                            <a href="#" class="font-medium text-blue-700 hover:underline" ddata-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Return Car</a><br>
                            <a href="#" class="font-medium text-blue-700 hover:underline">Extend</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Main Modal --}}


          
          <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                      <div class="p-6 text-center">
                          <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Return the car now?</h3>
                          <button data-modal-hide="popup-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <a href="{{ route('returncar', ['booking_id' => $booking->id]) }}"> Return now </a>
                          </button>
                          <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                      </div>
                  </div>
              </div>
          </div>
          
          @endif
        
    

</body>
</html>