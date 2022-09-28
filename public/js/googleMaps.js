// // Initialize and add the map
// const initMap = () => {
//   // The location of Seoul
//   const seoul = { lat: 37.5665, lng: 126.9780 };
//   // The map, centered at Seoul
//   const map = new google.maps.Map(document.getElementById("map-view-map"), {
//     zoom: 11,
//     center: seoul,
//   });
//   // The marker, positioned at Uluru
//   const marker = new google.maps.Marker({
//     position: seoul,
//     map: map,
//   });
// }

// window.initMap = initMap;

let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map-view-map"), {
    zoom: 2,
    center: new google.maps.LatLng(2.8, -187.3),
    mapTypeId: "terrain",
  });

  // Create a <script> tag and set the USGS URL as the source.
  const script = document.createElement("script");

  // This example uses a local copy of the GeoJSON stored at
  // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
  script.src =
    "https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js";
  document.getElementsByTagName("head")[0].appendChild(script);
}

// Loop through the results array and place a marker for each
// set of coordinates.
const eqfeed_callback = function (results) {
  for (let i = 0; i < results.features.length; i++) {
    const coords = results.features[i].geometry.coordinates;
    const latLng = new google.maps.LatLng(coords[1], coords[0]);

    new google.maps.Marker({
      position: latLng,
      map: map,
    });
  }
  let request = {
    address: "Seoul"
  };
  new google.maps.Geocoder({
    Geocoder.geocode(request)
  });
};

window.initMap = initMap;
window.eqfeed_callback = eqfeed_callback;