
import 'bootstrap';
import { Loader } from '@googlemaps/js-api-loader';
import axios from 'axios';

const loader = new Loader({
    apiKey: 'AIzaSyCpEj-6GoyK9TIbNYMVijvzNh_DqRsC-84', // Replace with your actual API key
    version: 'weekly',
    libraries: ['places']
});

    let map;


loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary('maps');

    const initialLatitude = parseFloat(document.getElementById('latitude').textContent);
    const initialLongitude = parseFloat(document.getElementById('longitude').textContent);

    map = new Map(document.getElementById('map'), {
        center: { lat: initialLatitude, lng: initialLongitude },
        zoom: 15
    });

    // Call the updateLocation function initially
    updateMapCenter(initialLatitude, initialLongitude);

    // Set an interval to update the location every 10 seconds
    setInterval(() => {
        const latitude = parseFloat(document.getElementById('latitude').textContent);
        const longitude = parseFloat(document.getElementById('longitude').textContent);
        updateLocation();
    }, 10000);
});

    // Get the car ID from the current URL
    var carId = document.getElementById('carId').textContent;

function updateLocation() {
    axios
        .get(`/api/car_owner/location/`+carId)
        .then(response => {
            document.getElementById('latitude').textContent = response.data.latitude;
            document.getElementById('longitude').textContent = response.data.longitude;

            updateMapCenter(response.data.latitude, response.data.longitude);
        })
        .catch(error => {
            console.error(error);
        });
}

function updateMapCenter(latitude, longitude) {
    map.setCenter({ lat: latitude, lng: longitude });
    new google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map: map,
        title: 'Car Location'
    });
}

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

