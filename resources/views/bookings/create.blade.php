@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Booking') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bookings.store', $car->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="pickup_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Pickup Date and Time') }}</label>

                            <div class="col-md-6">
                                <input id="pickup_date_time" type="datetime-local" class="form-control @error('pickup_date_time') is-invalid @enderror" name="pickup_date_time" value="{{ old('pickup_date_time') }}" required autofocus>

                                @error('pickup_date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="return_date_time" class="col-md-4 col-form-label text-md-right">{{ __('Return Date and Time') }}</label>

                            <div class="col-md-6">
                                <input id="return_date_time" type="datetime-local" class="form-control @error('return_date_time') is-invalid @enderror" name="return_date_time" value="{{ old('return_date_time') }}" required>

                                @error('return_date_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

    

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Book') }}
                                </button>
                                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary ml-4">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
