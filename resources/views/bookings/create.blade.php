<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Scripts -->
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    {{-- Modal Script --}}
    <script>
		document.getElementById('book-car-button').addEventListener('click', function() {
		    // Set the car owner

		    // Set the pickup date and time
		    var pickupDateTime = document.getElementById('pickup_date_time').value;
		    document.getElementById('pickup_date_time').innerText = pickupDateTime;

		    // Set the return date and time
		    var returnDateTime = document.getElementById('return_date_time').value;
		    document.getElementById('return_date_time').innerText = returnDateTime;

		    // Calculate and set the rental fee
		    var pickupDate = new Date(pickupDateTime);
		    var returnDate = new Date(returnDateTime);
		    var rentalDays = Math.ceil((returnDate - pickupDate) / (1000 * 60 * 60 * 24));
		    var rentalFee = rentalDays * {{ $car->price_per_day }};
		    document.getElementById('rental_fee').innerText = rentalFee.toFixed(2);

		    // Show the modal
		    var modalToggle = document.getElementById('book-car-button').getAttribute('data-modal-toggle');
		    var modal = document.getElementById(modalToggle);
		    modal.classList.add('is-active');
		});
	</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Traverse
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul>
                            <li>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
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

<div class="container mt-14">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Booking') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bookings.store', $car->id) }}">
                        @csrf
                        <p class="mb-1 font-normal"><strong>Rental fee per day: Php{{ $car->rental_fee }}</p>
                        <div class="form-group row">
                            <label for="pickup_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Pickup Date and Time') }}</label>

                            <div class="col-md-6">
                                <input id="pickup_date_time" type="datetime-local" class="form-control @error('pickup_date_time') is-invalid @enderror" name="pickup_date_time" value="{{ old('pickup_date_time') }}" required autofocus>

                                @error('pickup_date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="return_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Return Date and Time') }}</label>

                            <div class="col-md-6 mt-1">
                                <input id="return_date_time" type="datetime-local" class="form-control @error('return_date_time') is-invalid @enderror" name="return_date_time" value="{{ old('return_date_time') }}" required>

                                @error('return_date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-1">
                            <label for="note" class="col-md-4 col-form-label text-md-right">{{ __('Note to Car Owner') }}</label>

                            <div class="col-md-6">
                                <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note') }}</textarea>

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button id="book-car-button" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    {{ __('Book Car') }}
                                </button>
                                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Main modal -->
  <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Confirm Booking {{ $car->car_brand }} - {{ $car->car_model }}
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-6 space-y-6">
                <p><strong>Car Owner:</strong> <span id="car-owner"></span></p>
                <p><strong>Pickup Date and Time:</strong> <span id="pickup_date_time"></span></p>
                <p><strong>Return Date and Time:</strong> <span id="return_date_time"></span></p>
                <p><strong>Rental Fee:</strong> <span id="rental_fee"></span></p>
              
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button data-modal-hide="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Book Now!</button>
                  <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
              </div>
          </div>
      </div>
  </div>



</body>
</html>