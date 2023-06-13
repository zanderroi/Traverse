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
   @vite(['resources/js/navbar.js'])

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>
    <style>
      body {
          overflow-x: hidden;
      }
      .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }
  </style>
</head>
<body class="pt-5 bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage7.jpg') }}'); min-height: 100vh;">
  <div class="bg-black bg-opacity-75 backdrop-blur-lg" style="min-height: 100vh; min-width: 100vh;">

      <x-navcustomer :latestProfilePicture="$latestProfilePicture" />
 
   
      
      <div class="p-3 sticky top-6 z-10" style="background-color: #0C0C0C;">
        <div class="flex flex-col sm:flex-row justify-between items-center">
          <h1 class="text-3xl font-bold pl-7 ml-4 mt-6 mb-3 mr-5 text-white">Available Cars</h1>
          <div class="flex items-end mt-4 sm:mt-0 pb-3">
            <form method="GET" action="{{ route('customer.available_cars') }}" class="flex items-center">
              <label for="location" class="sr-only">Search by Location</label>
              <div class="relative flex items-center">
                <svg aria-hidden="true" class="mt-2 ml-2 w-3 h-3 text-gray-500 dark:text-gray-400 absolute left-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="location" value="{{ $location }}" class="mt-2 h-10 px-4 py-2 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by Location">
              </div>
              <button type="submit" class="h-10 text-white bg-blue-600 hover:bg-blue-700 text-xs text-center px-2 py-2 sm:ml-0 mt-2 sm:mt-0 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Search</button>
            </form>
            
            <form action="{{ route('customer.available_cars') }}" method="GET" class="ml-4">
              <div class="form-group flex items-end">
                <select class="w-24 sm:w-32 h-10 text-xs order border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" name="sort_by_rental_fee" id="sort_by_rental_fee">
                  <option value="">Fee</option>
                  <option value="asc">Lowest to highest</option>
                  <option value="desc">Highest to lowest</option>
                </select>
                <button class="h-10 text-white bg-blue-600 hover:bg-blue-700 text-xs text-center px-2 py-1.5 sm:ml-0 mt-2 sm:mt-0 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" type="submit" onclick="updateSortBox()">Sort</button>
              </div>
            </form>
      
            <form action="{{ route('customer.available_cars') }}" method="GET">
              <!-- Your existing code -->
              
              <div class="form-group flex items-end">
                <select id="transmission" name="transmission" class="ml-3 w-24 sm:w-32 h-10 text-xs order border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                  <option value="">All</option>
                  <option value="auto">Auto</option>
                  <option value="manual">Manual</option>
                </select> 
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs py-1.5 px-2 h-10">Apply</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      
    
    
    
      
      
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif
      
          @if(session('cancelled'))
          <div class="alert alert-success mt-3">
              {{ session('cancelled') }}
          </div>
          @endif
          <div class="ml-4 pl-5 row justify-start mt-2">
            @foreach ($cars as $car)
              <div class="bg-white hover-scale hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 mt-2 mr-3 mb-4 pt-2 px-2 w-64 h-32 sm:w-64 md:w-1/3 border border-gray-200 rounded-md shadow-md dark:border-gray-700">
                <a class="hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" href="{{ route('cars.show', $car->id) }}">
                <img src="{{ asset('storage/'.$car->display_picture) }}" alt="Car Image" style="width:250px;height:150px;" />
                <div class="p-3">
                 
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>
                
                  <div class="flex items-center">
                    <p class="mb-1 mr-2 font-normal text-gray-700 dark:text-gray-400"><i class="fa-sharp fa-solid fa-calendar mr-1" style="color: #152238;"></i>{{ $car->year }}</p>              
                    <p class="mb-1 mr-2 font-normal text-gray-700 dark:text-gray-400"><i class="fa-solid fa-users mr-1" style="color: #152238;"></i>{{ $car->seats }}</p>
                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400"><i class="fa-solid fa-location-dot mr-1" style="color: #152238;"></i>{{ $car->location }}</p>
                  </div>
             
          
                <div class="flex items-center">
                @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $car->ratings)
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
                  <hr class="mt-1">
                  <p class="mt-1 font-extrabold text-xl text-black dark:text-gray-400"><i class="fa-solid fa-peso-sign mr-1 text-black"></i>{{number_format ($car->rental_fee, 2) }}</p>
                </div>
                </a>
              </div>
              @endforeach
            </div>
          
          
            
        </div>
 

    

  

<script>
function updateSortBox() {
  var sortBox = document.getElementById("sort_by_rental_fee_box");
  sortBox.innerText = "Sort by rental fee";
}
  </script>
 @include('components.traversechats')
</body>

