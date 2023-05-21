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
      .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }
  </style>
</head>
<body class="pt-5">
  @if(session('success'))
  <div class="alert alert-success mt-3">
      {{ session('success') }}
  </div>
  @endif

    @if(session('cancelled'))
    <div class="alert alert-success mt-3">
        {{ session('cancelled') }}
    </div>
    @endif
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
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                      <li>
                        <a href="{{ route('customer.garage') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-600" aria-current="page">Garage</a>
                      </li>
                      <li>
                        <a href="{{ route('customer.history') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-600" aria-current="page">History</a>
                      </li>
                      <li>
                        <div class="sm:fixed sm:top-0 sm:right-0 text-right mr-2">

                            <a href="{{ route('traverse-chats') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Traverse Chats </a>
                    </div>
                </li>
                      <li>
                        <div class="flex items-center">
                          @if ($user->avatar)
                          <img class="w-8 h-8 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">    
                      @else
                        @php
                          $latestAvatar = $user->avatar()->latest()->first();
                        @endphp
                          <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $latestAvatar->avatar) }}" alt="Profile Picture">
                      @endif
                          <a id="navbarDropdown" class="nav-link dropdown-toggle ml-2 text-blue-600 font-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                          </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('customer.profile') }}">
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
            </div>
        </nav>
    </div>   
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('logo/bgimage5.jpg') }}');">
      <div class="bg-cover bg-gray-400 bg-opacity-50 backdrop-blur-lg w-full min-h-screen bg-center">
        <div class="bg-gray-700 p-3 sticky top-6 z-10">
          <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold pl-7 ml-4 mt-6 mb-3 mr-5 text-white">Available Cars</h1>
            <div class="flex items-end">
            <form method="GET" action="{{ route('customer.available_cars') }}">
              <label for="location" class="ml-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search by Location</label>
              <div class="relative ml-2 mt-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg aria-hidden="true" class="w-3 h-3 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                </div>
                <input type="text" name="location" value="{{ $location }}" class="h-4 block w-64 p-4 pl-10 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by Location">
                <button type="submit" class="text-white absolute top-2.5 right-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 text-xs text-center px-2 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Search</button>
              </div>
            </form>
    
            <form action="{{ route('customer.available_cars') }}" method="GET" class="ml-4">
              <div class="form-group">
                <div class="mt-2 mb-1">
                  <select class="w-32 h-10 text-xs order border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="sort_by_rental_fee" id="sort_by_rental_fee">
                    <option value="">Rental Fee</option>
                    <option value="asc">Lowest to highest</option>
                    <option value="desc">Highest to lowest</option>
                  </select>
    
                  <button class="h-7 ml-2 text-white bg-blue-600 hover:bg-blue-700 text-xs text-center px-2 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="submit" onclick="updateSortBox()">Sort</button>
                </div>
              </div>
            </form>
          </div>
          </div>
        </div>
      
      
  
    <div class="ml-4 pl-5 row justify-content-start mt-2 flex-row">
        @foreach ($cars as $car)
        <div class="bg-white hover-scale hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 left-1 mt-2 mr-3 ml-4 mb-4 pt-2 px-2 w-64 h-32 border border-gray-200 rounded-lg shadow-md dark:border-gray-700">

            <img src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:250px;height:150px;"/>
            <div class="p-3">
                <a class="hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" href="{{ route('cars.show', $car->id) }}">
                    <h5 class="mx-auto mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
                <div class="flex items-center">
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400"><i class="fa-sharp fa-solid fa-calendar mr-1" style="color: #152238;"></i>{{ $car->year }}</p>              
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400"><i class="fa-solid fa-users mr-1 ml-2" style="color: #152238;"></i>{{ $car->seats }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400"><i class="fa-solid fa-location-dot mr-1 ml-2" style="color: #152238;"></i>{{ $car->location }}</p>
               
                </div>
                <div class="flex items-center">
                @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $car->ratings)
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <title>Star</title>
                     <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                     </svg>
                 @else
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Star</title>
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                @endif
            @endfor
                  </div> 
                  <p class="mt-1 font-extrabold text-xl text-gray-700 dark:text-gray-400"><i class="fa-solid fa-peso-sign mr-1" style="color: #152238;"></i>{{number_format ($car->rental_fee) }}</p>
            </a>
            </div>
        </div>
    @endforeach
</div>
      </div>
    </div>
  
  

<script>
function updateSortBox() {
  var sortBox = document.getElementById("sort_by_rental_fee_box");
  sortBox.innerText = "Sort by rental fee";
}
  </script>

</body>
</html>
