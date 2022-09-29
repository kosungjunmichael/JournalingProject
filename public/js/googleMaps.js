// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

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
		// console.log(JSON.parse(coords["lat_lng"]));
		const latLng = JSON.parse(coords["lat_lng"]);
		// console.log(latLng.lat);
		if (latLng.lat && latLng.lng) {
			// let marker = google.maps.Marker;
			window.setTimeout(() => {
				const contentString =
					`<div class="entry-container">` +
					`<div class="entry-title" >${coords["title"]}</div>` +
					`<div class="entry-content">${coords["text_content"]}</div>` +
					`<div class="entry-info">` +
					`<div class="entry-date">` +
					`${new Date(coords["last_edited"]).toLocaleDateString("en-US", {
						month: "long",
						day: "numeric",
						year: "numeric",
					})}` +
					`</div>` +
					`</div>` +
					`</div>`;

				const infowindow = new google.maps.InfoWindow({
					content: contentString,
					// maxWidth: 200,
				});

				// markers.push("stuff");
				let marker = new google.maps.Marker({
					position: latLng,
					map: map,
					animation: google.maps.Animation.DROP,
				});

				marker.addListener("click", () => {
					infowindow.open({
						anchor: marker,
						map,
						shouldFocus: false,
					});
				});
			}, 2000);
		}
	}
};

window.initMap = initMap;
