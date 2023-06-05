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
<body class="pt-5 bg-cover bg-no-repeat bg-center" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}'); min-height: 100vh;">
    <div class="bg-cover bg-black bg-opacity-75 backdrop-blur-lg w-screen" style="min-height: 100vh;">
        <x-navcarowner :bookedCarsCount="$bookedCarsCount" :latestProfilePicture="$latestProfilePicture" />
 
        <div class="pt-5">
                @if ($bookedCars->isEmpty())
                <div class="mx-auto mt-5 p-4 flex justify-center items-center w-1/2 ml-3 bg-gray-200">
                  <h1 class="text-2xl font-semibold">Your rented cars will display here!</h1> 
                  <div>
              
              @else
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
                        <a href="{{ url('traverse-chats/' . $latestBooking->user->id) }}" target="_blank" class="font-medium text-blue-700 hover:underline" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Message {{ $customerName }}</a><br>
                        {{-- <a href="#" class="font-medium text-blue-700 hover:underline">Confirm Return</a> --}}
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        
        
    </div>
</body>
</html>