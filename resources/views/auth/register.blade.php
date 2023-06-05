<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Traverse</title>
        <link rel="icon" type="image/png" href="{{ asset('logo/2-modified.png') }}">
   
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
            <x-nav/>
            <div class="mx-auto w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3">
            
                
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
                                      <input name="first_name" class="@error('first_name') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="first_name" value="{{ old('first_name') }}" type="text" placeholder="Your first name" autofocus>
                                      @error('first_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                    </div>
                                  <div class="w-1/2 ml-1">
                                      <label class="block text-grey-darker text-sm font-bold mb-2" for="last_name">Last Name</label>
                                      <input name="last_name"class="@error('last_name') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="last_name" value="{{ old('last_name') }}" type="text" placeholder="Your last name" autofocus>
                                      @error('last_name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                    </div>
                              </div>
                              <div class="mb-2">
                                  <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email Address</label>
                                  <input name="email" class="@error('email') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="email" value="{{ old('email') }}" placeholder="Your email address" autofocus>
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
                                <input name="address" class="@error('address') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" value="{{ old('address') }}" id="address" type="text">
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
                                @error('birthday')
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
                            <input name="driverslicense"class="appearance-none border rounded w-full py-2 px-3 text-grey-darker @error('driverslicense') is-invalid @enderror" value="{{ old('driverslicense') }}" id="driverslicense" type="text" required>
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
                                <input name="contactperson1" class="@error('contactperson1') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="contactperson1" value="{{ old('contactperson1') }}" type="text" required autocomplete="contactperson1" autofocus>
                                @error('contactperson1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="contactperson1number">Contact Person 1 Phone Number</label>
                                <input name="contactperson1number"class="@error('contactperson1number') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" value="{{ old('contactperson1number') }}" id="contactperson1number" type="text" required autocomplete="contactperson1number" autofocus>
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
                                <input name="contactperson2" class="@error('contactperson2') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="contactperson2" value="{{ old('contactperson2') }}" type="text" required autocomplete="contactperson2" autofocus>
                                @error('contactperson2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                              </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-sm font-bold mb-2" for="contactperson2number">Contact Person 2 Phone Number</label>
                                <input name="contactperson2number" class="@error('contactperson2number') is-invalid @enderror appearance-none border rounded w-full py-2 px-3 text-grey-darker" value="{{ old('contactperson2number') }}" id="contacperson2number" type="text" required autocomplete="contactperson2number" autofocus>
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
                                <label class="form-check-label" for="terms">I agree to the <a class="text-blue-700 hover:underline" data-modal-target="small-modal" data-modal-toggle="small-modal" href="#">terms and conditions**</a></label>
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

               
                    
                    <!-- Small Modal -->
                    <div id="small-modal" tabindex="-1" class="fixed z-50 hidden h-screen mt-4 w-full items-center justify-center overflow-x-hidden inset-0">
                        <div class="w-full max-w-4xl max-h-full p-4">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-3">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-3 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-md font-medium text-gray-900 dark:text-white">
                                        Terms and Conditions
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="small-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 space-y-4">
                                    <p class="text-xs leading-relaxed text-gray-600 dark:text-gray-400">
                                        These terms and conditions ("Agreement") constitute a legally binding agreement between the car owner ("Owner") and the car renter ("Renter") for the use of the car rental web-based system ("System"). By using the System, both the Owner and Renter agree to be bound by the terms and conditions stated herein:
                                    </p>
                                    <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                        Vehicle Rental:</p>
                                    <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                        1.1 The Owner agrees to make their vehicle available for rental through the System.<br>
                                        1.2 The Renter agrees to rent the vehicle from the Owner for a specified period as agreed upon through the System.<br>
                                        1.3 The Renter acknowledges that the System is a platform for connecting Owners and Renters, and the Owner is solely responsible for the condition, maintenance, and safety of the vehicle.
                                        1.4 The Renter shall not allow the vehicle to be used outside his/her authority.<br>
                                        1.5 The Renter shall not drive or allow the vehicle to be driven by any person if at the time of driving the vehicle, the driver does not hold a current full valid driver’s license appropriate for the vehicle.<br>
                                        1.6 The Renter shall ensure that only the fuel type specified for the Vehicle will be used. (eg. Regular, Diesel, Premium)<br>
                                        1.7 The Renter shall ensure that the Vehicle is always locked and secure when it is not in use and the keys always kept under the Renter’s personal control.<br>
                                        1.8 The Renter shall ensure that any authorized driver always carries their driver’s license with them in the Vehicle and will produce it on demand to any enforcement officer.<br>
                                        1.9 The Renter shall not arrange or undertake any repairs or salvage without the Owner authority (this includes, but is not limited to, purchasing a replacement tire) except to the extent that repairs or salvage are necessary to prevent further damage to the Vehicle or to other property.<br>

                                    </p>
                                    <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                        Return of Vehicle:</p>
                                        <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">2.1 The Renter shall, at or before the expiry of the term of hire, deliver the Vehicle to the agreed rental location described in the Rental Document. If the Renter does not comply with this clause, and does not immediately return the Vehicle, the Owner may report the Vehicle as stolen to the police and the Renter must compensate the Owner for either the full cost of the Vehicle, or all additional costs and losses incurred up to the time that the Vehicle is recovered by the Owner.
                                        </p>
                                        <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                            Booking and Payment:</p>
                                            <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                                3.1 The Renter can make a booking request through the System, specifying the desired rental period.<br>
                                                3.2 The Owner needs to accept a booking request by the Renter.<br>
                                                3.3 The Renter agrees to pay the half of the full price specified in rental fees upon meeting to get the car.<br>
                                                3.4 The Owner is responsible for the fuel before the Renter get the car, and the Renter responsible for returning the car fuel full.<br>
                                                3.5 The Renter is responsible for any additional charges incurred during the rental period, such as tolls, parking fees, or any fines or penalties.
                                            </p>
                                                <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                                    Vehicle Condition and Usage:</p>     
                                                    <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                                        4.1 The Owner agrees to provide the vehicle in good working condition, properly registered, and with valid insurance coverage.<br>
                                                        4.2 The Renter agrees to return the vehicle in the same condition as received, except for ordinary wear and tear.<br>
                                                        4.3 The Renter is responsible for any damage caused to the vehicle during the rental period and agrees to inform the Owner immediately in case of an accident or damage.<br>
                                                        4.4 The Renter agrees to use the vehicle in a responsible manner, in compliance with all applicable laws and regulations, and for personal use only. The vehicle must not be used for any illegal activities, racing, or off-road purposes.
                                                        
                                                    </p> 
                                                    <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                                        Insurance and Liability:</p>  
                                                        <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                                            5.1 The Owner agrees to maintain adequate insurance coverage for the vehicle during the rental period.<br>
                                                            5.2 The Renter acknowledges that they may be liable for any damage to the vehicle not covered by insurance, up to the full value of the vehicle.<br>
                                                            5.3 The Owner and Renter agree to indemnify and hold each other harmless from any claims, liabilities, costs, or damages arising from the rental or use of the vehicle.
                                                            
                                                        </p>
                                                        <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                                            Governing Law and Dispute Resolution:</p> 
                                                            <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                                                6.1 This Agreement shall be governed by and construed in accordance with the laws of the jurisdiction where the Owner's vehicle is registered.<br>
                                                                6.2 Any disputes arising out of or in connection with this Agreement shall be resolved amicably between the Owner and Renter. If an amicable resolution cannot be reached, the parties agree to submit to the exclusive jurisdiction of the courts in the jurisdiction where the Owner's vehicle is registered.
                                                            </p> 
                                                            <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                                                Note to Owner & Renter: </p> 
                                                                <p class="text-xs leading-relaxed text-gray-500 dark:text-gray-400">
                                                                    The Owner must give the renter at least one copy of the Rental Agreement which must be kept in the vehicle throughout the term of the hire and produced on demand to an enforcement officer. <br>
                                                                    The Renter must contact the Owner for cancellation of booking providing with valid reason or vice versa. The Owner or Car Renter will then proceed to message the admin providing the conversation having the other party to agree to cancel the booking.
                                                                      
                                                                </p>
                                                                <p class="text-xs font-semibold leading-relaxed text-gray-700 dark:text-gray-400 ">
                                                                    By using the System, both the Owner and Renter acknowledge that they have read, understood, and agreed to these terms and conditions.</p> 
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="small-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                    <button data-modal-hide="small-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    


</div>
    </body>
</html>
