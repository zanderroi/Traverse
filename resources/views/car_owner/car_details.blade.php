<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Traverse</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- @vite(['resources/js/car_details.js']) --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <style>
        .hover-scale:hover {
            transform: scale(1.03);
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>


<body>
    <x-navcarowner :bookedCarsCount="$bookedCarsCount" :latestProfilePicture="$latestProfilePicture" />
 
        @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('List a Car') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('car_owner.add_car_details') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- image upload field -->
                                <div class="row mb-3">
                                    <label for="display_picture" class="col-md-4 col-form-label text-md-end">{{ __('Display Picture') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="display_picture" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('display_picture') is-invalid @enderror" name="display_picture" required>
        
                                        @error('display_picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="car_brand" class="col-md-4 col-form-label text-md-end">{{ __('Car Brand') }}</label>
                                    <div class="col-md-6">
                                        <select id="car_brand" class="form-control @error('car_brand') is-invalid @enderror" name="car_brand" required autofocus>
                                            <option value="">-- Select Car Brand --</option>
                                            @foreach($carBrands as $brand)
                                                <option value="{{ $brand }}">{{ $brand }}</option>
                                            @endforeach
                                        </select>
                                        @error('car_brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="car_model" class="col-md-4 col-form-label text-md-end">{{ __('Car Model') }}</label>
                                    <div class="col-md-6">
                                        <select id="car_model" class="form-control @error('car_model') is-invalid @enderror" name="car_model" required>
                                            <option value="">-- Select Car Model --</option>
                                            @foreach($carModels as $carModel)
                                                <option value="{{ $carModel }}">{{ $carModel }}</option>
                                            @endforeach
                                        </select>
                                        @error('car_model')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
              
                                <div class="row mb-3">
                                    <label for="car_type" class="col-md-4 col-form-label text-md-end">{{ __('Car Type') }}</label>
                                    <div class="col-md-6">
                                        <input id="car_type" name="car_type" class="form-control rounded-md border-gray-200" type="text" readonly>
                                    </div>
                                </div>
                                
                                <script>
                                    var carModelsData = {!! $carModelsData !!};
                                    var carTypesData = {!! $carTypesData !!};
                                
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var carBrandDropdown = document.getElementById('car_brand');
                                        var carModelDropdown = document.getElementById('car_model');
                                        var carTypeInput = document.getElementById('car_type');
                                
                                        carBrandDropdown.addEventListener('change', function() {
                                            var selectedBrand = carBrandDropdown.value;
                                
                                            // Clear the car model dropdown and car type input
                                            carModelDropdown.innerHTML = '<option value="">Select Car Model</option>';
                                            carTypeInput.value = '';
                                
                                            // Filter the car models data based on the selected brand
                                            var filteredCarModels = carModelsData.filter(function(carModel) {
                                                return carModel.brand === selectedBrand;
                                            });
                                
                                            // Add options for the filtered car models
                                            filteredCarModels.forEach(function(carModel) {
                                                var option = document.createElement('option');
                                                option.value = carModel.model;
                                                option.textContent = carModel.model;
                                                carModelDropdown.appendChild(option);
                                            });
                                        });
                                
                                        carModelDropdown.addEventListener('change', function() {
                                            var selectedModel = carModelDropdown.value;
                                
                                            // Filter the car types data based on the selected model
                                            var filteredCarTypes = carTypesData.filter(function(carType) {
                                                return carType.model === selectedModel;
                                            });
                                
                                            // Clear the car type input
                                            carTypeInput.value = '';
                                
                                            // If there is a matching car type, update the car type input value
                                            if (filteredCarTypes.length > 0) {
                                                carTypeInput.value = filteredCarTypes[0].type;
                                            }
                                        });
                                    });
                                </script>
                                <div class="row mb-3">
                                    <label for="transmission" class="col-md-4 col-form-label text-md-end">{{ __('Transmission') }}</label>
                                    <div class="col-md-6">
                                        <select id="transmission" class="form-control @error('transmission') is-invalid @enderror" name="transmission" required>
                                            <option value="">-- Select Transmission -- </option>
                                          
                                                <option value="auto">Auto</option>
                                                <option value="manual">Manual</option>
                                           
                                        </select>
                                        @error('transmission')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                              
                                
                                
                                <div class="row mb-3">
                                    <label for="year" class="col-md-4 col-form-label text-md-end">Year</label>
                                    <div class="col-md-6">
                                        <select id="year" name="year" class="form-control @error('year') is-invalid @enderror" required>
                                            <option value="">-- Select Year --</option>
                                            @for ($i = date('Y'); $i >= 2015; $i--)
                                                <option value="{{ $i }}" @if (old('year') == $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                

                                <div class="row mb-3">
                                    <label for="seats" class="col-md-4 col-form-label text-md-end">Number of seats</label>
                                    <div class="col-md-6">
                                    <input id="seats" type="number" min="1" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control @error('seats') is-invalid @enderror" name="seats" value="{{ old('seats') }}" required autocomplete="seats" autofocus>
                            
                                    @error('seats')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                                <div class="row mb-3">
                                    <label for="plate_number" class="col-md-4 col-form-label text-md-end">{{ __('Plate Number') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="plate_number" type="text" class="form-control rounded-md border-gray-200 @error('plate_number') is-invalid @enderror" name="plate_number" value="{{ old('plate_number') }}" required autocomplete="plate_number" autofocus>
        
                                        @error('plate_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="vehicle_identification_number" class="col-md-4 col-form-label text-md-end">{{ __('Vehicle Identification Number / Chassis Number') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="vehicle_identification_number" type="text" class="form-control rounded-md border-gray-200 @error('vehicle_identification_number') is-invalid @enderror" name="vehicle_identification_number" value="{{ old('vehicle_identification_number') }}" required autocomplete="vehicle_identification_number" autofocus>
        
                                        @error('vehicle_identification_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="location" type="text" class="form-control rounded-md border-gray-200 @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required autocomplete="location" autofocus>
        
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

   
                                <!-- image upload field -->
                                <div class="row mb-3">
                                    <label for="certificate_of_registration" class="col-md-4 col-form-label text-md-end">{{ __('ORCR') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="certificate_of_registration" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('certificate_of_registration') is-invalid @enderror" name="certificate_of_registration" required>
        
                                        @error('certificate_of_registration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="car_description" class="col-md-4 col-form-label text-md-end">Car Description:</label>
                                    <div class="col-md-6">
                                    <textarea id="car_description" name="car_description" rows="4" cols="50" class="form-control @error('car_description') is-invalid @enderror" name="car_description" value="{{ old('car_description') }}" required autocomplete="car_description" autofocus></textarea>
                                        @error('car_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="rental_fee" class="col-md-4 col-form-label text-md-end">Rental Fee Per Day:</label>
                                   
                                    <div class="col-md-6">
                                        <input type="number" id="rental_fee" name="rental_fee" step="0.01" class="form-control rounded-md border-gray-200 @error('rental_fee') is-invalid @enderror" name="rental_fee" value="{{ old('rental_fee') }}" required autocomplete="rental_fee" autofocus required placeholder="Please refer to the price range guide below">
                                        @error('rental_fee')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <a href="#" class="col-md-4 text-md-end text-blue-600 hover:underline text-xs" data-bs-toggle="modal" data-bs-target="#priceRangeModal">Price Range Guide</a>
                                   <!-- Modal -->
                         
                                    <div class="modal fade" id="priceRangeModal" tabindex="-1" aria-labelledby="priceRangeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title font-bold text-lg" id="priceRangeModalLabel">Price Range Guide</h5>
                                            <button type="button" data-bs-dismiss="modal" aria-label="Close">
                                            <div class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 font-medium rounded-sm px-2 py-1 text-sm sm:w-autotext-center">X
                                            </div></button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('logo/pricelist1.png') }}" alt="Price Range Guide" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('logo/pricelist2.png') }}" alt="Price Range Guide" />
                                                </div>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                        </div>
                                </div>
                                
                                <div class="row mb-1">
                                    <label for="add_picture1" class="col-md-4 col-form-label text-md-end">{{ __('Interior View') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="add_picture1" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture1') is-invalid @enderror" name="add_picture1" required>
        
                                        @error('add_picture1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                <label for="add_picture2" class="col-md-4 col-form-label text-md-end">{{ __('Side View') }}</label>
                                    <div class="col-md-6">
                                        <input id="add_picture2" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture2') is-invalid @enderror" name="add_picture2" required>
        
                                        @error('add_picture2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="add_picture3" class="col-md-4 col-form-label text-md-end">{{ __('Back View') }}</label>
                                    <div class="mb-2 col-md-6">
                                        <input id="add_picture3" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture3') is-invalid @enderror" name="add_picture3" required>
        
                                        @error('add_picture3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="offset-md-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <button type="submit">
                                            {{ __('Add Car') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @endsection
        <main class="py-4">
            @yield('content')
            
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    @include('components.traversechats')
</body>
</html>
