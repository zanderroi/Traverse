<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/resources/img/logo.png') }}">

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
                            <a href="{{ $addCarLink }}" class="mr-5 block py-2 pl-3 pr-4 text-black rounded md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">List a Car</a>
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
    <div class="row">
    @foreach($cars as $car)

    <div class="mx-auto mr-3 ml-3 mb-4 pt-2 px-2 w-64 h-32 border border-gray-200 rounded-lg shadow-md dark:border-gray-700">
        <a href="#">
            <img class="rounded-t-lg rounded-b-lg" src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" />

        </a>
        <div class="p-5">
            <a href="#">
                <h5 class="mx-auto mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
            </a>
            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Plate number: {{ $car->plate_number }}</p>
            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Location: {{ $car->location }}</p>
            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Rental fee: Php{{ $car->rental_fee }}</p>
            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Status: {{ $car->status }}</p>
        </div>
        <form action="{{ route('car_owner.delete_car', ['car_id' => $car->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to unlist this car?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 btn btn-danger">Unlist Car</button>
        </form>
        
    </div>

@endforeach
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>
