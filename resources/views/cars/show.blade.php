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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
        
        <div class="container w-full bg-slate-500">    
        <div id="controls-carousel" class="mx-auto relative w-1/2 bg-gray-500 mt-2" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden md:h-96">
                 <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:1000px; height:400px;" />
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->add_picture1) }}" alt="Car Image" />
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->add_picture2) }}" alt="Car Image" style="width:1000px; height:400px;" />
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->add_picture3) }}" alt="Car Image" style="width:1000px; height:400px;" />
                </div>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg aria-hidden="true" class="w-6 h-6 text-blue-600 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg aria-hidden="true" class="w-6 h-6 text-blue-600 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        <div class ="mx-auto w-1/2">
                    <h5 class="mb-2  mt-2 text-2xl font-bold tracking-tight  text-blue-600 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
                    <div class="flex mx-auto">
                        <i class="fa-solid fa-user mb-1" style="color: #152238;"></i>
                        <p class="mb-1 ml-2 font-normal text-gray-700 dark:text-gray-400">{{ $car->owner->first_name }} {{ $car->owner->last_name }}</p>
                  
                        <i class="fa-solid fa-location-dot mb-3 ml-2" style="color: #152238;"></i>
                        <p class="mb-1 ml-2 font-normal text-gray-700 dark:text-gray-400">{{ $car->location }}</p>

                        <i class="fa-solid fa-users mb-1 ml-3" style="color: #152238;"></i>
                        <p class="mb-1 ml-2 font-normal text-gray-700 dark:text-gray-400">{{ $car->seats }} seater</p>

                        <i class="fa-solid fa-peso-sign mt-1 ml-3" style="color: #152238;"></i>
                        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400"> {{ $car->rental_fee }}</p>
                    </div>
                    
                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Plate number: {{ $car->plate_number }}</p>
                    
                    
                    <p class="mb-3 text-gray-500 dark:text-gray-400">Description: {{ $car->car_description}}</p>
                    <button id="book-car-button" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ __('Book Car') }}
                    </button>
                </div>  
            </div>
         <!-- Main modal -->
         <form action="{{ route('bookings.confirm', ['car_id' => $car->id]) }}" method="post">

            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <input type="hidden" name="car_owner_name" value="{{ $car_owner->name }}">
            <input type="hidden" name="car_owner_email" value="{{ $car_owner->email }}">
            <input type="hidden" name="car_owner_phone_number" value="{{ $car_owner->phone_number }}">
  <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white align-">
                    Booking Details: {{$car->car_brand}} - {{$car->car_model}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="flex align-items-center">
                    <div class="w-1/2">
                      <label for="car_owner" class="block font-medium text-gray-700">Car Owner</label>
                      <input id="car_owner" type="text" class="form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" value="{{ $car->owner->first_name }} {{ $car->owner->last_name }}" readonly>
                    </div>
                    <div class="w-1/2">
                      <label for="rental_fee" class="block font-medium text-gray-700">Rental Fee Per Day</label>
                      <input id="rental_fee" type="text" class="form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" value="{{'Php '}}{{ $car->rental_fee }}" readonly>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="pickup_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Pickup Date and Time') }}</label>

                    <div class="col-md-6">
                        <input id="pickup_date_time" type="datetime-local" class="form-control @error('pickup_date_time') is-invalid @enderror  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="pickup_date_time" value="{{ old('pickup_date_time') }}" required autofocus>

                        @error('pickup_date_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="return_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Return Date and Time') }}</label>

                    <div class="col-md-6 mt-1">
                        <input id="return_date_time" type="datetime-local" class="form-control @error('return_date_time') is-invalid @enderror  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="return_date_time" value="{{ old('return_date_time') }}" required>

                        @error('return_date_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Note to Car Owner') }}</label>

                    <div class="col-md-6">
                        <textarea id="notes" class="form-control @error('notes') is-invalid @enderror  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="notes">{{ old('notes') }}</textarea>

                        @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
              
            
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                 <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continue</button>
                </form>
                 <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
            </div>
        
        </div>
    </div>
</div>


 

        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>
