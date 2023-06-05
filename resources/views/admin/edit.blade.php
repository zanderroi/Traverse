@include('components.header')
<div class="flex">
    <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center ml-4"> <i class="fa-solid fa-car mr-2"></i><a href="/cars/details">Cars</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-group mr-2"></i><a href="/owners/details"> Car Owners</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-briefcase mr-2"></i><a href="/customers/details">Customers</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-book mr-2"></i><a href="/reservation/details">Bookings</a></li>
            <li class="flex items-center ml-4"> <i class="fa-solid fa-chart-line mr-2"></i><a href="/graph">Graph</a></li>
            {{-- <li class="flex items-center ml-4"> <i class="fa-solid fa-peso-sign mr-2"></i><a href="/graph/details">Sales</a></li> --}}
          </ul>
        </div>
    </div>
    <div class="w-full" style="background-color: #E5E7EB;">
        @section('content')
      
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Car ')}}{{$car->id}}{{ __(' - Owner ')}}{{$carOwnersWithCars[0]->first_name}} {{$carOwnersWithCars[0]->last_name}}</div>
        
                        <div class="card-body">
                            <form method="POST" action="/car/{{$car->id}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                
                                <!-- image upload field -->
                                <div class="row mb-3">
                                    <label for="display_picture" class="col-md-4 col-form-label text-md-end">{{ __('Display Picture') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="display_picture" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file" name="display_picture" autocomplete="display_picture" autofocus>
        
                                        @error('display_picture')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if ($car->display_picture)
                                        <div>
                                            <img src="{{ asset('storage/'.$car->display_picture) }}" class="h-20">
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="car_brand" class="col-md-4 col-form-label text-md-end">{{ __('Car Brand') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="car_brand" type="text" class="form-control @error('car_brand') is-invalid @enderror" name="car_brand" value={{$car->car_brand}} required autocomplete="car_brand" autofocus>
        
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
                                        <input id="car_model" type="text" class="form-control @error('car_model') is-invalid @enderror" name="car_model" value={{ $car->car_model }} required autocomplete="car_model" autofocus>
        
                                        @error('car_model')
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
                                            @for ($i = date('Y'); $i >= 1900; $i--)
                                                <option value="{{ $i }}" @if ($car->year == $i) selected @endif>{{ $i }}</option>
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
                                    <input id="seats" type="number" min="1" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control @error('seats') is-invalid @enderror" name="seats" value={{$car->seats}} required autocomplete="seats" autofocus>
                            
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
                                        <input id="plate_number" type="text" class="form-control @error('plate_number') is-invalid @enderror" name="plate_number" value={{$car->plate_number}} required autocomplete="plate_number" autofocus>
        
                                        @error('plate_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="vehicle_identification_number" class="col-md-4 col-form-label text-md-end">{{ __('Vehicle Identification Number') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="vehicle_identification_number" type="text" class="form-control @error('vehicle_identification_number') is-invalid @enderror" name="vehicle_identification_number" value={{$car->vehicle_identification_number}} required autocomplete="vehicle_identification_number" autofocus>
        
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
                                        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value={{$car->location}} required autocomplete="location" autofocus>
        
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

   
                                <!-- image upload field -->
                                <div class="row mb-3">
                                    <label for="certificate_of_registration" class="col-md-4 col-form-label text-md-end">{{ __('Certificate of Registration') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="certificate_of_registration" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('certificate_of_registration') is-invalid @enderror" name="certificate_of_registration" >
        
                                        @error('certificate_of_registration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if ($car->certificate_of_registration)
                                        <div>
                                            <img src="{{ asset('storage/'.$car->certificate_of_registration) }}" alt="{{ $car->car_brand }} {{ $car->car_model }}" class="h-20">
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="car_description" class="col-md-4 col-form-label text-md-end">Car Description:</label>
                                    <div class="col-md-6">
                                        <textarea id="car_description" name="car_description" rows="4" cols="50" class="form-control @error('car_description') is-invalid @enderror" required autocomplete="car_description" autofocus>{{$car->car_description}}</textarea>
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
                                    <input type="number" id="rental_fee" name="rental_fee" step="0.01" class="form-control @error('rental_fee') is-invalid @enderror" name="rental_fee" value={{$car->rental_fee}} required autocomplete="rental_fee" autofocus required>
                                    @error('rental_fee')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="add_picture1" class="col-md-4 col-form-label text-md-end">{{ __('Additional Pictures') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="add_picture1" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture1') is-invalid @enderror" name="add_picture1">
        
                                        @error('add_picture1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if ($car->add_picture1)
                                        <div>
                                            <img src="{{ asset('storage/'.$car->add_picture1) }}" alt="{{ $car->car_brand }} {{ $car->car_model }}" class="h-20">
                                            
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-1">
                                <label for="add_picture2" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="col-md-6">
                                        <input id="add_picture2" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture2') is-invalid @enderror" name="add_picture2" >
        
                                        @error('add_picture2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if ($car->add_picture2)
                                        <div>
                                            <img src="{{ asset('storage/'.$car->add_picture2) }}" alt="{{ $car->car_brand }} {{ $car->car_model }}" class="h-20">
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="add_picture3" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>
                                    <div class="mb-2 col-md-6">
                                        <input id="add_picture3" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('add_picture3') is-invalid @enderror" name="add_picture3">
        
                                        @error('add_picture3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if ($car->add_picture3)
                                        <div>
                                            <img src="{{ asset('storage/'.$car->add_picture3) }}" alt="{{ $car->car_brand }} {{ $car->car_model }}" class="h-20">
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                
                                {{-- <div class="row mb-3">
                                    <label for="car_images" class="col-md-4 col-form-label text-md-end">Car Images:</label>
                                    <div class="col-md-6">
                                    <input type="file" id="car_images" name="car_images[]" accept="image/*" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('car_images') is-invalid @enderror" name="car_images" required>
                                    </div>
                                </div> --}}


                                
                                <div class="row mb-0">
                                    <div class="offset-md-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <button type="submit" class="w-72">
                                            {{ __('Update') }}
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

</body>
</html>
