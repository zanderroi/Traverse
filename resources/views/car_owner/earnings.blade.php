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
    </style>
</head>
<body class="pt-5 bg-cover bg-center" style="background-color:#121212;">
    
    <div class="mt-2" style="padding-left: 20%; padding-right: 20%; padding-top: 2%;" >
        <x-navcarowner :bookedCarsCount="$bookedCarsCount" :latestProfilePicture="$latestProfilePicture" />
   
          @if(session('success'))
          <div class="alert alert-success p-4">
              {{ session('success') }}
          </div>
          @endif
  
        <div class="bg-blue-500 rounded-lg p-6">
            <div class="flex items-center">
              <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 6H5V19H3V6ZM19 6H21V19H19V6ZM14 10H16V19H14V10ZM9 8H11V19H9V8Z" fill="currentColor"/>
              </svg>
              <h3 class="ml-3 text-2xl font-bold text-white">Total Earnings</h3>
            </div>
            <div class="mt-6">
              <p class="text-4xl font-bold text-white">Php {{ number_format($totalEarnings, 2) }}</p>
              <p class="mt-2 text-sm text-white">Congratulations on your success!</p>
            </div>
            <div class="mt-6">
              <a href="#" id="viewDetailsLink" class="text-white underline">View Details</a>
            </div>
          </div>

          
          
        @if ($returnedCars->isEmpty())
            <p></p>
        @else
        
        <div class="bg-gray-200 rounded-lg p-6 mt-2" style="min-height: 30%; display: none;" id="bookingDetailsContainer">
            @foreach ($returnedCars as $returnedCar)
          <div class="flex flex-row p-2">
                    <img class="rounded-md w-20 h-20" src="{{ asset('storage/'.$returnedCar->car->display_picture) }}" alt="Car Image">
                    <div class="p-2">
                        <h1 class="text-md text-blue-600 font-bold ml-2 mb-1"> {{ $returnedCar->car->car_brand }} {{ $returnedCar->car->car_model }}</h1>
                         
            <p class="text-sm text-gray-600 ml-2"> Total Sale: Php {{ number_format($returnedCar->total_rental_fee, 2) }}</p>
            <p class="text-gray-600 text-sm ml-2">Date: {{ date('F d, Y', strtotime($returnedCar->pickup_date_time)) }} - {{ date('F d, Y', strtotime($returnedCar->returned_at)) }}</p>
        </div>  
        
        <div class="ml-auto space-y-1">
            <div class="bg-blue-500 text-white text-center px-4 py-2 text-xs w-32 rounded-md">
               Service fee: Php {{ number_format($returnedCar->getCommissionAmount(), 2) }}
            </div>
            @if ($returnedCar->commissionSent())
            <div class="bg-green-500 text-white text-center px-4 py-2 text-xs w-32 rounded-md">
                Receipt Sent!
            </div>
        @else
            <button data-modal-target="#receiptModal{{ $returnedCar->id }}" class="bg-gray-200 text-xs w-32 text-gray-700 px-4 py-2 rounded-md shadow-md hover:bg-gray-300">Send receipt</button>
        @endif
        </div>

    </div> 
    <hr class="text-gray-400">
       <!-- Receipt Modal -->
       <div id="receiptModal{{ $returnedCar->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-1/2 mx-auto p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Upload Receipt</h2>
            <form action="{{ route('store.commission') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $returnedCar->id }}">
                <input type="hidden" name="car_owner_id" value="{{ $carOwner->id }}">
                <input type="hidden" name="commission" value="{{ $returnedCar->getCommissionAmount() }}">
                <input type="hidden" name="total_rental_fee" value="{{ $returnedCar->total_rental_fee }}">
                <div>
                    <label class="block mb-2" for="receiptImage{{ $returnedCar->id }}">Receipt Image</label>
                    <input type="file" id="receiptImage{{ $returnedCar->id }}" name="receipt_image" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
                    <button class="bg-gray-300 text-gray-600 px-4 py-2 rounded-md ml-2" data-modal-close>Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach                               
          </div>
          
         
          <script>
                    const viewDetailsLink = document.getElementById('viewDetailsLink');
            const bookingDetailsContainer = document.getElementById('bookingDetailsContainer');

            viewDetailsLink.addEventListener('click', function() {
                if (bookingDetailsContainer.style.display === 'none') {
                    bookingDetailsContainer.style.display = 'block';
                } else {
                    bookingDetailsContainer.style.display = 'none';
                }
            });
            document.addEventListener("DOMContentLoaded", function() {
                const modalTriggers = document.querySelectorAll("[data-modal-target]");
        
                modalTriggers.forEach(function(trigger) {
                    const modalId = trigger.getAttribute("data-modal-target");
                    const modal = document.querySelector(modalId);
                    const modalCloseBtn = modal.querySelector("[data-modal-close]");
        
                    trigger.addEventListener("click", function() {
                        modal.classList.remove("hidden");
                    });
        
                    modalCloseBtn.addEventListener("click", function() {
                        modal.classList.add("hidden");
                    });
                });
            });
        </script>
    </div>
        {{-- <table class="text-sm text-left dark:text-blue-100 mx-auto  max-w-full xs:max-w-none sm:max-w-xs md:max-w-sm  lg:max-w-md xl:max-w-lg">
            <thead class="text-md text-center text-white uppercase dark:text-white sticky top-6 z-10" style="background-color: #121212;">
                    <tr class="border-b border-gray-500">
                        <th cope="col" class="text-gray-300 text-md font-semibold"></th>
                        <th cope="col" class="text-gray-300 text-md font-semibold px-6 py-3">Car</th>
                        <th scope="col" class="px-6 py-3">Customer</th>
                        <th scope="col" class="px-6 py-3">Earnings</th>
                        <th scope="col" class="px-6 py-3">Service Fee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returnedCars as $returnedCar)
                    <tr class="border-b border-gray-500">
                        <th scope="row" class="px-3 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            <img class="rounded-full w-20 h-20" src="{{ asset('storage/'.$returnedCar->car->display_picture) }}" alt="Car Image">
                        </th>
                        <td class="px-6 py-4 text-gray-500">{{ $returnedCar->car->car_brand }} {{ $returnedCar->car->car_model }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $returnedCar->customer->first_name }} {{ $returnedCar->customer->last_name }}</td>
                        <td class="px-6 py-4 text-gray-500">Php {{ number_format($returnedCar->total_rental_fee, 2) }}</td>
                        <td class="px-6 py-4 text-gray-500">Php {{ number_format($returnedCar->getCommissionAmount(), 2) }}</td> <!-- Add this line to display the commission -->
                    </tr>
                @endforeach
                
                </tbody>
            </table> --}}
        @endif
   
</div>
@include('components.traversechats')
</body>
</html>