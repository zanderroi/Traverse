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
<body class="pt-5 bg-cover bg-no-repeat bg-center" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}'); min-height: 100vh;">
    <div class="bg-cover bg-black bg-opacity-75 backdrop-blur-lg w-screen" style="min-height: 100vh;">

      <x-navcustomer :latestProfilePicture="$latestProfilePicture" />

<div class="p-2 sticky top-6 z-10" style="background-color: #0C0C0C;">
  <div class="flex justify-between items-center">
      <h1 class="text-3xl font-bold pl-7 ml-4 mt-6 pt-4 mb-3 mr-5 text-white">Booked Car</h1>
  </div>
</div>
@if(session('success'))
<div class="alert alert-success pt-4">
    {{ session('success') }}
</div>
@endif
@if(request()->query('success') == 1)
<div class="pt-2">
<div class="alert alert-success">
    Booking confirmed successfully!
</div>
</div>
@endif
<div class="pt-5">
  @if ($bookings->isEmpty())
  <div class="mx-auto mt-5 p-4 flex justify-center items-center w-1/2 ml-3 bg-gray-200">
    <h1 class="text-2xl font-semibold">Your car bookings will display here!</h1> 
    <div>

@else
@foreach ($bookings as $booking)
<div class="mx-auto mt-4 w-1/2 flex flex-col shadow-md md:flex-row md:space-x-4" style="background-color: #121212;">
    <div class="w-full md:w-1/2 md:order-1">
        <img src="{{ asset('storage/'.$booking->car->display_picture) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Car Image"/>
    </div>
    <div class="p-4 pl-4">
        <h3 class="text-white text-lg font-bold">{{$booking->car->car_brand}} - {{$booking->car->car_model}}</h3>
        <p class="text-gray-400 text-md font-semi-bold">Car Owner: {{ $booking->car->owner->first_name }} {{ $booking->car->owner->last_name }}</p>
        <p class="text-gray-400 text-md font-semi-bold">Passengers: {{ $booking->passengers }}</p>
        <p class="text-gray-400 text-md font-semi-bold">Total Rental Fee: Php {{number_format ($booking->total_rental_fee, 2) }}</p>
        <p class="text-gray-400 text-md font-semi-bold">Pickup Date and Time: {{ date('F d, Y h:i A', strtotime($booking->pickup_date_time)) }}</p>
        <p class="text-gray-400 text-md font-semi-bold">Return Date and Time: {{ date('F d, Y h:i A', strtotime($booking->return_date_time)) }}</p>
        <a href="{{ route('bookings.receipt', ['booking' => $booking->id]) }}" class="font-medium text-blue-700 hover:underline">Download Receipt</a><br>
        <a href="#" class="font-medium text-blue-700 hover:underline" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Return Car</a><br>
        <form action="{{ route('bookings.extend', ['booking' => $booking->id]) }}" method="POST">
            @csrf
            @if ($booking->is_extended)
                <button type="submit" class="font-medium text-red-700" disabled>Already Extended</button>
                <a href="{{ url('traverse-chats/' . $booking->car->owner->id) }}" target="_blank" class="font-medium text-blue-700 hover:underline">Message {{$booking->car->owner->first_name}}</a><br>
            @else
                <a href="#" data-modal-target="popup-modal2" data-modal-toggle="popup-modal2" class="font-medium text-blue-700 hover:underline">Extend</a><br>
                <a href="{{ url('traverse-chats/' . $booking->car->owner->id) }}" target="_blank" class="font-medium text-blue-700 hover:underline">Message {{$booking->car->owner->first_name}}</a><br>
            @endif
        
    </div>
</div>



@endforeach
</div>
        
        {{-- Main Modal --}}
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

 

          @endif
         
        </div>
        @include('components.traversechats')
</body>

</html>