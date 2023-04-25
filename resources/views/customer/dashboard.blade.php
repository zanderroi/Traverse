<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="shortcut icon" type="image/png" href="/img/logo.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Scripts -->
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
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

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <h2> Available Cars </h2>
    <div class="row">
    <!-- Display the search form --> 
    <form method="GET" action="{{ route('customer.available_cars') }}">   
        <label for="location" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search by Location</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="location" value="{{ $location }}" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by Location">
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    {{-- Filter Rental fee --}}
    <form action="{{ route('customer.available_cars') }}" method="GET">
        <div class="form-group">
            <label for="sort_by_rental_fee">Sort by rental fee:</label>
            <select name="sort_by_rental_fee" id="sort_by_rental_fee" class="form-control">
                <option value="asc">Lowest to highest</option>
                <option value="desc">Highest to lowest</option>
            </select>
        </div>
        <button class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="submit" class="btn btn-primary">Sort</button>
    </form>

    
    </div>
    <div class="row ">
        @foreach ($cars as $car)
        <div class="mx-auto w-96 mr-5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <img class="rounded-t-lg" src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" />
            {{ $car->display_picture }}
            <div class="p-5">
                <a href="#" data-toggle="modal" data-target="#carModal{{ $car->id }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
                </a>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Car Owner: {{ $car->owner->name }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Plate number: {{ $car->plate_number }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Location: {{ $car->location }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Rental fee: Php{{ $car->rental_fee }}</p>
                <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Status: {{ $car->status }}</p>
            </div>
        </div>
    
    
    @endforeach
    
</div>
</body>
</html>
