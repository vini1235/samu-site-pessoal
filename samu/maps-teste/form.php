

<!DOCTYPE html>
<html>
<head>
    <title>Place Autocomplete</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }
        #pac-input:focus {
            border-color: #4d90fe;
        }
        .pac-container {
            font-family: Roboto;
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
        echo "<div class='alert alert-success'>Place inserted in Database</div>";
    }
}
?>

<div class="container">
    <form method="post" action="" class="col-lg-6">
        <div class="form-group">
            <label for="name">Name/Ocorrência</label>
            <input type="text" name="name" class="form-control">
            <input type="date" name="entrada" class="form-control">
        </div>

        <div class="form-group">
            <label for="pac-input">Enter a location</label>
            <input id="pac-input" class="controls form-control" type="text" placeholder="Enter a location">
        </div>

        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        <input type="hidden" name="location" id="location">

        <input type="submit" name="submit" value="Save" class="form-control btn btn-primary">
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
                window.alert("No details available for input: '" + place.name + "'");
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
