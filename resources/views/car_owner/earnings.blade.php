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

    {{-- Flowbite Tailwind --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
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
<body class="pt-5 bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage5.jpg') }}'); min-height: 100vh;">
    <div class="pt-4 bg-cover bg-black bg-opacity-50 backdrop-blur-lg bg-center min-h-screen" style="min-height: 100vh;">
        <x-navcarowner :bookedCarsCount="$bookedCarsCount" :latestProfilePicture="$latestProfilePicture" />
 
    <div class="w-1/2 pt-8 mx-auto rounded-md"  style="background-color: #121212; max-width: 1350px;">
        <div class="flex flex-row justify-end">
        <h1 class="text-gray-300 font-extrabold text-xl mr-3">TOTAL EARNINGS: Php {{ number_format($totalRentalFee, 2) }}</h1>
        </div>
        <hr class="text-gray-500 mt-1 ">
        @if ($returnedCars->isEmpty())
            <p></p>
        @else
        <table class="text-sm text-left dark:text-blue-100 mx-auto  max-w-full xs:max-w-none sm:max-w-xs md:max-w-sm  lg:max-w-md xl:max-w-lg">
            <thead class="text-md text-center text-white uppercase dark:text-white sticky top-6 z-10" style="background-color: #121212;">
                    <tr class="border-b border-gray-500">
                        <th cope="col" class="text-gray-300 text-md font-semibold"></th>
                        <th cope="col" class="text-gray-300 text-md font-semibold px-6 py-3">Car</th>
                        <th scope="col" class="px-6 py-3">Customer</th>
                        <th scope="col" class="px-6 py-3">Earnings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($returnedCars as $returnedCar)
                        <tr class="border-b border-gray-500">
                            <th scope="row" class=" px-3 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                <img class="rounded-full w-20 h-20" src="{{ asset('storage/'.$returnedCar->car->display_picture) }}" alt="Car Image">
                            </th>
                            <td class="px-6 py-4 text-gray-500">{{ $returnedCar->car->car_brand }} {{ $returnedCar->car->car_model }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $returnedCar->customer->first_name }} {{ $returnedCar->customer->last_name }}</td>
                            <td class="px-6 py-4 text-gray-500">Php {{ number_format($returnedCar->total_rental_fee,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@include('components.traversechats')
</body>
</html>