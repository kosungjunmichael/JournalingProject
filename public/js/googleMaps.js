// -----------------------------------------
// ---------------Google Maps---------------
// -----------------------------------------

console.log(data);

const initMap = () => {
	let map = google.maps.Map;
	let marker;
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
				});

				marker = new google.maps.Marker({
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
				// markers.push(
				// );
			// }, 2000);
		}
	}
};

window.initMap = initMap;

// const entryCardInnerHTML = `
// <!--            <div id="map-view-entry-card">-->
{
	/* <svg
	class="map-view-entry-close"
	xmlns="http://www.w3.org/2000/svg"
	width="192"
	height="192"
	fill="#000000"
	viewBox="0 0 256 256"
>
	<rect width="256" height="256" fill="none"></rect>
	<circle
		class="close-svg-circle"
		cx="128"
		cy="128"
		r="96"
		fill="none"
		stroke="#000000"
		stroke-miterlimit="10"
		stroke-width="16"
	></circle>
	<line
		class="close-svg-line"
		x1="160"
		y1="96"
		x2="96"
		y2="160"
		fill="none"
		stroke="#000000"
		stroke-linecap="round"
		stroke-linejoin="round"
		stroke-width="16"
	></line>
	<line
		class="close-svg-line"
		x1="160"
		y1="160"
		x2="96"
		y2="96"
		fill="none"
		stroke="#000000"
		stroke-linecap="round"
		stroke-linejoin="round"
		stroke-width="16"
	></line>
</svg>; */
}
//                 <h2 class="map-view-entry-card-title">${entry.title}</h2>
//                 <div class="map-view-entry-card-textContent"><p>${entry.textContent}</p></div>
//                 <div class="map-view-entry-card-bottom">
//                     <span class="map-view-entry-card-location">
//                         <i class="ph-map-pin"></i>
//                         ${entry.location}
//                     </span>
//                     <span class="map-view-entry-card-date">
//                         <i class='bx bx-calendar'></i>
//                         ${entry.date}
//                     </span>
//                 </div>
//                 <a class="map-view-entry-card-link" href="./index.php?action=viewEntry&id=${entry.uId}">View Entry</a>
// <!--            </div>-->`

// const contentString =
// `<div id="map-view-entry-card">` +
// `<svg class="map-view-entry-close" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="#000000" viewBox="0 0 256 256">
//                     <rect width="256" height="256" fill="none"></rect>
//                     <circle class="close-svg-circle" cx="128" cy="128" r="96" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="16"></circle>
//                     <line class="close-svg-line" x1="160" y1="96" x2="96" y2="160" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
//                     <line class="close-svg-line" x1="160" y1="160" x2="96" y2="96" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
//                 </svg>` +
// `<h2 class="map-view-entry-card-title">${coords["title"]}</h2>` +
// `<div class="map-view-entry-card-textContent"><p>${coords["text_content"]}</p></div>` +
// `<div class="map-view-entry-card-bottom">` +
// `<span class="map-view-entry-card-location">` +
// `<i class="ph-map-pin"></i>` +
// `${coords["location"]}` +
// `</span>` +
// `<span class="map-view-entry-card-date">` +
// `<i class='bx bx-calendar'></i>` +
// `${new Date(coords["last_edited"]).toLocaleDateString("en-US", {
// 						month: "long",
// 						day: "numeric",
// 						year: "numeric",
// 					})}` +
// `</span>` +
// `</div>` +
// `<a class="map-view-entry-card-link" href="./index.php?action=viewEntry&id=${coords['u_id']}">View Entry</a>`
// `</div>`;
