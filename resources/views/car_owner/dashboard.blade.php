<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('../resources/img/logo.png') }}">

    <title>Traverse</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('car_owner.dashboard') }}">
                    Traverse
                </a>
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav me-auto">

                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <a href="{{ $addCarLink }}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">List a Car</a>
                          </li>

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
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <h2> Listed Cars </h2>

    @foreach($cars as $car)
    <div class="card">
        <div class="card-header">{{ $car->car_brand }} - {{ $car->car_model }}</div>
        <div class="card-body">
            <div class="row">
                <img src="{{ asset($car->display_picture) }}" alt="Car Image">
                <div class="col-md-6">
                    <p>Plate number: {{ $car->plate_number }}</p>
                    <p>Location: {{ $car->location }}</p>
                    <p>Rental fee: {{ $car->rental_fee }}</p>
                    <p>Status: {{ $car->status }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('car_owner.delete_car', ['car_id' => $car->car_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-gray-900 btn btn-danger">Delete</button>
        </form>
        
    </div>
@endforeach



<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>
