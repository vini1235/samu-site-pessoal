

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

<div class="container-fluid map-registration map-registration-compact">
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Nome / ocorrência</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="entrada">Data da ocorrência</label>
            <input type="date" name="entrada" id="entrada" class="form-control">
        </div>

        <div class="form-group">
            <label for="pac-input">Endereço da ocorrência</label>
            <input id="pac-input" class="controls form-control" type="text" placeholder="Digite um endereço">
        </div>

        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        <input type="hidden" name="location" id="location">

        <input type="submit" name="submit" value="Salvar localização" class="form-control btn btn-primary">
    </form>
</div>

<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Não foi possível localizar o endereço: '" + place.name + "'");
                return;
            }
            $("#lat").val(place.geometry.location.lat());
            $("#lng").val(place.geometry.location.lng());
            $("#location").val(place.formatted_address);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo rawurlencode((require __DIR__ . '/../maps-config.php')[1]); ?>&libraries=places&callback=initMap" async defer></script>
</body>
</html>
