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
<body class="pt-5">

    <div id="app">
      <nav class="border-gray-200 dark:bg-gray-900 dark:border-gray-700 w-full fixed top-0" style="background-color: #0C0C0C;">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
          <a href="#" class="flex items-center">
            <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
              <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-200 dark:text-white">Traverse</span>
          </a>
          <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          </button>
          <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <ul style="background-color: #0C0C0C;" class="flex flex-col font-medium md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              <li>
                <a href="#" class="block mb-2 py-2  pl-3 pr-4 text-blue-700 bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Rented Cars</a>
              </li>
    
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Earnings!</a>
              </li>
              <li>
                <a href="#" class="block py-2 pl-3 pr-4 text-gray-300 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">List a Car</a>
              </li>
              <li>
                <div class="mt-1">
    
                    <a href="{{ route('traverse-chats') }}" target="_blank" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Traverse Chats </a>
            </div>
        </li>
        <li>
            <div class="flex items-center ml-2 ">
                @if ($latestProfilePicture)
                <img class="block w-8 h-8 rounded-full" src="{{ asset('storage/' .$latestProfilePicture->profilepicture) }}" alt="Profile Picture">
            @else
                <img class="block w-8 h-8 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
            @endif
              <a id="navbarDropdown" class="block nav-link dropdown-toggle ml-2 text-blue-600 font-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        </div>
      </nav>

      
    </div>   

</body>
</html>