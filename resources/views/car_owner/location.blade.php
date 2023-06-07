<!-- resources/views/car_owner/car_location.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- Existing code ... -->

    <h2>Car Location</h2>
    <p>Latitude: <span id="latitude">{{ $latitude }}</span></p>
    <p>Longitude: <span id="longitude">{{ $longitude }}</span></p>
    <div id="map" style="height: 400px;"></div>

    <script>
        function initMap(latitude, longitude) {
            // Set the initial map options
            var mapOptions = {
                center: { lat: latitude, lng: longitude },
                zoom: 10
            };

            // Create the map object
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Add a marker for the car's location
            var marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: 'Car Location'
            });
        }

        function updateLocation(latitude, longitude) {
            // Make an AJAX request to update the location
            $.ajax({
                type: 'POST',
                url: '{{ url('/api/update-location') }}',
                data: JSON.stringify({ latitude: latitude, longitude: longitude }),
                contentType: 'application/json',
                success: function(response) {
                    // Update the latitude and longitude on the page
                    document.getElementById('latitude').textContent = response.latitude;
                    document.getElementById('longitude').textContent = response.longitude;

                    // Reload the map with the updated coordinates
                    initMap(response.latitude, response.longitude);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Initialize the map with the initial coordinates
        var initialLatitude = parseFloat(document.getElementById('latitude').textContent);
        var initialLongitude = parseFloat(document.getElementById('longitude').textContent);
        initMap(initialLatitude, initialLongitude);
    </script>


    <!-- Include the Google Maps API script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9lZZ2Sj40SpKMwmr6QE-Ep0TM_rZ_TrQ&callback=initMap" async defer></script>
@endsection


{{-- AIzaSyD9lZZ2Sj40SpKMwmr6QE-Ep0TM_rZ_TrQ --}}
