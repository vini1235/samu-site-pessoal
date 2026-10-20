<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>SAMU - Registrar localização da ocorrência</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #fff;
        }

        .map-registration {
            width: 100%;
            max-width: 840px;
            margin: 0 auto;
            padding: 16px 12px;
            text-align: left;
        }

        .map-registration .row {
            margin-right: 0;
            margin-left: 0;
        }

        .map-registration .col-xs-12 {
            padding-right: 0;
            padding-left: 0;
        }

        .map-registration .form-control {
            min-height: 44px;
            border-radius: 8px;
        }

        .map-registration label {
            display: inline-block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .map-registration .btn-primary {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            border-color: #8e0000;
            font-weight: 600;
        }

        .map-registration .btn-primary:hover,
        .map-registration .btn-primary:focus {
            background: #8e0000;
            border-color: #8e0000;
        }

        .map-registration :focus-visible {
            outline: 3px solid #8e0000;
            outline-offset: 3px;
        }

        #map {
            width: 100%;
            height: 400px;
            border-radius: 8px;
            background: #f5f5f5;
        }

        .controls {
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            min-height: 40px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        #pac-input {
            background-color: #fff;
            color: #333;
            font-family: inherit;
            font-size: 16px;
            margin-left: 12px;
            padding: 8px 12px;
            text-overflow: ellipsis;
            width: calc(100% - 24px);
            max-width: 320px;
        }

        #pac-input:focus {
            border-color: #8e0000;
            outline: 2px solid #8e0000;
        }

        .pac-container {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        #type-selector {
            color: #fff;
            background-color: #8e0000;
            margin-left: 12px;
            padding: 8px 12px;
        }

        #type-selector label {
            margin: 0 0 0 4px;
            font-size: 13px;
        }

        .map-registration-compact #pac-input {
            width: 100%;
            max-width: none;
            margin: 0;
        }

        @media (max-width: 575px) {
            .map-registration {
                padding: 8px 0;
            }

            #map {
                height: 360px;
            }
        }
    </style>
</head>
<body>
<?php
include('connection.php');
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $lat=$_POST['lat'];
    $lng=$_POST['lng'];
    $type=$_POST['type'];
    $location=$_POST['location'];
    $query="INSERT INTO markers1 (name,lat,lng,address)
                            VALUES ('$name','$lat','$lng','$location')";
    if(mysqli_query($conn,$query)){
        echo "<div class='alert alert-success' role='status'>Localização registrada com sucesso.</div>";
    }
}
?>





<div class="container-fluid map-registration">
    <p class="help-block" id="map-help">Digite o endereço e selecione uma sugestão para marcar a localização da ocorrência no mapa.</p>
    <form method="post" action="">
        <div class="row">
            <div class="col-xs-12">
                <label for="name">Nome / ocorrência</label>
                <input type="text" name="name" id="name" class="form-control"><br>


                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
                <input type="hidden" name="location" id="location">

                <label for="pac-input" class="sr-only">Endereço da ocorrência</label>
                <input id="pac-input" aria-describedby="map-help" class="controls" type="text"
                       placeholder="Digite um endereço">
                <div id="type-selector" class="controls">
                    <input type="radio" name="type" id="changetype-all" checked="checked">
                    <label for="changetype-all">Todos os locais</label>


                </div>
                <div id="map" role="region" aria-label="Mapa para localizar a ocorrência"></div>
                <br>
                <br>

                <input type="submit" name="submit" value="Salvar localização" class="form-control btn btn-primary">
            </div>
        </div><!--End of row-->
    </form>
</div><!--End of container-->
<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -23.540419, lng: -46.905464},
            zoom: 13
        });
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("Não foi possível localizar o endereço: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setIcon(/** @type {google.maps.Icon} */({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var item_Lat =place.geometry.location.lat();
            var item_Lng= place.geometry.location.lng();
            var item_Location = place.formatted_address;
//alert("Lat= "+item_Lat+"_____Lang="+item_Lng+"_____Location="+item_Location);
            $("#lat").val(item_Lat);
            $("#lng").val(item_Lng);
            $("#location").val(item_Location);



            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            if (!radioButton) return;
            radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
            });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo rawurlencode((require __DIR__ . '/../maps-config.php')[1]); ?>&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>



