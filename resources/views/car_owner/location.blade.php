@extends('layouts.app')

@section('content')
    <!-- Existing code ... -->
    <div class="p-4 sticky top-0 z-10" style="background-color: #0C0C0C;">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold pl-7 ml-4 mt-6 pt-4 mb-3 mr-5 text-white">Car Location</h1>
        </div>
      </div>
    <p>Car ID: <span id="carId">{{ $carId }} </span></p>
    <p>Latitude: <span id="latitude">{{ $latitude }}</span></p>
    <p>Longitude: <span id="longitude">{{ $longitude }}</span></p>
    <div id="map" class="mx-auto" style="width:800px; height: 600px;"></div>
@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpEj-6GoyK9TIbNYMVijvzNh_DqRsC-84"></script>
    <script src="{{ asset('js/track.js') }}"></script>
@endpush


{{-- AIzaSyD9lZZ2Sj40SpKMwmr6QE-Ep0TM_rZ_TrQ --}}
