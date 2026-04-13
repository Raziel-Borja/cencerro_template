<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyD6aKacCAs6KpAn4GMCqBGNiKUzQC9pwzI"></script>
	<title></title>
</head>
<body>
    <!-- Autocomplete location search input --> 
    <div class="form-group">
        <label>Location:</label>
        <input type="text" class="form-control" id="search_input" placeholder="Dirección..." />
    </div>

</body>
<script>
    var searchInput = 'search_input';

    $(document).ready(function () {
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
            types: ['geocode'],
        });
            
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            //var near_place = autocomplete.getPlace();

            console.log(near_place.formatted_address);

            console.log('Latitud:'+near_place.geometry.location.lat());
            console.log('Longitud:'+near_place.geometry.location.lng());

            // document.getElementById('loc_lat').value = near_place.geometry.location.lat();
            // document.getElementById('loc_long').value = near_place.geometry.location.lng();
                    
            // document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
            // document.getElementById('longitude_view').innerHTML = near_place.geometry.location.lng();
        });
    });

    $(document).on('change', '#'+searchInput, function () {
        document.getElementById('latitude_input').value = '';
        document.getElementById('longitude_input').value = '';
            
        document.getElementById('latitude_view').innerHTML = '';
        document.getElementById('longitude_view').innerHTML = '';
    });
</script>

</html>