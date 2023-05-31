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
<body class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}');">
    <div class="bg-black bg-opacity-50 backdrop-blur-lg h-screen fixed inset-0 flex items-center justify-center">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top border-bottom" style="background-color: #0C0C0C;">
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
        <div class="bg-white p-6 rounded-lg">
            <h1 class="text-lg font-bold text-center">Booking Confirmation</h1>

            <p>Customer Name: {{ $user->first_name }} {{ $user->last_name }}</p>
            <p>Car Owner Name: {{ $car_owner_first_name }} {{ $car_owner_last_name }}</p>
            
            <h2 class="font-bold mt-1 mb-1">Car Details</h2>
            <p>Brand: {{ $car->car_brand }}</p>
            <p>Model: {{ $car->car_model }}</p>
            <p>Year: {{ $car->year }}</p>
            
            <h2 class="font-bold mt-1 mb-1">Booking Details</h2>
            <p>Pickup Date and Time: {{ $booking->pickup_date_time }}</p>
            <p>Return Date and Time: {{ $booking->return_date_time }}</p>
            <p>Notes: {{ $booking->notes }}</p>
            
            <h2 class="font-bold mt-1 mb-1">Total Rental Fee</h2>
            <p>Php {{ $total_rental_fee }}</p>
            
            <div class="mt-5 flex justify-center">
                <a href="{{ route('customer.garage')}}?success=1" class="btn btn-primary mr-2">Confirm Booking</a>
                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel Booking</button>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>