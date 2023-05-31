 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">

    <title>Traverse</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/js/carimage.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
     {{-- Font Awesome --}}
     <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>
    <style>
        body {
            overflow-x: hidden;
        }
        .hover-scale:hover {
            transform: scale(1.03);
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body class="pt-5 bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage5.jpg') }}'); background-repeat: repeat-y;">
    <div class="bg-cover bg-black bg-opacity-50 backdrop-blur-lg bg-center">
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
                          <a href="{{ route('car_owner.earnings') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300" aria-current="page">Earnings!</a>
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

    </div>
    
            <div class="p-2 sticky top-6 z-10" style="background-color: #0C0C0C;">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold pl-7 ml-4 mt-6 mb-3 mr-5 text-white">Listed Cars</h1>
                </div>
            </div>
            @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @endif
          
            <div class="ml-4 pl-5 flex flex-wrap justify-start mt-2">
                @foreach ($cars as $car)
                <div class="bg-white hover-scale hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 mt-2 mr-3 ml-4 mb-4 pt-2 px-2 w-64 h-96 border border-gray-200 rounded-md shadow-md dark:border-gray-700">
                    <img src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:250px;height:150px;" />
                    <div class="p-3">
                        <a class="hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" href="#">
                            <h5 class="mx-auto mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
                            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Location: {{ $car->location }}</p>
                            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Rental fee: Php{{ $car->rental_fee }}</p>
                            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">Status: {{ $car->status }}</p>
                        </a>
                        
                    </div>
    
                    <div class="flex justify-center">
                        <a href="{{ route('car_owner.location', ['carId' => $car->id]) }}" class="mr-1 block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-sm text-sm px-3 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Track</a>
                        <button data-modal-target="defaultModal{{$car->id}}" data-modal-toggle="defaultModal{{$car->id}}" type="button" class="block mr-1 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-sm text-sm px-3 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Edit Car</button>
                        <button data-modal-target="popup-modal{{$car->id}}" data-modal-toggle="popup-modal{{$car->id}}" type="button" class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:gray-red-300 font-medium rounded-sm text-sm px-3 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" @if($car->status == 'booked') disabled @endif>
                            Unlist
                        </button>
                        
                    </div>
            </div>
            {{-- Unlist Car --}}
      <div id="popup-modal{{$car->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal{{$car->id}}">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                  <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                      @if($car->status == 'booked')
                          You can't unlist this car because it is booked.
                      @else
                          Are you sure you want to unlist this car?
                      @endif
                      {{$car->car_brand}} {{$car->car_model}}
                  </h3>
                  <form action="{{ route('car_owner.delete_car', ['car_id' => $car->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button data-modal-hide="popup-modal{{$car->id}}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2" @if($car->status == 'booked') disabled @endif>
                          Yes, I'm sure
                      </button>
                      <button data-modal-hide="popup-modal{{$car->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                          No, cancel
                      </button>
                  </form>
              </div>
              
            </div>
        </div>
    </div>

{{-- Edit Car Modal --}}
<div id="defaultModal{{$car->id}}" tabindex="-1" aria-hidden="true" class="fixed top-2 left-0 right-0 z-50 hidden w-full mt-5 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="w-full max-w-2xl ">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-3 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white align-">
                <i class="fa-solid fa-car mr-2"></i></i>Edit Car Details
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal{{$car->id}}">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-3">
            <h3 class="text-lg font-bold">CAR INFORMATION</h3>
            <form action="{{ route('car_owner.update_car_details', ['car_id' => $car->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
                   
              <div class="flex flex-row">
                <div class="mr-1">
                  <label for="display_picture" class="text-xs px-2.5 py-1 bg-gray-700 text-white rounded-sm cursor-pointer hover:bg-gray-800">
                    Display Picture
                  </label>
                  <input id="display_picture" type="file" class="hidden" name="display_picture" autocomplete="display_picture" autofocus>
                  <img id="display_picture_img" src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:100px;height:50px;" />
                </div>
                <div class="mr-1">
                  <label for="add_picture1" class="text-2xs px-2.5 py-1 bg-gray-700 text-white rounded-sm cursor-pointer hover:bg-gray-800">
                    Additional Picture
                  </label>
                  <input id="add_picture1" type="file" class="hidden" name="add_picture1"  autocomplete="add_picture1" autofocus>
                  <img id="add_picture1_img" src="{{ asset('storage/'.$car->add_picture1) }}" alt="Car Image" style="width:100px;height:50px;" />
                </div>
                <div class="mr-1">
                  <label for="add_picture2" class="text-2xs px-2.5 py-1 bg-gray-700 text-white rounded-sm cursor-pointer hover:bg-gray-800">
                    Additional Picture
                  </label>
                  <input id="add_picture2" type="file" class="hidden" name="add_picture2" autocomplete="add_picture2" autofocus>
                  <img id="add_picture2_img" src="{{ asset('storage/'.$car->add_picture2) }}" alt="Car Image" style="width:100px;height:50px;" />
                </div>
                <div class="mr-1">
                  <label for="add_picture3" class="text-2xs px-2.5 py-1 bg-gray-700 text-white rounded-sm cursor-pointer hover:bg-gray-800">
                    Additional Picture
                  </label>
                  <input id="add_picture3" type="file" class="hidden" name="add_picture3" autocomplete="add_picture3" autofocus>
                  <img id="add_picture3_img" src="{{ asset('storage/'.$car->add_picture3) }}" alt="Car Image" style="width:100px;height:50px;" />
                </div>
              </div>
            <div class="flex flex-row">
              <div class="w-full mt-1 mr-2">
                <label class="text-left block font-medium text-gray-700" for="car_brand">Brand</label>
            <input id="car_brand" name="car_brand" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{$car->car_brand}}" autofocus>
               
              </div>
              <div class="w-full mt-1">
                <label class="text-left block font-medium text-gray-700" for="car_model">Model</label>
                <input id="car_model" name="car_model" type="text" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 @error('email') is-invalid @enderror" value="{{$car->car_model}}" autofocus>
              </div>
            </div>
            <div class="flex flex-row">
              <div class="w-full mt-1 mr-2">
                <label class="text-left block font-medium text-gray-700" for="year">Year</label>
                <select id="year" name="year" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" required>
                  <option value="{{$car->year}}">{{$car->year}}</option>
                  @for ($i = date('Y'); $i >= 1900; $i--)
                      <option value="{{ $i }}" @if (old('year') == $i) selected @endif>{{ $i }}</option>
                  @endfor
              </select>
              </div>
              <div class="w-full mt-1">
                <label class="text-left block font-medium text-gray-700" for="seats">Seats</label>
                <input id="seats" name="seats" type="number" min="1" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"  value="{{$car->seats}}" autofocus>
              </div>
            </div>
            <div class="flex flex-row">
              <div class="w-full mt-1 mr-2">
                <label class="text-left block font-medium text-gray-700" for="plate_number">Plate Number</label>
            <input id="plate_number" name="plate_number" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{$car->plate_number}}" autofocus>       
            </div>
            <div class="w-full mt-1 mr-2">
              <label class="text-left block font-medium text-gray-700" for="rental_fee">Rental Fee</label>
         
              <input id="rental_fee" name="rental_fee" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="number" step="0.01" value="{{$car->rental_fee}}" autofocus>       
          </div>
          </div>
          <div class="flex flex-row">
            <div class="w-full mt-1 mr-2">
              <label class="text-left block font-medium text-gray-700" for="vehicle_identification_number">Vehicle Identification Number</label>
         
              <input id="vehicle_identification_number" name="vehicle_identification_number" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{$car->vehicle_identification_number}}" autofocus>       
          </div>
          <div class="w-full mt-1 mr-2">
            <label class="text-left block font-medium text-gray-700" for="location">Location</label>
       
            <input id="location" name="location" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{$car->location}}" autofocus>       
        </div>
          
        </div>
        <div class="flex flex-row">
          <div class="w-full mt-1 mr-2">
            <label for="car_description" class="text-left block font-medium text-gray-700">Car Description:</label>
            <textarea id="car_description" name="car_description" rows="4" cols="50" class="form-control" name="car_description"  autofocus> {{$car->car_description}}</textarea>             
          </div>
      
        
      </div>
          <!-- Modal footer -->
          <div class="flex items-center p-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
               <button data-modal-hide="defaultModal{{$car->id}}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
          
               <button data-modal-hide="defaultModal{{$car->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
              </form>
              </div>
        </div>
      </div>
  </div>
</div>
            @endforeach           
        </div>
    </div>
   
      

    
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

</body>
</html>
