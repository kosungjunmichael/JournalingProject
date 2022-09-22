async function geocode(locationStr, lang) {
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

async function getLocations() {
    return await fetch('http://localhost/sites/JournalingProject/controller/api/getLocations.php')
        .then(res => res.json())
        .then(data => {
            console.log(data);
            return data;
        })
        .catch(err => console.log(err));
}

async function getEntriesCoordinates() {
    const coordinates = [];
    const entryLocations = await getLocations();
    console.log(entryLocations);
    for (let eL of entryLocations) {
        // console.log(location)
        const latLon = await geocode(eL.location, 'en');
        const coordObj = {
            u_id: eL.u_id,
            lat: parseFloat(latLon.lat),
            lon: parseFloat(latLon.lon)
        }
        coordinates.push(coordObj);
    }
    // console.log(coordinates);
    return coordinates;
}

async function renderMap() {
    const mapDiv = document.getElementById('map');
    const options = {
        center: new kakao.maps.LatLng(37.5665, 126.9780),
        level: 9
    };
    const map = new kakao.maps.Map(mapDiv, options);

    const markerCoordinates = await getEntriesCoordinates();
    console.log(markerCoordinates);
    for (let mC of markerCoordinates) {
        // 마커가 표시될 위치입니다
        const markerPosition  = new kakao.maps.LatLng(mC.lat, mC.lon);

        // 마커를 생성합니다
        const marker = new kakao.maps.Marker({
            map: map,
            position: markerPosition
        });
        //
        // // 마커가 지도 위에 표시되도록 설정합니다
        // marker.setMap(map);
    }
}

renderMap();
// getEntriesCoordinates();
// getLocations();
