<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <title>Using MySQL and PHP with Google Maps</title>
  <style>
    /* Sem mudanças na sua folha de estilos */
    #map {
      height: 80%; /* Defina a altura do mapa para deixar espaço para os inputs e botão */
    }
    /* Estilo para os inputs e botão */
    #searchInputs {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
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

  <script>
    var map; // Variável global para o objeto do mapa

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(-23.540419, -46.905464),
        zoom: 12
      });

      // Chamada inicial para buscar dados com datas predefinidas
      buscarDados();
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
      // Implemente a lógica para remover todos os marcadores do mapa, se necessário
    }

    function addMarkers(data) {
      // Implemente a lógica para adicionar marcadores ao mapa com base nos dados retornados
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText); // Passar o texto de resposta para a função de callback
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo rawurlencode((require __DIR__ . '/../maps-config.php')[1]); ?>&callback=initMap"></script>
</body>
</html>
