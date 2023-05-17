<!-- resources/views/car_owner/car_location.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Car Details</h2>
    <p>Car Brand: {{ $car->car_brand }}</p>
    <p>Car Model: {{ $car->car_model }}</p>

    <h2>Customer Details</h2>

    @if ($customer)
        <p>Name: {{ $customer->first_name }} {{ $customer->last_name }}</p>
        <p>Email: {{ $customer->email }}</p>
    @else
        <p>Customer details not available</p>
    @endif

    <h2>Booking Details</h2>

    @if ($booking)
        <p>Pickup Date and Time: {{ $booking->pickup_date_time }}</p>
        <p>Return Date and Time: {{ $booking->return_date_time }}</p>
        <p>Total Rental Fee: {{ $booking->total_rental_fee }}</p>
    @else
        <p>Booking details not available</p>
    @endif

    <h2>Car Location</h2>
    @if ($latitude && $longitude)
        <p>Latitude: {{ $latitude }}</p>
        <p>Longitude: {{ $longitude }}</p>
        <div id="map"></div>

        <script>
            // Initialize the map
            function initMap() {
                // Set the initial map options
                var mapOptions = {
                    center: { lat: {{ $latitude }}, lng: {{ $longitude }} },
                    zoom: 10
                };
        
                // Create the map object
                var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        
                // Add a marker for the car's location
                var marker = new google.maps.Marker({
                    position: { lat: {{ $latitude }}, lng: {{ $longitude }} },
                    map: map,
                    title: 'Car Location'
                });
            }
        </script>
        

        <!-- Include the Google Maps API script -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_7HQoZMwQKy1qqV59p3KiJX1iHAEqR6o&callback=initMap" async defer></script>
    @else
        <p>Location data not available</p>
    @endif
@endsection
