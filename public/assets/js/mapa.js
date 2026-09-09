// 1. CHOOSE YOUR CIRCUMFERENCE HERE (in meters)
const targetCircumferenceMeters = 5000; 

// Calculate radius because Leaflet requires radius (Circumference = 2 * π * r)
const targetRadiusMeters = targetCircumferenceMeters / (2 * Math.PI);

// The coordinates for your marker and map center
const markerCoordinates = [38.655572, -8.184970];

// 2. Initialize map with ALL interactions disabled by default
const map = L.map('map', {
    center: markerCoordinates,
    zoom: 16,
    dragging: false,
    scrollWheelZoom: false,
    doubleClickZoom: false,
    boxZoom: false,
    touchZoom: false,
    keyboard: false
});

// Add a tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// 3. Add the Marker
const marker = L.marker(markerCoordinates).addTo(map);

// 4. Add the static Circle centered on the marker
const circle = L.circle(markerCoordinates, {
    radius: targetRadiusMeters,
    color: '#3388ff',
    fillColor: '#3388ff',
    fillOpacity: 0.2,
    weight: 2
}).addTo(map);

// 5. Handle Map Activation on Click
map.on('click', function() {
    // Enable all interactions
    map.dragging.enable();
    map.scrollWheelZoom.enable();
    map.doubleClickZoom.enable();
    map.boxZoom.enable();
    map.touchZoom.enable();
    map.keyboard.enable();
    
    // Change cursor style to indicate it's active
    document.getElementById('map').classList.add('active-map');
});