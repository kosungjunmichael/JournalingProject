// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

let map; // initializes Google map
const address = "Seoul"; // will be an array of objects of entries

const initMap = () => {
	map = new google.maps.Map(document.getElementById("map-view-map"), {
		zoom: 2,
		center: new google.maps.LatLng(2.8, -187.3),
	});

	initialize();
};

window.initMap = initMap;

const initialize = () => {
	let geocoder = new google.maps.Geocoder();

	geocoder.geocode(
		{
			address: address, // Location from entries
		},
		(results, status) => {
			if (status == google.maps.GeocoderStatus.OK) {
				// Storing Lat & Lng from address
				const latLng = {
					lat: results[0].geometry.location.lat(),
					lng: results[0].geometry.location.lng(),
				};
				console.log(latLng);

				new google.maps.Marker({
					position: latLng,
					map: map,
				});
			} else {
				alert(
					`Geocode was not successful for the following reasons: ${status}`
				);
			}
		}
	);
};
