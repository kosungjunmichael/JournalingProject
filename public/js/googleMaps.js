// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

// import { MarkerClusterer } from "../../node_modules/@googlemaps/markerclusterer";

console.log(data);

const initMap = () => {
	let map = google.maps.Map;
	// let marker;
	// let markers = (google.maps.Marker = []);
	map = new google.maps.Map(document.getElementById("map-view-map"), {
		zoom: 2,
		center: new google.maps.LatLng(2.8, -187.3),
	});

	for (const coords of data) {
		console.log(coords);
		console.log(data.indexOf(coords));
		// console.log(JSON.parse(coords["lat_lng"]));
		const latLng = JSON.parse(coords["lat_lng"]);
		// console.log(latLng.lat);
		if (latLng.lat && latLng.lng) {
			// let marker = google.maps.Marker;
			// window.setTimeout(() => {

			const contentString =
				`<div id="map-view-entry-card">` +
				`<h2 class="map-view-entry-card-title">${coords["title"]}</h2>` +
				`<div class="map-view-entry-card-textContent"><p>${coords["text_content"]}</p></div>` +
				`<div class="map-view-entry-card-bottom">` +
				`<span class="map-view-entry-card-location">` +
				`<i class="ph-map-pin"></i>` +
				`${coords["location"]}` +
				`</span>` +
				`<span class="map-view-entry-card-date">` +
				`<i class='bx bx-calendar'></i>` +
				`${new Date(coords["last_edited"]).toLocaleDateString("en-US", {
					month: "long",
					day: "numeric",
					year: "numeric",
				})}` +
				`</span>` +
				`</div>` +
				`<a class="map-view-entry-card-link" href="./index.php?action=viewEntry&id=${coords["u_id"]}">View Entry</a></div>`;

			const infowindow = new google.maps.InfoWindow({
				content: contentString,
				maxWidth: 400,
				minWidth: 250,
			});

			window.setTimeout(() => {
				const marker = new google.maps.Marker({
					position: latLng,
					map: map,
					title: "Something", // For accessiblity
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
			}, data.indexOf(coords) * 400);
		}
	}
	const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
};

window.initMap = initMap;
