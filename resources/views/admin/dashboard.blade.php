<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="shortcut icon" type="image/png" href="resources/img/logo.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin') }}">
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

    </div>

    <h2 class="text-center"> WELCOME ADMIN </h2>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-black text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Total cars</h5>
                <p class="card-text text-center">{{ $carsCount }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>Booked</td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>Available</td>
                        <td> 5 </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Total car owners</h5>
                <p class="card-text text-center">{{ $carOwners }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>On Transanctions</td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>Vacant</td>
                        <td> 5 </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
                

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title text-center">Total customers</h5>
                <p class="card-text text-center">{{ $customers }}</p>
                <hr>
                <table class="table table-borderless text-white">
                    <tr>
                        <td>On Transactions</td>
                        <td> 0 </td>
                    </tr>
                    <tr>
                        <td>Free</td>
                        <td> 3 </td>
                    </tr>
                </table>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-light">
                        View more details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


</html>

