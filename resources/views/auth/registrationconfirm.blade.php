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
    <body class="bg-cover"style="background-image: url('{{ asset('logo/bgimage5.jpg') }}');">
   
                    <x-nav/>
                <div class="mt-4 p-4 flex-grow bg-black bg-opacity-75 backdrop-blur-lg" style="min-height: 90vh;">

                <div class="mx-auto mt-4  w-1/2 flex flex-col shadow-md md:flex-row md:space-x-4">
                    <div class="w-full md:w-1/2 md:order-0 h-96 ">
                        <img src="{{ asset('logo/register.jpg')}}" style="width: 100%; height: 100%; object-fit: cover;" alt="Car Image"/>
        
                    </div>
                <div class="p-4 mx-auto" style="background-color:rgb(231, 231, 231); display: flex;align-items:center; justify-content:center;">
                    <h3 class="text-center font-semibold text-2xl">Thanks for joining us! Please wait for email confirmation </h3>
                </div>
            </div>
        </div>
        @include('components.footer')
    </body>
</html>
