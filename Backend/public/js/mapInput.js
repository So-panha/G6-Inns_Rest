function initialize() {
    $('form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    const locationInputs = document.getElementsByClassName("map-input");
    const autocompletes = [];
    const geocoder = new google.maps.Geocoder();

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {

                // Get current position
                var latitude = position.coords.latitude - 0.0056923;
                var longitude = position.coords.longitude + 0.002583;

                // Retrieve current position
                let lat = latitude;
                let lng = longitude;

                for (let i = 0; i < locationInputs.length; i++) {

                    const input = locationInputs[i];
                    const fieldKey = input.id.replace("-input", "");
                    const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                    const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || lat;
                    const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || lng;

                    const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                        center: { lat: latitude, lng: longitude },
                        zoom: 13
                    });
                    const marker = new google.maps.Marker({
                        map: map,
                        position: { lat: latitude, lng: longitude },
                    });

                    marker.setVisible(isEdit);

                    const autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.key = fieldKey;
                    autocompletes.push({ input: input, map: map, marker: marker, autocomplete: autocomplete });
                }

                for (let i = 0; i < autocompletes.length; i++) {
                    const input = autocompletes[i].input;
                    const autocomplete = autocompletes[i].autocomplete;
                    const map = autocompletes[i].map;
                    const marker = autocompletes[i].marker;

                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                        marker.setVisible(false);
                        const place = autocomplete.getPlace();

                        geocoder.geocode({ 'placeId': place.place_id }, function (results, status) {
                            if (status === google.maps.GeocoderStatus.OK) {
                                const lat = results[0].geometry.location.lat();
                                const lng = results[0].geometry.location.lng();
                                setLocationCoordinates(autocomplete.key, lat, lng);
                            }
                        });

                        if (!place.geometry) {
                            window.alert("No details available for input: '" + place.name + "'");
                            input.value = "";
                            return;
                        }

                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                    });
                }

            },
            function () {
                // Handle geolocation error
                console.error('Error getting user location.');
            }
        );
    } else {
        // Geolocation is not supported by the browser
        console.error('Geolocation is not supported by this browser.');
    }

}

function setLocationCoordinates(key, lat, lng) {
    const latitudeField = document.getElementById(key + "-" + "latitude");
    const longitudeField = document.getElementById(key + "-" + "longitude");
    latitudeField.value = lat;
    longitudeField.value = lng;
}

google.maps.event.addDomListener(window, 'load', initialize);



