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
   @vite('resources/js/avatar.js')


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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
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
                        <a href="{{ route('customer.garage') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-600" aria-current="page">Garage</a>
                      </li>
                      <li>
                        <a href="{{ route('customer.history') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-600" aria-current="page">History</a>
                      </li>
                            <li>
                              <div class="flex items-center">
                                @if ($user->avatar)
                                @php
                                    $latestAvatar = $user->avatar()->latest()->first();
                                @endphp
                                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $latestAvatar->avatar) }}" alt="Profile Picture">
                            @else
                                <img class="w-8 h-8 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
                            @endif
                                <a id="navbarDropdown" class="nav-link dropdown-toggle ml-2 text-blue-600 font-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->first_name }}
                                </a>
                              
                              

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                  <a class="dropdown-item" href="{{ route('customer.profile') }}">
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

    <div class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('logo/profilebg.jpg') }}');">

        <div class="bg-cover bg-gray-400 bg-opacity-50 backdrop-blur-lg w-full h-full text-center flex justify-center items-center bg-center">

        <div class="mx-auto max-w-5xl bg-white rounded-lg shadow px-6 py-8 mt-4">
          @if(session('success'))
          <div class="alert alert-success mt-3">
              {{ session('success') }}
          </div>
      @endif
      @if(session('error'))
      <div class="alert alert-error mt-3">
          {{ session('error') }}
      </div>
      @endif
      <div class="flex justify-center border-4 border-blue-400 relative">
        <div class="border-4 border-blue-500 rounded-full relative">
          @if ($user->avatar)
          @php
              $latestAvatar = $user->avatar()->latest()->first();
          @endphp
          <img class="w-20 h-20 rounded-full" src="{{ asset('storage/' . $latestAvatar->avatar) }}" alt="Profile Picture">
      @else
          <img class="w-20 h-20 rounded-full" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
      @endif
      
          <button type="button" data-modal-target="small-modal" data-modal-toggle="small-modal" class="absolute bottom-0 right-0 bg-blue-500 rounded-full hover:bg-blue-700" style="width: 30px; height: 30px;">
            <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
          </button>
        </div>
      </div>
      
      
              
<!-- Small Modal -->
<div id="small-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal header -->

        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white align-">
                Update Profile Picture
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="small-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
          <div id="image-preview" class="flex justify-center items-center">
            @if ($user->avatar)
            @php
                $latestAvatar = $user->avatar()->latest()->first();
            @endphp
            <img class="w-20 h-20 rounded-full" id="preview-image" src="{{ asset('storage/' . $latestAvatar->avatar) }}" alt="Profile Picture">
        @else
            <img class="w-20 h-20 rounded-full" id="preview-image" src="{{ asset('avatar/default-avatar.png') }}" alt="Default Profile Picture">
        @endif
          </div>
          <div class="flex justify-center">
            <form action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <input id="image-input" type="file" class="hidden" name="avatar" accept="image/*" required>
            <label for="image-input" class="px-4 py-2 bg-gray-700 text-white rounded-lg cursor-pointer hover:bg-gray-800">
              Choose Image
            </label>
       
          </div>
        </div>
        <!-- Modal footer -->
        <div class="flex justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button id="confirm-button" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Confirm
          </button>
        </form>
        <button data-modal-hide="small-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
          Cancel
        </button>
            </div>
            </div>
            
                </div>
            </div>
              
        <div class="flex justify-center">
          <div class="text-center">
            <h2 class="text-2xl font-semibold mt-1">
              <i class="fas fa-circle text-green-500 mr-2 text-sm"></i> <!-- Online Icon -->
              {{ $user->first_name }} {{ $user->last_name }}
            </h2>
            <h2 class="text-md font-semibold mb-4 text-blue-600">{{ $user->user_type }}</h2>
          </div>
        </div>
        <div class="flex justify-center">
            <div class="w-full max-w-lg">
              <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-700 mb-2">ACCOUNT INFORMATION</h3>
                <button  data-modal-target="defaultModal" data-modal-toggle="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-2 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
              </div>
              
              <hr class="mb-4">
              <div class="w-auto mx-auto">
                <div class="flex flex-row">
                  <div class="w-full mt-2 mr-2">
                    <label class="text-left block font-medium text-gray-700" for="email">Email</label>
                    <input id="email" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->email }}" readonly>
                  </div>
                  <div class="w-full mt-2">
                    <label class="text-right block font-medium text-gray-700" for="phone">Phone Number</label>
                    <input id="phone" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->phone_number }}" readonly>
                  </div>
                </div>
                <div class="flex flex-row">
                  <div class="w-full mr-2">
                    <label class="text-left block font-medium text-gray-700 " for="address">Address</label>
                    <input id="address" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->address }}" readonly>
                  </div>
                  <div lass="w-3/4 mt-2">
                    <label class="text-right block font-medium text-gray-700" for="birthday">Birthday</label>
                    <input id="birthday" class="text-sm form-input mt-1 block w-32  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ date('F d, Y', strtotime($user->birthday)) }}" readonly>
                  </div>
                </div>
                <div class="flex flex-row">
                  <div class="w-full mr-2">
                    <label class="text-left block font-medium text-gray-700" for="drivers-license">Drivers License</label>
                    <input id="drivers-license" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->driverslicense }}" readonly>
                  </div>
                  <div class="w-full">
                    <label class="text-right block font-medium text-gray-700" for="primary-id">Primary ID</label>
                    <input id="primary-id" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->govtid }}" readonly>
                  </div>
                </div>
                <div class="flex flex-row">
                  <div class="w-full mr-2">
                    <label class="text-left block font-medium text-gray-700" for="contact-person1">Contact Person</label>
                    <input id="contact-person1" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->contactperson1 }}" readonly>
                  </div>
                  <div class="w-full">
                    <label class="text-right block font-medium text-gray-700" for="contact-person2">Contact Person</label>
                    <input id="contact-person2" class="text-sm form-input mt-1 block w-full  border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" type="text" value="{{ $user->contactperson2 }}" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
          </div>
          
          
      </div>
    </div>
</div>


{{-- Edit Profile Modal --}}
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white align-">
                <i class="fa-sharp fa-solid fa-user-pen mr-2"></i>Edit Account Information
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">


            
            
          
          </div>
          <!-- Modal footer -->
          <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
               <button data-modal-hide="defaultModal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continue</button>
            
               <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
          </div>
      
      </div>
  </div>
</body>
</html>