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
  
        /* Scale effect on hover */
        .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }

            </style>

    </head>
    <body class="pt-5 bg-cover bg-center" style="background-color: #d7d7d7;;">
      
            <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top" style="background-color: #0C0C0C;">
                <div class="container">
                    <a class="navbar-brand flex items-center" href="{{ route('welcome') }}">
                        <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Traverse</span>
                    </a>
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> 
    
                    
                    <div id="navbarSupportedContent">
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                           
                                <a href="{{ url('faq/') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> FAQ </a>
                          
                          
                                <a href="#" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> Our Team</a>
                           
                                @if (Route::has('login'))
                                
                                        @auth
                                            <a href="{{ Auth::user()->user_type === 'customer' ? '/customer/dashboard' : (Auth::user()->user_type === 'car_owner' ? '/car_owner/dashboard' : '/admin/dashboard') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Home</a>
                                        @else
                                            <a href="{{ route('login') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Log in</a>
                    
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Register</a>
                                            @endif
                                        @endauth
                                    
                                @endif

                                <div class="sm:fixed sm:top-0 sm:right-0 text-right ml-6">

                                        <a href="{{ route('contact') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Contact Us! </a>
                                </div>
                        </ul>        
                </div>
            </div>
            </nav>
            
            {{-- Main Content --}}

            <div class="pt-5 pb-5 mx auto h-32" style="background-color: #0C0C0C;">
                <h2 class="ml-4 text-4xl font-semi-bold text-white text-center">Meet Our Team</h2>
            </div>

            <div class="pt-4 flex flex-wrap justify-center">
                <div class="mb-2 hover-scale w-64 mr-6 bg-gray-600 rounded-lg shadow-md flex flex-col items-center" style="height: 500px; background-color: #ffffff;">
                    <img class="mt-5 rounded-full border-2 border-blue-600" src="{{ asset('team/zander.jpg')}}" alt="Zander Roi Tabelona" style="width: 150px; height:150px;">
                    <h3 class="pt-2 text-lg font-bold text-blue-600"> Zander Roi Tabelona</h3>
                    <h4 class="text-md font-semibold text-gray-600"> Full-Stack Developer</h4>
                    <div class="h-64">
                    <p class="text-center p-3 text-sm font-normal text-gray-500">I am a skilled and passionate full-stack developer with expertise in both front-end and back-end web development. With a strong foundation in HTML, CSS, PHP and JavaScript, I create engaging and intuitive user interfaces that deliver exceptional user experiences.</p>
                    </div>
                    <div class="pb-4 flex flex-row justify-center space-x-3">
                        <a href="http://www.facebook.com/zndrroi" class="text-blue-700" target=”_blank” >
                            <i class="fa-brands fa-facebook fa-xl"></i></a>
                            
                        <a href="http://www.instagram.com/zndrroi" class="text-red-500" target=”_blank”>
                            <i class="fa-brands fa-instagram fa-xl"></i></a>
                            <a href="https://www.linkedin.com/in/zndrroi/" class="text-blue-900" target=”_blank”>
                                <i class="fa-brands fa-linkedin fa-xl"></i></a>
                        </div>
                </div>
                <div class="mb-2 hover-scale w-64 h-96 mr-6 bg-gray-600 rounded-lg shadow-md flex flex-col items-center" style="height: 500px; background-color: #ffffff;">
                    <img class="mt-5 rounded-full border-2 border-blue-600" src="{{ asset('team/ian.jpg')}}" alt="Ian Mark Casoy" style="width: 150px; height:150px;">
                    <h3 class="pt-2 text-lg font-bold text-blue-600"> Ian Mark Casoy</h3>
                    <h4 class="text-md font-semibold text-gray-600"> Front-End Developer</h4>
                    <div class="h-64">
                    <p class="text-center p-3 text-sm font-normal text-gray-500">I'm a highly skilled front-end developer with a passion for creating engaging and user-friendly web experiences. With expertise in front-end technologies and a keen eye for design.
                    </p>
                </div>
                    <div class="pb-4 flex flex-row justify-center space-x-3">
                        <a href="https://www.facebook.com/dabidapdapp" class="text-blue-700" target=”_blank” >
                            <i class="fa-brands fa-facebook fa-xl"></i></a>
                            
                        <a href="https://www.instagram.com/dabidapdapp" class="text-red-500" target=”_blank”>
                            <i class="fa-brands fa-instagram fa-xl"></i></a>
                            <a href="https://www.linkedin.com/in/ian-mark-casoy-537544256" class="text-blue-900" target=”_blank”>
                                <i class="fa-brands fa-linkedin fa-xl"></i></a>
                        </div>
                </div>
                <div class="mb-2 hover-scale w-64 h-96 mr-6 bg-gray-600 rounded-lg shadow-md flex flex-col items-center" style="height: 500px; background-color: #ffffff;">
                    <img class="mt-5 rounded-full border-2 border-blue-600" src="{{ asset('team/czy.jpg')}}" alt="Czyrill Joy Joble" style="width: 150px; height:150px;">
                    <h3 class="pt-2 text-lg font-bold text-blue-600"> Czyrill Joy Joble</h3>
                    <h4 class="text-md font-semibold text-gray-600"> UI/UX Designer</h4>
                    <div class="h-64">
                    <p class="text-center p-3 text-sm font-normal text-gray-500">I am a talented and dedicated UI/UX Designer with a passion for creating visually appealing and user-friendly interfaces. With a solid understanding of design principles and a keen eye for detail, I strive to deliver exceptional user experiences that align with the client's goals.
                    </p>
                </div>
                    <div class="pb-4 flex flex-row justify-center space-x-3">
                        <a href="https://www.facebook.com/czyrilljoy.cachapero?mibextid=ZbWKwL" class="text-blue-700" target=”_blank” >
                            <i class="fa-brands fa-facebook fa-xl"></i></a>
                            
                        <a href="https://instagram.com/itssmeecyy?igshid=MzNlNGNkZWQ4Mg==" class="text-red-500" target=”_blank”>
                            <i class="fa-brands fa-instagram fa-xl"></i></a>
                            <a href="https://www.linkedin.com/in/czyrill-joy-joble-871358256" class="text-blue-900" target=”_blank”>
                                <i class="fa-brands fa-linkedin fa-xl"></i></a>
                        </div>
                </div>
                <div class="mb-2 hover-scale w-64 h-96 mr-6 bg-gray-600 rounded-lg shadow-md flex flex-col items-center" style="height: 500px; background-color: #ffffff;">
                    <img class="mt-5 rounded-full border-2 border-blue-600" src="{{ asset('team/jhonnel.jpg')}}" alt="Jhonnel Baron" style="width: 150px; height:190px;">
                    <h3 class="pt-2 text-lg font-bold text-blue-600"> Jhonnel Baron</h3>
                    <h4 class="text-md font-semibold text-gray-600"> Back-End Developer</h4>
                    <div class="h-64">
                    <p class="text-center p-3 text-sm font-normal text-gray-500">A skilled backend developer and debugging expert. With a background in HTML, CSS, JavaScript, and PHP. My expertise lies in translating design concepts into functional web applications and ensuring smooth operation through effective debugging.
                    </p>
                </div>
                    <div class="pb-4 flex flex-row justify-center space-x-3">
                        <a href="https://www.facebook.com/trafalgar.nhel/" class="text-blue-700" target=”_blank” >
                            <i class="fa-brands fa-facebook fa-xl"></i></a>
                            
                        <a href="https://www.instagram.com/astersk.n/" class="text-red-500" target=”_blank”>
                            <i class="fa-brands fa-instagram fa-xl"></i></a>
                            <a href="https://www.linkedin.com/in/jhonnel-baron-17b234267/" class="text-blue-900" target=”_blank”>
                                <i class="fa-brands fa-linkedin fa-xl"></i></a>
                        </div>
                </div>
            </div>

  
    </body>
</html>