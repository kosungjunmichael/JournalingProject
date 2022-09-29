const geocode = async (locationStr, lang) => {
    // geocode with Kakao, korean
    if (lang === 'ko') {
        const geocoder = new kakao.maps.services.Geocoder();

        const callback = (result, status) => {
            if (status === kakao.maps.services.Status.OK) {
                // console.log(result);
                return result[0];
            }
        };

        geocoder.addressSearch(locationStr, callback);
    }
    // geocode with LocationIQ, english
    else {
        return await fetch(`https://eu1.locationiq.com/v1/search?key=pk.7f480f72d5ac6f8dc279ae25b500bf8a&q=${locationStr}&format=json`)
            .then(res => res.json())
            .then(data => {
                console.log(data[0].lat)
                const coordObj = {
                    lat: data[0].lat,
                    lon: data[0].lon
                }
                // console.log(coordObj)
                return coordObj;
            });
    }
}

const getLocations = async () => {
    return await fetch('http://localhost/sites/JournalingProject/controller/api/getLocations.php')
        .then(res => res.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(err => console.log(err));
}

const getEntries = async () => {
    const entriesArr = [];
    const entriesData = await getLocations();
    // console.log(entryLocations);
    for (let entry of entriesData) {
        // console.log(location)
        const latLon = await geocode(entry.location, 'en');
        let textContent = entry.text_content;
        if (entry.text_content.split('').length > 500){
            textContent = entry.text_content.split('').slice(0, 500).join('') + '...';
        }

        const entryObj = {
            uId: entry.u_id,
            title: entry.title,
            textContent: textContent,
            location: entry.location,
            lat: parseFloat(latLon.lat),
            lon: parseFloat(latLon.lon),
            date: `${entry.month} ${entry.day}, ${entry.year}`
        }
        entriesArr.push(entryObj);
    }
    // console.log(coordinates);
    return entriesArr;
}

const closeEntryCard = () => {
    console.log('closing');
    const entryCardToClose = document.querySelector('.map-view-card-visible');
    entryCardToClose.classList.remove('map-view-card-visible');
}

const renderMap = async () => {
    const mapDiv = document.getElementById('map-view-map');
    const options = {
        center: new kakao.maps.LatLng(37.5665, 126.9780),
        level: 9
    };
    const map = new kakao.maps.Map(mapDiv, options);

    const entries = await getEntries();

    for (let entry of entries) {
        // 마커가 표시될 위치입니다
        const markerPosition  = new kakao.maps.LatLng(entry.lat, entry.lon);

        // 마커 이미지의 이미지 크기 입니다
        const imageSize = new kakao.maps.Size(25, 37.41);
        const imageSrc = 'http://localhost/sites/JournalingProject/public/images/static/marker.png';
        // 마커 이미지를 생성합니다
        const markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

        const marker = new kakao.maps.Marker({
            map: map,
            position: markerPosition,
            image: markerImage
        });

        const entryCard = document.createElement('div');
        entryCard.classList.add('map-view-entry-card');

        const entryCardInnerHTML = `
<!--            <div id="map-view-entry-card">-->
                <svg class="map-view-entry-close" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="#000000" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none"></rect>
                    <circle class="close-svg-circle" cx="128" cy="128" r="96" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="16"></circle>
                    <line class="close-svg-line" x1="160" y1="96" x2="96" y2="160" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                    <line class="close-svg-line" x1="160" y1="160" x2="96" y2="96" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line>
                </svg>
                <h2 class="map-view-entry-card-title">${entry.title}</h2>
                <div class="map-view-entry-card-textContent"><p>${entry.textContent}</p></div>
                <div class="map-view-entry-card-bottom">
                    <span class="map-view-entry-card-location">
                        <i class="ph-map-pin"></i>
                        ${entry.location}
                    </span>
                    <span class="map-view-entry-card-date">
                        <i class='bx bx-calendar'></i>
                        ${entry.date}
                    </span>
                </div>
                <a class="map-view-entry-card-link" href="./index.php?action=viewEntry&id=${entry.uId}">View Entry</a>
<!--            </div>-->
        `

        entryCard.innerHTML = entryCardInnerHTML;

        mapDiv.appendChild(entryCard);

        kakao.maps.event.addListener(marker, 'click', function() {
            console.log('marker clicked!');
            // remove other entry cards if already opened
            const entryCardToClose = document.querySelector('.map-view-card-visible');
            if (entryCardToClose) {
                entryCardToClose.classList.remove('map-view-card-visible');
            }

            // show entry card
            entryCard.classList.add('map-view-card-visible');
            const closeBtn = document.querySelector('.map-view-card-visible > .map-view-entry-close');
            // add close event listener
            closeBtn.addEventListener('click', closeEntryCard);
        });

    }
}

renderMap();
// getEntriesCoordinates();
// getLocations();
