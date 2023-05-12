<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Traverse</title>
        <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">
        <link rel="stylesheet" href="css/styles.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
         <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        {{-- Flowbite Tailwind --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

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

            </style>

    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
                <div class="container">
                    <a class="navbar-brand flex items-center" href="#">
                        <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Flowbite Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Traverse</span>
                    </a>
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> 
    
                    
                        <!-- Left Side Of Navbar -->
                       <ul class="navbar-nav me-auto">
    
                        </ul> 
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <div class="sm:fixed sm:top-0 sm:right-0 text-right mr-6 mt-1.5">
                                <a href="#" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"> FAQ </a>
                            </div>
                            <div class="sm:fixed sm:top-0 sm:right-0 text-right mr-6 mt-1.5">
                                <a href="#" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"> About</a>
                            </div>
                           
                                @if (Route::has('login'))
                                    <div class="sm:fixed sm:top-0 sm:right-0 text-right mt-1.5">
                                        @auth
                                            <a href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                                        @else
                                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                            @endif
                                        @endauth
                                    </div>
                                @endif

                                <div class="sm:fixed sm:top-0 sm:right-0 text-right ml-3">
                                    <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Contact Us! </button>
                       

    
                        </ul>
                    
                </div>
            </nav>
    
        </div>
    

        
            <div class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('logo/bgimage3.jpg') }}');">
                <div class="bg-cover bg-gray-400 bg-opacity-50 backdrop-blur-lg w-full h-full text-center flex justify-center items-center bg-center">
                <div class="text-center">
                  <h1 class="text-8xl sm:text-6xl lg:text-7xl font-bold mb-4 text-gray-900">Traverse</h1>
                  <h3 id="typing-effect" class="text-4xl sm:text-3xl lg:text-4xl text-gray-900"></h3>
                  <script>
                    const text = "Find the right car for you";
                    let index = 0;
    
                    function typingEffect() {
                    document.getElementById("typing-effect").innerHTML += text.charAt(index);
                    index++;
                    setTimeout(typingEffect, 55);
                    }
                    typingEffect();
    
                    </script>

                  <button id="scroll-to-next" type="button" class="mt-3 border-gray-900 border-2 rounded-full p-2 animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                  </button>
                    
                </div>
    
            
              </div>
        </div>
            

    <hr>

    <div class="h-screen">
        <h1 class="text-6xl">Next</h1>
    </div>
    </body>
</html>
