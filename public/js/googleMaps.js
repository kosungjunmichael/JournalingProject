// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

const convertToArray = Object.entries(data);

const filtered = convertToArray.filter(
	([key, value]) => JSON.parse(value["lat_lng"]).lat !== ""
);

let array = [],
	minLat = 0,
	minLng = 0,
	maxLat = 0,
	maxLng = 0;

for (const coords of filtered) {
	const latLng = JSON.parse(coords[1]["lat_lng"]);
	if (
		array.filter((e) => e.lat === latLng.lat && e.lng === latLng.lng).length > 0
	) {
		latLng.lat +=
			Math.floor(
				Math.random() * (Math.floor(10000) - Math.ceil(-10000) + 1) +
					Math.ceil(-10000)
			) / 1000000;
		latLng.lng +=
			Math.floor(
				Math.random() * (Math.floor(10000) - Math.ceil(-10000) + 1) +
					Math.ceil(-10000)
			) / 1000000;
	}
	array.push(latLng);
	if (array.includes(latLng.lat)) console.log("already");
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
		zoom: 14,
		center: new google.maps.LatLng(midrangeLat, midrangeLng),
	});

	// INITIALIZING BOUNDS
	let bounds = new google.maps.LatLngBounds();

	// TRACKS ACTIVE OPENED INFO WINDOW
	let lastOpenIW;

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
			position,
			map: map,
			title: filtered[array.indexOf(position)][1]["title"], // For accessiblity
			animation: google.maps.Animation.DROP,
		});

		marker.addListener("click", () => {
			// IF THERE IS AN ACTIVE INFO WINDOW, CLOSE IT
			if (lastOpenIW !== undefined) lastOpenIW.close();

			// ATTACHES INFO WINDOW TO MARKER
			infowindow.open({
				anchor: marker,
				map,
				shouldFocus: false,
			});

			lastOpenIW = infowindow;

			// TODO: SHORT BOUNCING ANIMATION WHEN MARKER IS CLICKED
			// marker.setAnimation(google.maps.Animation.BOUNCE);
			// setTimeout(() => {
			// 	marker.setAnimation(null);
			// }, 1);
		});

		let location = new google.maps.LatLng(position.lat, position.lng);
		bounds.extend(location);

		return marker;
	});

	map.fitBounds(bounds);
	map.setCenter(bounds.getCenter());

	// CREATES A MARKER CLUSTER IF NEEDED BASED ON CLOSELY PLACED MARKERS
	const markerCluster = new markerClusterer.MarkerClusterer({ markers, map });

	// WHEN MARKER CLUSTER IS CLICKED, CLOSE ANY ACTIVE INFO WINDOW
	google.maps.event.addListener(markerCluster, "click", function(cluster) {
		if (lastOpenIW !== undefined) lastOpenIW.close();
	})
};

window.initMap = initMap;
