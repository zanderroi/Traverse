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

          {{-- Font Awesome --}}
          <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>
    <style>
      body {
          overflow-x: hidden;
      }
  </style>

</head>
<body class="pt-5 bg-slate-500">

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
    <h1 class="text-3xl font-bold ml-4 mt-6 mb-2 mr-5 text-blue-600">Booking History</h1>

    @if ($bookings->isEmpty())
    <div class="h-56 w-1/2 ml-3 bg-gray-200">
    <h1 class="pt-20 ml-6 text-2xl">Your booking history will display here!</h1> 
    <div>
@else
        <div class="mt-6  mx-auto " >
            <table class="text-sm text-left text-blue-100 dark:text-blue-100 mx-auto shadow-md sm:rounded-lg max-w-full xs:max-w-none sm:max-w-xs md:max-w-sm  lg:max-w-md xl:max-w-lg">
                <thead class="text-xs text-white uppercase bg-gray-700 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Car Model
                        </th>

                        <th scope="col" class="px-2 py-3">
                            Total Rental Fee
                        </th>

                        <th scope="col" class="px-12 py-3">
                            Pickup Date and Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Returned
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                         </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($bookings as $booking)
                    <tr class="bg-gray-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            {{ $booking->car->car_brand ?? 'Unlisted Car' }}   {{ $booking->car->car_model ?? ' ' }}
                        </th>

                        <td class="px-1 py-4">
                            Php {{ $booking->total_rental_fee }}
                        </td>
   
                        <td class="pl-1 py-4">
                            {{ date('F d, Y h:i A', strtotime($booking->pickup_date_time)) }}

                        </td>
                        <td class="px-6 py-4">
                            {{ date('F d, Y h:i A', strtotime($booking->returned_at)) }}
                        </td>
                        <td class="px-2 py-4">
                            @if ($booking->car->carRatings->where('customer_id', auth()->user()->id)->count() > 0)
                            <p>You have already rated this car.</p>
                            @else
                            <a href="#" class="font-medium text-white hover:underline" ddata-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-toggle="defaultModal">Rate Car</a><br>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Main Modal --}}

        <form method="POST" action="{{ route('car.rating.store', ['booking_id' => $booking->id, 'car_owner_id' => $booking->car->owner->id, 'customer_id' => auth()->user()->id]) }}">
            @csrf
            <input type="hidden" name="car_id" value="{{ $booking->car->id }}">
            <input type="hidden" name="car_owner_id" value="{{ $booking->car->owner->id }}">
            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
          
          <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                      <div class="p-6 text-center">
    
                          <h3 class="mt-2 mb-3 text-lg font-normal text-blue-600 dark:text-gray-400">Rate your experience!</h3>
                          <div class="flex items-center">
                            <div class="mr-2 col-md-4">
                              <span class="text-sm">Rate</span>
                            </div>
                            <div class="flex">
                                <input type="radio" id="rating-1" name="rating" value="1" class="hidden" />
                                <label for="rating-1">
                                  <i class="fa-solid fa-star fa-lg cursor-pointer text-gray-400" onclick="setColor(1)"></i>
                                </label>
                                <input type="radio" id="rating-2" name="rating" value="2" class="hidden" />
                                <label for="rating-2">
                                  <i class="fa-solid fa-star fa-lg cursor-pointer text-gray-400" onclick="setColor(2)"></i>
                                </label>
                                <input type="radio" id="rating-3" name="rating" value="3" class="hidden" />
                                <label for="rating-3">
                                  <i class="fa-solid fa-star fa-lg cursor-pointer text-gray-400" onclick="setColor(3)"></i>
                                </label>
                                <input type="radio" id="rating-4" name="rating" value="4" class="hidden" />
                                <label for="rating-4">
                                  <i class="fa-solid fa-star fa-lg cursor-pointer text-gray-400" onclick="setColor(4)"></i>
                                </label>
                                <input type="radio" id="rating-5" name="rating" value="5" class="hidden" />
                                <label for="rating-5">
                                  <i class="fa-solid fa-star fa-lg cursor-pointer text-gray-400" onclick="setColor(5)"></i>
                                </label>
                              </div>
                              
                              <script>
                              function setColor(value) {
                                // Reset all stars to gray
                                document.querySelectorAll('input[name="rating"]').forEach((elem) => {
                                  elem.nextElementSibling.firstElementChild.classList.remove('text-yellow-300');
                                  elem.checked = false;
                                });
                              
                                // Set selected stars to yellow
                                for (let i = 1; i <= value; i++) {
                                  document.getElementById(`rating-${i}`).nextElementSibling.firstElementChild.classList.add('text-yellow-300');
                                }
                              
                                // Check the corresponding radio button
                                document.getElementById(`rating-${value}`).checked = true;
                              }
                              </script>
                              
                          </div>
                          
                          <div class="form-group row mt-1">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
        
                            <div class="col-md-6">
                                <textarea id="description" class="form-control mb-3 @error('description') is-invalid @enderror  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="description">{{ old('description') }}</textarea>
        
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          <button data-modal-hide="popup-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Confirm rating
                          </button>
                        </form>
                          <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                      </div>
                  </div>
              </div>
          </div>
        
          @endif

</body>
</html>