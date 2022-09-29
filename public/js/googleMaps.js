// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

console.log(data);

let map; // initializes Google map

const initMap = () => {
	map = new google.maps.Map(document.getElementById("map-view-map"), {
		zoom: 2,
		center: new google.maps.LatLng(2.8, -187.3),
	});

	for (const coords of data) {
		const latLng = JSON.parse(coords["lat_lng"]);
		new google.maps.Marker({
			position: latLng,
			map: map,
		});
	}
};

window.initMap = initMap;
