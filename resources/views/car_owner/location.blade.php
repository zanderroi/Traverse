@extends('layouts.app')

@section('content')
    <!-- Existing code ... -->

    <h2>Car Location</h2>
    <p>Car ID: <span id="carId">{{ $carId }} </span></p>
    <p>Latitude: <span id="latitude">{{ $latitude }}</span></p>
    <p>Longitude: <span id="longitude">{{ $longitude }}</span></p>
    <div id="map" style="height: 400px;"></div>
@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDR7M7-9pF0eh_R0z17pjnDb4El_dL3ay4"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
@endpush


{{-- AIzaSyD9lZZ2Sj40SpKMwmr6QE-Ep0TM_rZ_TrQ --}}
