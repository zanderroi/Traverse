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
   @vite('resources/js/bookingcalendar.js')
   @vite('resources/js/popupmodal.js')


    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>

    
    
   
</head>
<body class="pt-5 bg-cover bg-center h-screen" style="background-color: #0C0C0C;">
    <div class="bg-cover bg-black bg-opacity-50 backdrop-blur-lg w-full h-full bg-center">

        <x-navcustomer :latestProfilePicture="$latestProfilePicture" />

        <div  style="background-color: #1F1F1F;">    
        <div id="controls-carousel" class="mx-auto relative w-full md:w-1/2 lg:w-1/2  mt-2"  style="padding-left: 15%; padding-right:15%" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden md:h-96">
                 <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->add_picture1) }}" alt="Car Image" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->add_picture2) }}" alt="Car Image" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img class="mx-auto mt-0" src="{{ asset('storage/'.$car->add_picture3) }}" alt="Car Image" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
            </div>
            <!-- Slider controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-carousel-prev>
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
            <button type="button" class="carousel-control-next" data-carousel-next>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="mx-auto w-full md:w-1/2 lg:w-1/2" style="padding-left: 15%; padding-right:15%">
            <h5 class="mb-2 mt-2 text-2xl font-bold tracking-tight text-blue-600 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
            <div class="mx-auto w-full md:w-1/2 lg:w-1/2">
                <div class="flex flex-wrap mx-auto space-x-2">
                    <div class="flex items-center">
                        <i class="fa-solid fa-user mb-1 text-gray-300"></i>
                        <p class="mb-1 ml-2 font-normal text-gray-300 dark:text-gray-400">{{ $car->owner->first_name }} {{ $car->owner->last_name }}</p>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fa-solid fa-location-dot mb-2  text-gray-300"></i>
                        <p class="mb-1 ml-2 font-normal text-gray-300 dark:text-gray-400">{{ $car->location }}</p>
                    </div>
            
                    <div class="flex items-center">
                        <i class="fa-solid fa-users mb-1 text-gray-300"></i>
                        <p class="mb-1 font-normal ml-1 text-gray-300 dark:text-gray-400">{{ $car->seats }} seater</p>
                    </div>
            
                    <div class="flex items-center">
                        <i class="fa-solid fa-gear mb-1  text-gray-300"></i>
                        <p class="mb-1  font-normal ml-1 text-gray-300 dark:text-gray-400">{{ $car->transmission }}</p>
                    </div>
            
                    <div class="flex items-center">
                        <i class="fa-solid fa-car  text-gray-300"></i>
                        <p class=" font-normal ml-1 text-gray-300 dark:text-gray-400">{{ $car->plate_number }}</p>
                    </div>
                </div>
            </div>
            
        
            <div class="flex items-center mt-4">
                <div class="flex-growp-2 rounded-sm mr-2">
                    <div class="flex items-center">
                        <i class="fa-solid fa-peso-sign fa-2xl text-blue-600 mr-2"></i>
                        <p class="font-black text-3xl text-blue-600 dark:text-blue-600">
                            {{ number_format($car->rental_fee, 2) }}
                        </p>
                    </div>
                </div>
                <div class="flex ml-auto">
                    @if ($bookingStatus === 'Pending')
                        <div class="block mr-1 text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-sm text-xs px-1 py-2.5 text-center dark:bg-red-800 dark:hover:bg-red-900 dark:focus:ring-red-900">
                            <p class="text-whit">You still have a pending booking!</p>
                        </div>
                    @else
                        <button id="book-car-button" data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="mr-1 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-sm text-xs px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('Book Car') }}
                        </button>
                    @endif
                    
                    <button type="button" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-sm text-xs px-3 py-2.5 text-center dark:bg-green-600 dark:hover:bg-blue-700 dark:focus:ring-green-800" onclick="window.open('{{ url('traverse-chats/' . $car->owner->id) }}', '_blank')">
                        Message Owner
                    </button>
                </div>
            </div>
        
            <h3 class="text-lg font-bold mt-2 text-gray-300">Description</h3>
            <hr class="mt-1 text-gray-300">
            <p class="mt-2 text-gray-300">{{ $car->car_description}}</p>
        </div> 
                
                <div class="mx-auto w-full md:w-1/2 lg:w-1/2 content-center" style="padding-left: 15%; padding-right:15%">
                    <hr class=mt-3>
                    <div class="flex justify-center mt-4">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $car->ratings)
                                    <svg aria-hidden="true" class="w-10 h-10 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Star</title>
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg aria-hidden="true" class="w-10 h-10 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Star</title>
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                                                

        <!-- Average Rating -->
        <p class="text-center text-lg font-semibold text-gray-300">{{ $car->ratings }} out of 5</p>


        @foreach ($percentageArray as $index => $percentage)
        <div class="flex justify-center pt-2">
            <span class="text-xs font-medium text-white">{{ 5 - $index }} star</span>
            <div class="w-96 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                <div class="h-5 bg-yellow-400 rounded" style="width: {{ $percentage }}%;"></div>
            </div>
            <span class="text-xs m font-medium text-white">{{ intval($percentage) }}%</span>
            
        </div>
        
    @endforeach
    <hr class="mt-2 mb-2">
                <!-- Display ratings -->
                @if (count($ratings) > 0)
                <h2 class="font-extrabold text-lg mt-3 text-gray-300">Reviews</h2>
                <hr class="mt-1 text-gray-300">
                <ul>
                    @foreach ($ratings as $rating)
                    <div class="flex items-center mb-4 space-x-4 mt-2">
                      @if ($latestProfilePicture)
                      <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' .$latestProfilePicture->profilepicture) }}" alt="Profile Picture">
                  @else
                      <img class="w-10 h-10 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
                  @endif
                        <div class="font-medium dark:text-white">
                            <p class="font-bold text-gray-300">{{ $rating->customer->first_name }} {{ $rating->customer->last_name }} <time datetime="2014-08-16 19:00" class="block text-sm text-gray-500 dark:text-gray-400">{{ $rating->created_at->format('F, j Y') }}</time></p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $rating->rating)
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
                        
                        <li class="font-semibold text-gray-300">{{ $rating->description }}</li>
                        <hr class="mb-1 mt-2 text-gray-600">
                     
                    @endforeach
                </ul>
                @else
                <p class="mt-3 text-lg font-semibold">No ratings available.</p>
                @endif
 
            </div>
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
                  <div class="row">
                  <label for="passengers" class="col-md-4 col-form-label text-md-right">Number of Passengers</label>
                     <div class="col-md-6"> 
                    <input id="passengers" name="passengers"type="number" class="form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"  required autofocus min="1">
                    </div>
                </div>
                  <div class="row">
                      <label for="pickup_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Pickup Date and Time') }}</label>
                    <div class="col-md-6">
                        <input id="pickup_date_time" type="datetime-local" class="form-control @error('pickup_date_time') is-invalid @enderror  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="pickup_date_time" value="{{ old('pickup_date_time') }}" min="{{ date('Y-m-d\TH:i:s', strtotime('today')) }}" max="{{ date('Y-m-d\TH:i:s', strtotime('+1 week')) }}" required autofocus>
                        @error('pickup_date_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="return_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Return Date and Time') }}</label>
                    <div class="col-md-6">
                        <input id="return_date_time" type="datetime-local" class="form-control @error('return_date_time') is-invalid @enderror border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="return_date_time" value="{{ old('return_date_time') }}" required autofocus>
                        @error('return_date_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
              

                <div class="row">
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

    {{-- Popup Modal --}}
    {{-- <div id="popupModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-black bg-opacity-50 hidden z-50">
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg dark:bg-gray-700">
          <div class="flex items-start justify-between p-3 border-b dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
              You might want to read this!
            </h3>
            <button id="closeModalBtn" class="text-lg ml-4 items-end">&times;</button>
          </div>
          <div class="p-4">
            <!-- Modal content goes here -->
            <div class="flex items-center space-x-2">
              <label for="avoidModalCheckbox" class="modal-checkbox-label">
                <input type="checkbox" id="avoidModalCheckbox" class="modal-checkbox"> Do not show this again
              </label>
            </div>
          </div>
        </div>
      </div>
       --}}
      
      


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    @include('components.traversechats')
</body>
</html>
