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
    <body class="pt-5 bg-cover bg-center" style="background-image: url('{{ asset('logo/bgimage7.jpg') }}');">
        <div class="bg-black bg-opacity-75 backdrop-blur-lg">
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
                            

                                <div class="sm:fixed sm:top-0 sm:right-0 text-right ml-6">

                                        <a href="{{ route('contact') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Contact Us! </a>
                                </div>
                       

    
                        </ul>
                    
                </div>
            </nav>
            <div class="mx-auto  w-1/2">
            
                
                <!-- Content -->
                <div class="w-full bg-grey-lightest" style="padding-top: 1rem;">
                  <div class="container mx-auto py-8">
                    <div class="w-5/6 lg:w-1/2 mx-auto bg-white rounded shadow">
                          <div class="py-4 px-8 text-black text-xl border-b border-grey-lighter">Register for a free account</div>
                          <div class="py-4 px-8">
                              <div class="flex mb-2">
                                  <div class="w-1/2 mr-1">
                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                      <label class="block text-grey-darker text-sm font-bold mb-2" for="first_name">First Name</label>
                                      <input name="first_name" class="@error('first_name') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="first_name" type="text" placeholder="Your first name" autofocus>
                                      @error('first_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                    </div>
                                  <div class="w-1/2 ml-1">
                                      <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">Last Name</label>
                                      <input name="last_name"class="@error('last_name') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="last_name" type="text" placeholder="Your last name" autofocus>
                                      @error('last_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                    </div>
                              </div>
                              <div class="mb-2">
                                  <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email Address</label>
                                  <input name="email" class="@error('email') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="email" placeholder="Your email address" autofocus>
                                  @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                </div>
                              <div class="flex mb-2">
                              <div class="w-1/2 mr-1">
                                  <label class="block text-grey-darker text-sm font-bold mb-2" for="password">Password</label>
                                  <input name="password" class="@error('password') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="password" type="password" placeholder="Your secure password" required autocomplete="new-password" autofocus>
                                  <p class="text-grey text-xs mt-1">At least 8 characters</p>
                                  @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                                </div>
                                  <div class="w-1/2 ml-1">
                                  <label class="block text-grey-darker text-sm font-bold mb-2" for="password-confirm">Confirm Password</label>
                                  <input name="password_confirmation"class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="password-confirm" type="password" placeholder="Your secure password" required autocomplete="new-password">
                                  </div>
                              
                            </div>
                            <div class="mb-2">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="address">Address</label>
                                <input name="address" class="@error('address') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="address" type="text">
                                @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                            <div class="flex mb-2">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="phone_number">Phone Number</label>
                                <input name="phone_number" class="@error('phone_number') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="phone_number" type="text" placeholder="+639" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="birthday">Birthday</label>
                                <input name="birthday" id="birthday" type="date" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" >
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="govtid">Primary ID Number</label>
                                <input name="govtid" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('govtid') is-invalid @enderror" name="govtid" value="{{ old('govtid') }}" id="govtid" type="text" required autocomplete="govtid">
                                @error('govtid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="govtid_image">Upload Primary ID Image</label>
                                <input name="govtid_image" id="govtid_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('govtid_image') is-invalid @enderror" name="govtid_image" required>

                                @error('govtid_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="driverslicense">Drivers License</label>
                            <input name="driverslicense"class="appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('driverslicense') is-invalid @enderror" id="driverslicense" type="text" required>
                            @error('driverslicense')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="driverslicense_image">Drivers License Front Photo</label>
                                <input name="driverslicense_image" id="driverslicense_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('driverslicense_image') is-invalid @enderror" name="driverslicense_image" required>
                                @error('driverslicense_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="driverslicense2_image">Drivers License Back Photo</label>
                                <input name="driverslicense2_image" id="driverslicense2_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('driverslicense2_image') is-invalid @enderror" name="driverslicense2_image" required>

                                @error('driverslicense2_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="block text-grey-darker text-sm font-bold mb-2" for="selfie_image">Upload a clear selfie photo</label>
                            <input name="selfie_image" id="selfie_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('selfie_image') is-invalid @enderror" name="selfie_image" required>

                            @error('selfie_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="flex mb-2">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="contactperson1">Contact Person 1</label>
                                <input name="contactperson1" class="@error('contactperson1') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="contactperson1" type="text" required autocomplete="contactperson1" autofocus>
                                @error('contactperson1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="contactperson1number">Contact Person 1 Phone Number</label>
                                <input name="contactperson1number"class="@error('contactperson1number') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="contactperson1number" type="text" required autocomplete="contactperson1number" autofocus>
                                @error('contactperson1number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
                        </div>
                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="contactperson2">Contact Person 2</label>
                                <input name="contactperson2" class="@error('contactperson2') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="contactperson2" type="text" required autocomplete="contactperson2" autofocus>
                                @error('contactperson2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="contactperson2number">Contact Person 2 Phone Number</label>
                                <input name="contactperson2number" class="@error('contactperson2number') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="contacperson2number" type="text" required autocomplete="contactperson2number" autofocus>
                                @error('contactperson2number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="user_type" class="block text-grey-darker text-sm font-bold mb-2">{{ __('User Type') }}</label>
                            <select id="user_type" name="user_type" class="appearance-none border rounded w-full py-2 px-3 text-grey-darker">
                                <option value="customer">Customer</option>
                                <option value="car_owner">Car Owner</option>
                                {{-- <option value="admin">Admin</option> --}}
                            </select>
                        </div>
                        <div class="w-full">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">I agree to the <a class="text-blue-700 hover:underline"href="#">terms and conditions**</a></label>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <p>
                                <a href="{{ route('login') }}" class="text-blue-700 ml-6 font-semibold text-md no-underline hover:underline">I already have an account</a>
                            </p>

                            <div class="flex justify-center items-center">
    
                                    <button type="submit" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        {{ __('Register') }}
                                    </button>
                                </form>
                            </div>
                           
                        </div>
                            
                          </div>
                          
                      </div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                            <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                            <input id="phone_number" type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>
                        
                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>
                        
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                    
            
                        <div class="row mb-3">
                            <label for="govtid" class="col-md-4 col-form-label text-md-end">{{ __('Primary ID Number') }}</label>

                            <div class="col-md-6">
                                <input id="govtid" type="text" class="form-control @error('govtid') is-invalid @enderror" name="govtid" value="{{ old('govtid') }}" required autocomplete="govtid" autofocus>

                                @error('govtid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Government ID image upload field -->
                        <div class="row mb-3">
                            <label for="govtid_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload a photo of your Primary ID') }}</label>

                            <div class="col-md-6">
                                <input id="govtid_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('govtid_image') is-invalid @enderror" name="govtid_image" required>

                                @error('govtid_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="driverslicense" class="col-md-4 col-form-label text-md-end">{{ __('Drivers License') }}</label>

                            <div class="col-md-6">
                                <input id="driverslicense" type="text" class="form-control @error('driverslicense') is-invalid @enderror" name="driverslicense" value="{{ old('driverslicense') }}" required autocomplete="driverslicense" autofocus>

                                @error('driverslicense')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="driverslicense_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload a photo of your Driver\'s License') }}</label>
                    
                            <div class="col-md-6">
                                <input id="driverslicense_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file  form-control-file @error('driverslicense_image') is-invalid @enderror" name="driverslicense_image" required>
                    
                                @error('driverslicense_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="driverslicense2_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload the back photo of your Driver\'s License') }}</label>
                    
                            <div class="col-md-6">
                                <input id="driverslicense2_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file  form-control-file @error('driverslicense2_image') is-invalid @enderror" name="driverslicense2_image" required>
                    
                                @error('driverslicense2_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="selfie_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload a photo of your Selfie') }}</label>
                    
                            <div class="col-md-6">
                                <input id="selfie_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file  form-control-file @error('selfie_image') is-invalid @enderror" name="selfie_image" required>
                    
                                @error('selfie_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contactperson1" class="col-md-4 col-form-label text-md-end">{{ __('Contact Person 1') }}</label>
    
                            <div class="col-md-6">
                                <input id="contactperson1" type="text" class="form-control @error('contactperson1') is-invalid @enderror" name="contactperson1" value="{{ old('contactperson1') }}" required autocomplete="contactperson1" autofocus>
    
                                @error('contactperson1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="contactperson1number" class="col-md-4 col-form-label text-md-end">{{ __('Contact Person 1 Phone Number') }}</label>
    
                            <div class="col-md-6">
                                <input id="contactperson1number" type="text" class="form-control @error('contactperson1number') is-invalid @enderror" name="contactperson1number" value="{{ old('contactperson1number') }}" required autocomplete="contactperson1number" autofocus>
    
                                @error('contactperson1number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contactperson2" class="col-md-4 col-form-label text-md-end">{{ __('Contact Person 2') }}</label>
    
                            <div class="col-md-6">
                                <input id="contactperson2" type="text" class="form-control @error('contactperson2') is-invalid @enderror" name="contactperson2" value="{{ old('contactperson2') }}" required autocomplete="contactperson2" autofocus>
    
                                @error('contactperson2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="contactperson2number" class="col-md-4 col-form-label text-md-end">{{ __('Contact Person 2 Phone Number') }}</label>
    
                            <div class="col-md-6">
                                <input id="contactperson2number" type="text" class="form-control @error('contactperson2number') is-invalid @enderror" name="contactperson2number" value="{{ old('contactperson2number') }}" required autocomplete="contactperson2number" autofocus>
    
                                @error('contactperson2number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>
                            <select id="user_type" name="user_type" class="col-md-6">
                                <option value="customer">Customer</option>
                                <option value="car_owner">Car Owner</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">I agree to the <a href="#">terms and conditions</a></label>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
</div>
    </body>
</html>
