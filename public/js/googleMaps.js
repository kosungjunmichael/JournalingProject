// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

const filteredData = Object.entries(data).filter(

	([key, value]) =>
		JSON.parse(value["lat_lng"]).lat !== "" &&
		JSON.parse(value["lat_lng"]).lng !== ""
);

const array = [];

for (const coords of filteredData) {
	const latLng = JSON.parse(coords[1]["lat_lng"]);
	if (
		array.filter((e) => e.lat === latLng.lat && e.lng === latLng.lng).length > 0
	) {
		latLng.lat +=
			Math.floor(
				Math.random() * (Math.floor(10000) - Math.ceil(-10000) + 1) +
					Math.ceil(-10000)
			) / 100000000;
		latLng.lng +=
			Math.floor(
				Math.random() * (Math.floor(10000) - Math.ceil(-10000) + 1) +
					Math.ceil(-10000)
			) / 100000000;
	}
	array.push(latLng);
}

const initMap = () => {
	// MAP CREATION
	let map = google.maps.Map;
	map = new google.maps.Map(document.getElementById("map-view-map"), {
		zoom: 14,
	});

	// INITIALIZING BOUNDS
	let bounds = new google.maps.LatLngBounds();

	// TRACKS ACTIVE INFO WINDOW
	let lastOpenIW;

	const markers = array.map((position) => {
		// INFO WINDOW CONTENT
		const contentString =
			`<div id="map-view-entry-card">` +
			`<h2 class="map-view-entry-card-title">${
				filteredData[array.indexOf(position)][1]["title"]
			}</h2>` +
			`<div class="map-view-entry-card-textContent"><p>${
				filteredData[array.indexOf(position)][1]["text_content"]
			}</p></div>` +
			`<div class="map-view-entry-card-bottom">` +
			`<span class="map-view-entry-card-location">` +
			`<i class="ph-map-pin"></i>` +
			`${filteredData[array.indexOf(position)][1]["location"]}` +
			`</span>` +
			`<span class="map-view-entry-card-date">` +
			`<i class='bx bx-calendar'></i>` +
			`${new Date(
				filteredData[array.indexOf(position)][1]["last_edited"]
			).toLocaleDateString("en-US", {
				month: "long",
				day: "numeric",
				year: "numeric",
			})}` +
			`</span>` +
			`</div>` +
			`<a class="map-view-entry-card-link" href="./index.php?action=viewEntry&id=${
				filteredData[array.indexOf(position)][1]["u_id"]
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
			title: filteredData[array.indexOf(position)][1]["title"], // For accessiblity
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
	google.maps.event.addListener(markerCluster, "click", function (cluster) {
		if (lastOpenIW !== undefined) lastOpenIW.close();
	});
};

window.initMap = initMap;

// // ESCAPING HTML TAGS
// function escapeHTML(text) {
// 	let map = {
// 		"&": "&amp;",
// 		"<": "&lt;",
// 		">": "&gt;",
// 		'"': "&quot;",
// 		"'": "&#039;",
// 	};

// 	return text.replace(/[&<>"']/g, function (m) {
// 		return map[m];
// 	});
// }

// // REMOVING HTML TAGS
// function removeTags(str) {
// 	if (str === null || str === "") return false;
// 	else str = str.toString();

// 	// Regular expression to identify HTML tags in
// 	// the input string. Replacing the identified
// 	// HTML tag with a null string.
// 	return str.replace(/(<([^>]+)>)/gi, "");
// }
