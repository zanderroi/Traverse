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
        /* Scale effect on hover */
        .hover-scale:hover {
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }

            </style>

    </head>
    <body>
            <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top border-bottom" style="background-color: #0C0C0C;">
                <div class="container">
                    <a class="navbar-brand flex items-center" href="#">
                        <img src="{{ asset('logo/2-modified.png') }}" class="h-8 mr-3 " alt="Traverse Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Traverse</span>
                    </a>
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button> 
    
                    
                    <div id="navbarSupportedContent">
    
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                           
                                <a href="{{ route('faq') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> FAQ </a>
                          
                          
                                <a href="{{ route('ourteam') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600"> Our Team</a>
                                <a href="{{ route('register') }}" class="font-bold mr-3 block py-2 pl-3 pr-4 text-gray-300 hover:text-blue-600">Register</a>
                                           
    

                                <div class="sm:fixed sm:top-0 sm:right-0 text-right ml-6">

                                        <a href="{{ route('contact') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Contact Us! </a>
                                </div>
                       

    
                        </ul>
                    
                </div>
            </nav>
<div class="mt-2 pt-4">
    <div class="pt-4 flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 h-screen bg-cover bg-center pt-2 hidden md:block" style="background-image: url('{{ asset('logo/bgimage6.jpg') }}');">
        </div>
        <div class="mx-auto w-full md:w-1/2 text-center justify-center items-center h-screen" style="background-color: #121212;">
            <div class="mt-5 pt-4">
                <h1 class="text-2xl pt-4 text-center font-normal text-gray-300 mb-2">Log in to continue</h1>
                <div class=" row justify-content-center w-full text-center justify-center items-center">
             
        
                <div class="h-80 w-1/2 flex justify-center items-center" style="background-color: #1c1b1b;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                
                        <div class="text-left">
                          
                
                            <div>
                                <input id="email" type="email" class="text-sm mb-1 rounded-md form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                
                        <div class="text-left">
                           
                
                            <div>
                                <input id="password" type="password" class="mt-2 text-sm rounded-md form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                
                        <div>
                            <div class="text-left mt-1 text-gray-300 ">
                                <div class="form-check">
                                    <input class="form-check-input mt-1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                
                        <div>
                            
                                <button type="submit" class="block w-full mt-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    {{ __('Login') }}
                                </button>
                
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-left pt-2 mb-3" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                             <hr class="text-gray-200">

                             <a href="{{ route('register') }}">
                             <button type="button" class="block w-full mt-3 text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ __('Create an Account') }}
                            </button>
                            </a>
                        </div>
                    </form>
                </div>
                
                    </div>
                </div>
            </div>
        </div>
        </div>

    </body>
    </html>