</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Using MySQL and PHP with Google Maps</title>
  <style>
    #map {
      width: 500px; /* Defina a largura desejada */
      height: 500px; /* Defina a altura desejada */
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
    $location=$_POST['location'];
    $entrada=$_POST['entrada'];
   
    $query="INSERT INTO markers1 (name,lat,lng,address, entrada)
                            VALUES ('$name','$lat','$lng','$location','$entrada')";
    if(mysqli_query($conn,$query)){
        echo "<div class='alert alert-success'>Place inserted in Database</div>";
    }

    // Passando a variável $entrada para o JavaScript
    echo "<script>";
    echo "var entrada = '" . $entrada . "';";
    echo "</script>";
}
?>
<!-- Inputs de busca -->
<div id="searchInputs">
  <label for="initialDate">Data Inicial:</label>
  <input type="date" id="initialDate" name="initialDate">
  <label for="finalDate">Data Final:</label>
  <input type="date" id="finalDate" name="finalDate">
  <button onclick="buscarDados()">Buscar</button>
</div>

<!-- Mapa -->
<div id="map"></div>
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
    <input type="text" name="location" id="location">

    <input type="submit" name="submit" value="Save" class="form-control btn btn-primary">
  </form>
</div>

<script>
  var map; // Variável global para o objeto do mapa
  var markers = []; // Array para armazenar os marcadores

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(-23.540419, -46.905464),
      zoom: 12
    });

    var input = document.getElementById('pac-input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }

      document.getElementById('lat').value = place.geometry.location.lat();
      document.getElementById('lng').value = place.geometry.location.lng();
      document.getElementById('location').value = place.formatted_address;
    });
  }

  function buscarDados() {
    var initialDate = document.getElementById("initialDate").value;
    var finalDate = document.getElementById("finalDate").value;

    // Construir a URL com as datas selecionadas
    var url = 'resultado.php?initialDate=' + initialDate + '&finalDate=' + finalDate;

    // Executar a função para baixar os dados
    downloadUrl(url, function(data) {
      // Processar os dados retornados do PHP e criar marcadores de acordo
      // Limpar marcadores existentes antes de adicionar os novos
      clearMarkers();
      // Adicionar novos marcadores ao mapa
      addMarkers(data);
    });
  }

  function clearMarkers() {
    // Remover todos os marcadores do mapa e limpar o array de marcadores
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
    markers = [];
  }

  function addMarkers(data) {
    // Parsear os dados retornados do PHP para obter informações dos marcadores
    var xml = data.responseXML;
    var markerNodes = xml.documentElement.getElementsByTagName('marker');
    for (var i = 0; i < markerNodes.length; i++) {
      var name = markerNodes[i].getAttribute('name');
      var address = markerNodes[i].getAttribute('address');
      var latlng = new google.maps.LatLng(
          parseFloat(markerNodes[i].getAttribute('lat')),
          parseFloat(markerNodes[i].getAttribute('lng')));

      // Criar marcador
      var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        title: name,
        address: address
      });

      // Adicionar marcador ao array de marcadores
      markers.push(marker);

      // Adicionar informações do marcador ao infowindow
      var infowindow = new google.maps.InfoWindow({
        content: '<strong>' + name + '</strong><br>' + address
      });

      // Adicionar evento de clique para exibir infowindow
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      });
    }
  }

  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing() {}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo rawurlencode((require __DIR__ . '/../maps-config.php')[1]); ?>&libraries=places&callback=initMap"></script>
</body>
</html>


