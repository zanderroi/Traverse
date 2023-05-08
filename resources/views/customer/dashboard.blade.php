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
    <style>
      body {
          overflow-x: hidden;
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
                <a class="navbar-brand flex items-center" href="{{ url('/') }}">
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
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold ml-4 mt-6 mb-2 mr-5 text-blue-600">Available Cars</h1>
      
        <div class="flex items-center">
          <form method="GET" action="{{ route('customer.available_cars') }}">
            <label for="location" class="ml-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search by Location</label>
            <div class="relative ml-2 mt-2">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-3 h-3 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
              <input type="text" name="location" value="{{ $location }}" class="h-4 block w-64 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by Location">
              <button type="submit" class="text-white absolute top-2.5 right-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 rounded-md text-xs text-center px-2 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Search</button>
            </div>
          </form>
      
          <form action="{{ route('customer.available_cars') }}" method="GET" class="ml-4">
            <div class="form-group">
              <div class="mt-2">
                <select class="w-32 h-10 text-xs order border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="sort_by_rental_fee" id="sort_by_rental_fee">
                  <option value="">Rental Fee</option>
                  <option value="asc">Lowest to highest</option>
                  <option value="desc">Highest to lowest</option>
                </select>
      
                <button class="h-7 ml-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md text-xs text-center px-2 py-1.5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="submit" onclick="updateSortBox()">Sort</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      
    
    <div class="row justify-content-start ">
        @foreach ($cars as $car)
        <div class=" hover:bg-blue-500 dark:bg-gray-800 dark:hover:bg-gray-700 left-1 mt-2 mr-3 ml-6 mb-4 pt-2 px-2 w-64 h-32 border border-gray-200 rounded-lg shadow-md dark:border-gray-700">

            <img class="rounded-t-lg rounded-b-lg" src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:250px;height:150px;"/>
            <div class="p-3">
                <a class="hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" href="{{ route('cars.show', $car->id) }}">
                    <h5 class="mx-auto mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
                
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Car Owner: {{ $car->owner->first_name }} {{ $car->owner->last_name }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Location: {{ $car->location }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Rental fee: Php{{ $car->rental_fee }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Status: {{ $car->status }}</p>
            </a>
            </div>
        </div>
    @endforeach
</div>

<script>
function updateSortBox() {
  var sortBox = document.getElementById("sort_by_rental_fee_box");
  sortBox.innerText = "Sort by rental fee";
}
  </script>

</body>
</html>
