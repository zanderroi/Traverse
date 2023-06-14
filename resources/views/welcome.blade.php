<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Traverse</title>
        <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">
        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
         <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        {{-- Flowbite Tailwind --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

          {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/57a798c9bb.js" crossorigin="anonymous"></script>

        <style>
                body {
          overflow-x: hidden;
      }
            @font-face {
        font-family: 'Bebas Neue';
        src: url('path/to/BebasNeue.woff2') format('woff2'),
             url('path/to/BebasNeue.woff') format('woff');
        /* Add more font formats (e.g., ttf, svg) if needed */
    }

    /* Apply the font to the desired elements */
    h1, h3 {
        font-family: 'Bebas Neue', sans-serif;
        text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.5);
        animation: slideFromRight 1s ease-in-out;
       
    }
    @keyframes slideFromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

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
        /* Scale effect on hover */
        .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }

            </style>

    </head>
    <body>
   
                    <x-nav/>
                    <div class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('logo/welcome2.png') }}');">
                        <div class="ml-4 pl-4 w-full h-screen flex flex-col justify-end items-start">
                            <h1 class="text-white font-normal text-7xl shadow-sm">UNLOCK YOUR JOURNEYS WITH US!</h1>
                            <h3 class="text-white font-normal text-5xl ">FIND THE PERFECT CAR FOR WHAT YOU NEED</h3>
                            <h3 class="text-white font-normal text-5xl pb-6 mb-4">TODAY.</h3>
                        </div>
                    </div>
                    
            <div class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('logo/bgimage3.jpg') }}');">
                <div class="bg-cover bg-gray-400 bg-opacity-50 backdrop-blur-lg w-full h-full text-center flex justify-center items-center bg-center">
                <div class="text-center">
                  <h1 class="text-8xl sm:text-6xl lg:text-7xl font-bold mb-4 text-gray-900">Traverse</h1>
                  <p id="typing-effect" class="text-4xl sm:text-3xl lg:text-4xl text-gray-900"></p>
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

    <div class="h-screen bg-cover bg-center" id="next-div" style="background-image: url('{{ asset('logo/bgimage4.jpg') }}');">
        <div class="bg-cover bg-gray-400 bg-opacity-50 backdrop-blur-lg w-full bg-center" style="min-height: 100vh;">

            <h1 class="pt-20 text-4xl font-semibold text-center">Available Cars!</h1>
            <div class="ml-6 row justify-content-start mt-3 pt-4 h-96">
                @foreach ($cars as $car)
                <div class="hover-scale bg-white hover:bg-blue-500 dark:bg-gray-800 dark:hover:bg-gray-700 left-1 mt-2 mr-3 ml-6 mb-4 pt-2 px-2 w-64 h-32 border border-gray-200 rounded-lg shadow-md dark:border-gray-700" style="background-image: url('{{ asset('storage/'.$car->display_picture) }}'); background-size: cover; background-position: center;">
                    <div class="p-1 text-center bg-gray-100">
                        <a class="hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700" href="{{ Auth::check() ? (Auth::user()->user_type === 'customer' ? '/customer/dashboard' : '/car_owner/dashboard') : '/login' }}">
                            <h5 class="text-xl font-bold text-gray-900 dark:text-white">{{ $car->car_brand }} - {{ $car->car_model }}</h5>               
                        </a>
                    </div>
                </div>
                
            @endforeach
        </div>
        
        </div>
    </div>
    <script>
        const scrollToNext = document.getElementById("scroll-to-next");
        const nextDiv = document.getElementById("next-div");
    
        scrollToNext.addEventListener("click", () => {
            nextDiv.scrollIntoView({ behavior: "smooth" });
        });
    </script>
    @include('components.footer')
    </body>
</html>
