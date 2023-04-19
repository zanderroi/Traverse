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

    <style>
        body {
          background-image: url('resources/img/bgimage.jpg');
        }
        </style>
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
                        <li class="-mb-px mr-1">
                            <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold navbar" href="{{ route('car_owner.dashboard') }}">Dashboard</a>
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
        @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('List a Car') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('car_owner.add_car_details') }}" enctype="multipart/form-data">
                                @csrf
        
                                <div class="row mb-3">
                                    <label for="car_brand" class="col-md-4 col-form-label text-md-end">{{ __('Car Brand') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="car_brand" type="text" class="form-control @error('car_brand') is-invalid @enderror" name="car_brand" value="{{ old('car_brand') }}" required autocomplete="car_brand" autofocus>
        
                                        @error('car_brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="car_model" class="col-md-4 col-form-label text-md-end">{{ __('Car Model') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="car_model" type="text" class="form-control @error('car_model') is-invalid @enderror" name="car_model" value="{{ old('car_model') }}" required autocomplete="car_model" autofocus>
        
                                        @error('car_model')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="plate_number" class="col-md-4 col-form-label text-md-end">{{ __('Plate Number') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="plate_number" type="text" class="form-control @error('plate_number') is-invalid @enderror" name="plate_number" value="{{ old('plate_number') }}" required autocomplete="plate_number" autofocus>
        
                                        @error('plate_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="vehicle_identification_number" class="col-md-4 col-form-label text-md-end">{{ __('Vehicle Identification Number') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="vehicle_identification_number" type="text" class="form-control @error('vehicle_identification_number') is-invalid @enderror" name="vehicle_identification_number" value="{{ old('vehicle_identification_number') }}" required autocomplete="vehicle_identification_number" autofocus>
        
                                        @error('vehicle_identification_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>
        
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

   
                                <!-- image upload field -->
                                <div class="row mb-3">
                                    <label for="certificate_of_registration" class="col-md-4 col-form-label text-md-end">{{ __('Certificate of Registration') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="certificate_of_registration" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('certificate_of_registration') is-invalid @enderror" name="certificate_of_registration" required>
        
                                        @error('certificate_of_registration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="car_description" class="col-md-4 col-form-label text-md-end">Car Description:</label>
                                    <div class="col-md-6">
                                    <textarea id="car_description" name="car_description" rows="4" cols="50" class="form-control @error('car_description') is-invalid @enderror" name="car_description" value="{{ old('car_description') }}" required autocomplete="car_description" autofocus></textarea>
                                        @error('car_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="rental_fee" class="col-md-4 col-form-label text-md-end">Rental Fee Per Day:</label>
                                    <div class="col-md-6">
                                    <input type="number" id="rental_fee" name="rental_fee" step="0.01" class="form-control @error('rental_fee') is-invalid @enderror" name="rental_fee" value="{{ old('rental_fee') }}" required autocomplete="rental_fee" autofocus required>
                                    @error('rental_fee')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="car_images" class="col-md-4 col-form-label text-md-end">Car Images:</label>
                                    <div class="col-md-6">
                                    <input type="file" id="car_images" name="car_images[]" accept="image/*" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('car_images') is-invalid @enderror" name="car_images" required>
                                    </div>
                                </div>


                                
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Add Car') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @endsection
        <main class="py-4">
            @yield('content')
            
        </main>
    </div>
    
    
</body>
</html>
