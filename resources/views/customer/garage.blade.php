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
   @vite(['resources/js/navbar.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>
    <style>
      body {
          overflow-x: hidden;
      }
      .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }
  </style>
</head>
<body class="pt-5 bg-cover bg-no-repeat bg-center min-h-screen" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}');">
    <div class="bg-cover bg-black bg-opacity-75 backdrop-blur-lg w-screen h-screen">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top" style="background-color: #0C0C0C;">
              <div class="container">
                <a class="navbar-brand flex items-center" href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}">
                  <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
                  <span class="self-center text-white text-xl font-semibold whitespace-nowrap dark:text-white">Traverse</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
                </button>
            
                <div id="navbarSupportedContent">
                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                    <li>
                      <a href="{{ route('customer.garage') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Garage</a>
                    </li>
                    <li>
                      <a href="{{ route('customer.history') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">History</a>
                    </li>
                    <li>
                      <div class="sm:fixed sm:top-0 sm:right-0 text-right mr-2">
                        <a href="{{ route('traverse-chats') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Traverse Chats</a>
                      </div>
                    </li>
                    <li>
                      <div class="flex items-center">
                        @if ($latestProfilePicture)
                        <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' .$latestProfilePicture->profilepicture) }}" alt="Profile Picture">
                    @else
                        <img class="w-8 h-8 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
                    @endif
                        <a id="navbarDropdown" class="py-2 dropdown-toggle ml-2 text-gray-300 hover:bg-blue-80 font-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->first_name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>
                          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
            
      
            
          </div>   
    @if(session('success'))
    <div class="alert alert-success pt-4">
        {{ session('success') }}
    </div>
@endif
@if(request()->query('success') == 1)
    <div class="alert alert-success pt-4">
        Booking confirmed successfully!
    </div>
@endif
<div class="p-2 sticky top-6 z-10" style="background-color: #0C0C0C;">
  <div class="flex justify-between items-center">
      <h1 class="text-3xl font-bold pl-7 ml-4 mt-6 pt-4 mb-3 mr-5 text-white">Booked Car</h1>
  </div>
</div>

<div class="pt-5">
  @if ($bookings->isEmpty())
  <div class="mx-auto mt-5 p-4 flex justify-center items-center w-1/2 ml-3 bg-gray-200">
    <h1 class="text-2xl font-semibold">Your car bookings will display here!</h1> 
    <div>

@else
@foreach ($bookings as $booking)
<div class="mx-auto mt-4 w-1/2 h-64 flex flex-row shadow-md " style="background-color: #121212;">
    <div>
        <img src="{{ asset('storage/'.$booking->car->display_picture) }}" alt="Car Image" style="width:380px; height:256px;"/>
    </div>
<div class="mt-5 ml-4">
    <h3 class="text-white text-lg font-bold">{{$booking->car->car_brand}} - {{$booking->car->car_model}}</h3>
    <p class="text-gray-400 text-md font-semi-bold">Car Owner: {{ $booking->car->owner->first_name }} {{ $booking->car->owner->last_name }}</p>
    <p class="text-gray-400 text-md font-semi-bold">Total Rental Fee: Php {{number_format ($booking->total_rental_fee, 2) }}</p>
    <p class="text-gray-400 text-md font-semi-bold">Pickup Date and Time: {{ date('F d, Y h:i A', strtotime($booking->pickup_date_time)) }}</p>
    <p class="text-gray-400 text-md font-semi-bold">Return Date and Time: {{ date('F d, Y h:i A', strtotime($booking->return_date_time)) }}</p>
    <a href="{{ route('bookings.receipt', ['booking' => $booking->id]) }}" class="font-medium text-blue-700 hover:underline">Download Receipt</a><br>
    <a href="#" class="font-medium text-blue-700 hover:underline" ddata-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Return Car</a><br>
    <form action="{{ route('bookings.extend', ['booking' => $booking->id]) }}" method="POST">
      @csrf

    @if ($booking->is_extended)
    <button type="submit" class="font-medium text-red-700" disabled>Already Extended</button>
@else
<a href="#" ddata-modal-target="popup-modal2" data-modal-toggle="popup-modal2" class="font-medium text-blue-700 hover:underline">Extend</a>
@endif
  </div>

</div>
@endforeach
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
                          <a href="{{ route('returncar', ['booking_id' => $booking->id]) }}">
                          <button data-modal-hide="popup-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Return now </button> </a>
                          
                          <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                      </div>
                  </div>
              </div>
              
          </div>

          <div id="popup-modal2" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal2">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Extend Booking for a day?</h3>
                   
                        <button data-modal-hide="popup-modal2" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                         Yes </button>
                        </form>
                        <button data-modal-hide="popup-modal2" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>
                </div>
            </div>
            
        </div>


          @endif
        </div>
</body>
</html>