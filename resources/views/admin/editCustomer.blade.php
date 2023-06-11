@extends('components.header')
@section('content')
<div class="flex">
    <div class="sidebar text-white w-48 pt-8" style="background-color: #0C0C0C; min-height: 100vh;">
        <div class="content-titles mt-1">
          <h2 class="text-xl font-bold mb-4 text-center"><a href="/admin/dashboard">Dashboard</a></h2>
          <ul class="space-y-8 ml-6">
            <li class="flex items-center ml-4"> <i class="fa-solid fa-user-shield mr-2"></i><a href="/admin/verification"> Account Verification</a></li>
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
<div class="container mt-8 mb-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Customer - ')}}{{$user->first_name}} {{$user->last_name}}</div>

                <div class="card-body">
                    <form method="POST" action="/customer/{{$user->id}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value={{$user->first_name}} required autocomplete="first_name" autofocus>

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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value={{$user->last_name}}  required autocomplete="last_name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value={{$user->email}}  required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value={{$user->password}}  required autocomplete="new-password" disabled>

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value={{$user->password}} required autocomplete="new-password" disabled>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address"  value="{{$user->address}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                            <input id="phone_number" type="text" name="phone_number" class="form-control" value="{{$user->phone_number}}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>
                        
                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{$user->birthday}}" required autocomplete="birthday" autofocus>
                        
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
                                <input id="govtid" type="text" class="form-control @error('govtid') is-invalid @enderror" name="govtid" value="{{$user->govtid}}" required autocomplete="govtid" autofocus>

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
                                <input id="govtid_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file @error('govtid_image') is-invalid @enderror" name="govtid_image">

                                @error('govtid_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if ($user->govtid_image)
                                <div>
                                    <img src="{{ asset('storage/'.$user->govtid_image) }}" class="h-20">
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="driverslicense" class="col-md-4 col-form-label text-md-end">{{ __('Drivers License') }}</label>

                            <div class="col-md-6">
                                <input id="driverslicense" type="text" class="form-control @error('driverslicense') is-invalid @enderror" name="driverslicense" value="{{$user->driverslicense}}" required autocomplete="driverslicense" autofocus>

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
                                <input id="driverslicense_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file  form-control-file @error('driverslicense_image') is-invalid @enderror" name="driverslicense_image">
                    
                                @error('driverslicense_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if ($user->driverslicense_image)
                                <div>
                                    <img src="{{ asset('storage/'.$user->driverslicense_image) }}" class="h-20">
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="driverslicense2_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload the back photo of your Driver\'s License') }}</label>
                    
                            <div class="col-md-6">
                                <input id="driverslicense2_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file  form-control-file @error('driverslicense2_image') is-invalid @enderror" name="driverslicense2_image">
                    
                                @error('driverslicense2_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if ($user->driverslicense2_image)
                                <div>
                                    <img src="{{ asset('storage/'.$user->driverslicense2_image) }}" class="h-20">
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="selfie_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload a photo of your Selfie') }}</label>
                    
                            <div class="col-md-6">
                                <input id="selfie_image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 form-control-file  form-control-file @error('selfie_image') is-invalid @enderror" name="selfie_image">
                    
                                @error('selfie_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if ($user->selfie_image)
                                <div>
                                    <img src="{{ asset('storage/'.$user->selfie_image) }}" class="h-20">
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contactperson1" class="col-md-4 col-form-label text-md-end">{{ __('Contact Person 1') }}</label>
    
                            <div class="col-md-6">
                                <input id="contactperson1" type="text" class="form-control @error('contactperson1') is-invalid @enderror" name="contactperson1" value="{{$user->contactperson1}}" required autocomplete="contactperson1" autofocus>
    
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
                                <input id="contactperson1number" type="text" class="form-control @error('contactperson1number') is-invalid @enderror" name="contactperson1number" value="{{$user->contactperson1number}}" required autocomplete="contactperson1number" autofocus>
    
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
                                <input id="contactperson2" type="text" class="form-control @error('contactperson2') is-invalid @enderror" name="contactperson2" value="{{$user->contactperson2}}" required autocomplete="contactperson2" autofocus>
    
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
                                <input id="contactperson2number" type="text" class="form-control @error('contactperson2number') is-invalid @enderror" name="contactperson2number" value="{{$user->contactperson2number}}" required autocomplete="contactperson2number" autofocus>
    
                                @error('contactperson2number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">{{ __('User Type') }}</label>
                            <select id="user_type" name="user_type" class="col-md-6" value="{{$user->user_type}}" disabled>
                                <option value="customer" {{$user->user_type == "customer" ? 'selected': ''}}>Customer</option>
                                <option value="car_owner" {{$user->user_type == "car_owner" ? 'selected': ''}}>Car Owner</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">I agree to the <a href="#">terms and conditions</a></label>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
</div>
</div>
@include('components.footer')
@endsection
