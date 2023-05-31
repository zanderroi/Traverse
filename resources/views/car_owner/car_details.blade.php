<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

</head>
<body>
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
                          <a href="#" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Earnings!</a>
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
        @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('List a Car') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('car_owner.add_car_details') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- image upload field -->
                                <div class="row mb-3">
                                    <label for="display_picture" class="col-md-4 col-form-label text-md-end">{{ __('Display Picture') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="display_picture" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('display_picture') is-invalid @enderror" name="display_picture" required>
        
                                        @error('display_picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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
                                    <label for="year" class="col-md-4 col-form-label text-md-end">Year</label>
                                    <div class="col-md-6">
                                        <select id="year" name="year" class="form-control @error('year') is-invalid @enderror" required>
                                            <option value="">-- Select Year --</option>
                                            @for ($i = date('Y'); $i >= 1900; $i--)
                                                <option value="{{ $i }}" @if (old('year') == $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                

                                <div class="row mb-3">
                                    <label for="seats" class="col-md-4 col-form-label text-md-end">Number of seats</label>
                                    <div class="col-md-6">
                                    <input id="seats" type="number" min="1" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control @error('seats') is-invalid @enderror" name="seats" value="{{ old('seats') }}" required autocomplete="seats" autofocus>
                            
                                    @error('seats')
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
                                <div class="row mb-1">
                                    <label for="add_picture1" class="col-md-4 col-form-label text-md-end">{{ __('Additional Pictures') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="add_picture1" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture1') is-invalid @enderror" name="add_picture1" required>
        
                                        @error('add_picture1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                <label for="add_picture2" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="col-md-6">
                                        <input id="add_picture2" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture2') is-invalid @enderror" name="add_picture2" required>
        
                                        @error('add_picture2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="add_picture3" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="mb-2 col-md-6">
                                        <input id="add_picture3" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture3') is-invalid @enderror" name="add_picture3" required>
        
                                        @error('add_picture3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="offset-md-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <button type="submit">
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>
