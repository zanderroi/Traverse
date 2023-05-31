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
<body class="pt-5 bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage5.jpg') }}'); background-repeat: repeat-y;">
    <div class="pt-4 bg-cover bg-black bg-opacity-50 backdrop-blur-lg bg-center">
    <div id="app">
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
                            <a href="{{ route('car_owner.rentedcars') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">
                              @if (isset($bookedCarsCount) && $bookedCarsCount > 0)
                            <span class="bg-red-500 text-white rounded-full px-1.5">{{ $bookedCarsCount }}</span>
                        @endif
                                Rented Cars
                            </a>
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

    </div>
    <div class="w-1/2 pt-8 mx-auto rounded-md"  style="background-color: #121212; max-width: 1350px;">
        <div class="flex flex-row justify-end">
        <h1 class="text-gray-300 font-extrabold text-xl mr-3">TOTAL EARNINGS: Php {{ number_format($totalRentalFee, 2) }}</h1>
        </div>
        <hr class="text-gray-500 mt-1 ">
        @if ($returnedCars->isEmpty())
            <p>No rented cars found.</p>
        @else
        <table class="text-sm text-left dark:text-blue-100 mx-auto  max-w-full xs:max-w-none sm:max-w-xs md:max-w-sm  lg:max-w-md xl:max-w-lg">
            <thead class="text-md text-center text-white uppercase dark:text-white sticky top-6 z-10" style="background-color: #121212;">
                    <tr class="border-b border-gray-500">
                        <th cope="col" class="text-gray-300 text-md font-semibold"></th>
                        <th cope="col" class="text-gray-300 text-md font-semibold px-6 py-3">Car</th>
                        <th scope="col" class="px-6 py-3">Customer</th>
                        <th scope="col" class="px-6 py-3">Earnings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returnedCars as $returnedCar)
                        <tr class="border-b border-gray-500">
                            <th scope="row" class=" px-3 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                <img class="rounded-full w-20 h-20" src="{{ asset('storage/'.$returnedCar->car->display_picture) }}" alt="Car Image">
                            </th>
                            <td class="px-6 py-4 text-gray-500">{{ $returnedCar->car->car_brand }} {{ $returnedCar->car->car_model }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $returnedCar->customer->first_name }} {{ $returnedCar->customer->last_name }}</td>
                            <td class="px-6 py-4 text-gray-500">Php {{ number_format($returnedCar->total_rental_fee,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</body>
</html>