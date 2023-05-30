<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">

    <title>Traverse</title>
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />


           
    <style>
        body {
            overflow-x: hidden;
        }
        .hover-scale:hover {
            transform: scale(1.03);
            transition: all 0.2s ease-in-out;
        }
        /* Your custom CSS styles go here */
        .offcanvas-collapse {
            position: fixed;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            overflow-y: auto;
            visibility: hidden;
            z-index: 9999;
            transition: visibility 0s linear 0.3s;
        }
        .offcanvas-collapse.open {
            visibility: visible;
            transition: visibility 0s linear 0s;
        }
    </style>
</head>
<body class="pt-5 bg-cover bg-no-repeat bg-center min-h-screen" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}');">
    <div class="bg-cover bg-black bg-opacity-75 backdrop-blur-lg w-screen h-screen">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top border-bottom" style="background-color: #0C0C0C;">
            <div class="container">
                <a class="navbar-brand flex items-center" href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}">
                    <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
                    <span class="self-center text-xl text-white font-semibold whitespace-nowrap dark:text-white">Traverse</span>
                </a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> 


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                      <li>
                        <a href="{{route('car_owner.rentedcars')}}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Rented Cars</a>
                      </li>
                        <li>
                          <a href="{{ route('car_owner.earnings') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Earnings!</a>
                        </li>
                        <li>
                          <a href="{{ route('car_owner.car_details') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">List a Car</a>
                        </li>
                        <li>
                            <div class="sm:fixed sm:top-0 sm:right-0 text-right mr-2">

                                <a href="{{ route('traverse-chats') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Traverse Chats </a>
                        </div>
                    </li>
                              <li>
                                <div class="flex items-center">
                                    @if ($latestProfilePicture)
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' .$latestProfilePicture->profilepicture) }}" alt="Profile Picture">
                                @else
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
                                @endif
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle ml-2 text-blue-600 font-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                  </a>
                                
                                
  
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                      
                                    <a class="dropdown-item" href="{{ route('car_owner.profile') }}">
                                      Profile
                                  </a>
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>
  
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                          @csrf
                                      </form>
                                  </div>
                                </div>
                                
                              </li>
  
                      </ul>
            </div>
        </nav>
  
    
        <div class="pt-5">
            @foreach ($bookedCars as $car)
                <div class="mx-auto w-1/2 h-64 flex flex-row shadow-md" style="background-color: #121212;">
                    <div>
                        <img src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:380px; height:256px;"/>
                    </div>
                    <div class="mt-5 ml-4">
                        <h3 class="text-white text-lg font-bold">{{ $car->car_brand }} - {{ $car->car_model }}</h3>
                        @if ($car->bookings->count() > 0)
                            @php
                                $latestBooking = $car->bookings->last();
                                $customerName = $latestBooking->user->first_name . ' ' . $latestBooking->user->last_name;
                            @endphp
                            <p class="text-gray-400 text-md font-semi-bold">Customer Name: {{ $customerName }}</p>
                            <p class="text-gray-400 text-md font-semi-bold">Total Rental Fee: Php {{ number_format($latestBooking->total_rental_fee, 2) }}</p>
                            <p class="text-gray-400 text-md font-semi-bold">Pickup Date and Time: {{ date('F d, Y h:i A', strtotime($latestBooking->pickup_date_time)) }}</p>
                            <p class="text-gray-400 text-md font-semi-bold">Return Date and Time: {{ date('F d, Y h:i A', strtotime($latestBooking->return_date_time)) }}</p>
                        @else
                            <p class="text-gray-400 text-md font-semi-bold">No bookings found for this car.</p>
                        @endif
                        <a href="{{ url('traverse-chats/' . $latestBooking->user->id) }}" target="_blank" class="font-medium text-blue-700 hover:underline" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Message</a><br>
                        <a href="#" class="font-medium text-blue-700 hover:underline">Confirm Return</a>
                    </div>
                </div>
            @endforeach
        </div>
        
        
        
    </div>
</body>
</html>