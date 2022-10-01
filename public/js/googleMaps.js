// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

// console.log("Original Data", data);

const convertToArray = Object.entries(data);
// console.log("Data converted to array:", convertToArray);

const filtered = convertToArray.filter(
	([key, value]) => JSON.parse(value["lat_lng"]).lat !== ""
);
// console.log("Array filtered", filtered);

let array = [],
	minLat = 0,
	minLng = 0,
	maxLat = 0,
	maxLng = 0;

for (const coords of filtered) {
	// console.log(coords[1]["lat_lng"]);
	const latLng = JSON.parse(coords[1]["lat_lng"]);
	array.push(latLng);
	if (minLat == 0 || minLat > latLng.lat) minLat = latLng.lat;
	if (maxLat == 0 || maxLat < latLng.lat) maxLat = latLng.lat;
	if (minLng == 0 || minLng > latLng.lng) minLng = latLng.lng;
	if (maxLng == 0 || maxLng < latLng.lng) maxLng = latLng.lng;
}
// console.log(array);

let midrangeLat = (minLat + maxLat) / 2;
let midrangeLng = (minLng + maxLng) / 2;

const initMap = () => {

	// MAP CREATION
	let map = google.maps.Map;
	map = new google.maps.Map(document.getElementById("map-view-map"), {
		zoom: 2,
		center: new google.maps.LatLng(midrangeLat, midrangeLng),
	});

	const markers = array.map((position) => {
		
		// INFO WINDOW CONTENT
		const contentString =
			`<div id="map-view-entry-card">` +
			`<h2 class="map-view-entry-card-title">${
				filtered[array.indexOf(position)][1]["title"]
			}</h2>` +
			`<div class="map-view-entry-card-textContent"><p>${
				filtered[array.indexOf(position)][1]["text_content"]
			}</p></div>` +
			`<div class="map-view-entry-card-bottom">` +
			`<span class="map-view-entry-card-location">` +
			`<i class="ph-map-pin"></i>` +
			`${filtered[array.indexOf(position)][1]["location"]}` +
			`</span>` +
			`<span class="map-view-entry-card-date">` +
			`<i class='bx bx-calendar'></i>` +
			`${new Date(
				filtered[array.indexOf(position)][1]["last_edited"]
			).toLocaleDateString("en-US", {
				month: "long",
				day: "numeric",
				year: "numeric",
			})}` +
			`</span>` +
			`</div>` +
			`<a class="map-view-entry-card-link" href="./index.php?action=viewEntry&id=${
				filtered[array.indexOf(position)][1]["u_id"]
			}">View Entry</a></div>`;

		// INFO WINDOW CREATION
		const infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 400,
			minWidth: 250,
		});

		// MARKER CREATION
		const marker = new google.maps.Marker({
			// position: latLng,
			position,
			map: map,
			title: filtered[array.indexOf(position)][1]["title"], // For accessiblity
			animation: google.maps.Animation.DROP,
		});

		marker.addListener("click", () => {
			infowindow.open({
				anchor: marker,
				map,
				shouldFocus: false,
			});
			marker.setAnimation(google.maps.Animation.BOUNCE);
			setTimeout(() => {
				marker.setAnimation(null);
			}, 1);
		});
		return marker;
	});

	// TODO: Markers is an array of google.maps.Markers
	const markerCluster = new markerClusterer.MarkerClusterer({ markers, map });
};

window.initMap = initMap;
