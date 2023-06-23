<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/icon.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
       {{-- Flowbite Tailwind --}}
       <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
       
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       {{-- Font Awesome --}}
       <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>
       
       <style>
           

       #scroll-to-next {
       animation: fadeInDown 2s ease-in-out infinite;
       }

       @keyframes fadeInDown {
       0% {
           opacity: 0;
           transform: translateY(-20px);
       }
       50% {
           opacity: 1;
           transform: translateY(10px);
       }
       100% {
           opacity: 0;
           transform: translateY(20px);
       }
       }
       /* Scale effect on hover */
       .hover-scale:hover {
           transform: scale(1.05);
           transition: all 0.2s ease-in-out;
       }

           </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm sticky top-0 z-10 border-bottom" style="background-color: #0C0C0C;">
            <div class="container">
                <a class="navbar-brand flex items-center" href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}">
                    <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Traverse</span>
                </a>
                {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul> --}}


                    <!-- Right Side Of Navbar -->
                    <div class="d-flex justify-content-end">

                        {{-- <a href="/cars/details" class="btn btn-outline-black ml-auto mt-0.5 text-white">
                            Cars
                        </a>
                        <a href="/owners/details" class="btn btn-outline-black ml-auto mt-0.5 text-white">
                            Owners
                        </a>
                        <a href="/customers/details" class="btn btn-outline-black ml-auto mt-0.5 text-white">
                            Customers
                        </a>
                        <a href="/reservation/details" class="btn btn-outline-black ml-auto mt-0.5 text-white">
                            Bookings
                        </a> --}}
                        <a href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}" class="btn btn-outline-black ml-auto mt-0.5 text-white">
                            Home
                        </a>
                    
                     <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
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
        @yield('content')

    </div>
    

 