import 'bootstrap';
import { Loader } from '@googlemaps/js-api-loader';
import axios from 'axios';

const loader = new Loader({
    apiKey: 'AIzaSyDR7M7-9pF0eh_R0z17pjnDb4El_dL3ay4', // Replace with your actual API key
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


// AIzaSyDR7M7-9pF0eh_R0z17pjnDb4El_dL3ay4
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
