@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
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
                            <label for="govtid" class="col-md-4 col-form-label text-md-end">{{ __('Government ID Number') }}</label>

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
                            <label for="govtid_image" class="col-md-4 col-form-label text-md-right block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload a photo of your Government ID') }}</label>

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
</div>

@endsection
