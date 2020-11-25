{{-- <div id="map"></div> --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtygZ5JPTLgwFLA8nU6bb4d_6SSLlTPGw&callback=initMap&libraries=places"> </script>
<script>
    var marker;
    var geocoder;
    function initMap(l=23.811273,g=90.404240,z=5) {
        var latlng = new google.maps.LatLng(l,g);
        geocoder = new google.maps.Geocoder();
        geoFormatedAddress(latlng);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: z,
            center: latlng,
        });
        const autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('searchTextField')),
            {types: ['geocode']}
        );
        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            initMap(place.geometry.location.lat(),place.geometry.location.lng(),18);
        });
        marker = new google.maps.Marker({
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: latlng,
            // icon: image
        });
        marker.setMap(map);
        marker.addListener('dragend', SetLatLngValue);
        // Zoom to 9 when clicking on marker
        google.maps.event.addListener(marker,'click',function() {
            map.setZoom(9);
            map.setCenter(marker.getPosition());
        });
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
            geoFormatedAddress(marker.getPosition());
        });
    }
    function getLocation(){
        if(navigator.geolocation){
            // timeout at 60000 milliseconds (60 seconds)
            var options = {timeout:60000};
            navigator.geolocation.getCurrentPosition
            (showLocation, errorHandler, options);
        } else{
            alert("Sorry, browser does not support geolocation!");
        }
    }
    function showLocation(position) {
        var newAdd = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        geoFormatedAddress(newAdd);
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        initMap(latitude,longitude,18);
    }
    function errorHandler(err) {
        if(err.code == 1) {
            alert("Error: Access is denied!");
        } else if( err.code == 2) {
            alert("Error: Position is unavailable!");
        }
    }
    function SetLatLngValue() { //set input field for lat & lng
        geoFormatedAddress(marker.getPosition());        
    }
    function geoFormatedAddress(position){
        geocoder.geocode({
            latLng: position
        }, function(responses) {
            if (responses && responses.length > 0) {
                updateAutoCompeleteAddress(responses[0].formatted_address);
            } else {
            updateAutoCompeleteAddress('Cannot determine address at this location.');
            }
        });
        // console.log(position.lat()+" "+position.lng());
        $('#lat').val(position.lat());
        $('#lng').val(position.lng());
    }
    function updateAutoCompeleteAddress(addr){
        $('#searchTextField').val(addr);
    }
</script>