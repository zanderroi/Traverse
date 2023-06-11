import { Loader } from '@googlemaps/js-api-loader';
import axios from 'axios';

const loader = new Loader({
  apiKey: 'AIzaSyCpEj-6GoyK9TIbNYMVijvzNh_DqRsC-84', // Replace with your actual API key
  version: 'weekly',
  libraries: ['places']
});

let map;
let marker; // Global variable to store the marker instance

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
  setInterval(updateLocation, 10000);
});

// Get the car ID from the current URL
const carId = document.getElementById('carId').textContent;

function updateLocation() {
  axios
    .get(`/api/car_owner/location/${carId}`)
    .then(response => {
      const latitude = parseFloat(response.data.latitude);
      const longitude = parseFloat(response.data.longitude);

      document.getElementById('latitude').textContent = latitude;
      document.getElementById('longitude').textContent = longitude;

      updateMapCenter(latitude, longitude);
    })
    .catch(error => {
      console.error(error);
    });
}

function updateMapCenter(latitude, longitude) {
  map.setCenter({ lat: latitude, lng: longitude });

  // Remove the existing marker if it exists
  if (marker) {
    marker.setMap(null);
  }

  // Create a new marker at the updated position
  marker = new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map: map,
    title: 'Car Location'
  });
}

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

