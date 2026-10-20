<?php
session_start();
include_once("../seguranca.php");

seguranca_adm();
?>
<?php
$connect = mysqli_connect("localhost", "root", "", "tisaude");
$query = "SELECT toner, count(*) as number FROM entrada_toner GROUP BY toner";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>T.I saude</title>

    <script src="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <script src="../../DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../../DataTables/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../DataTables/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" type="text/css" href="../../DataTables/datatables.min.css"/>

    <script type="text/javascript" src="../../DataTables/datatables.min.js"></script>




    <style>
        #map {
            width: 100%;
            height: 100%;
        }
    </style>
    <style>
        .row {
            margin:0 !important;
        }


    </style>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart()
        {
            var data = google.visualization.arrayToDataTable([
                ['toner', 'Number'],
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo "['".$row["toner"]."', ".$row["number"]."],";
                }
                ?>
            ]);
            var options = {
                title: '',
                //is3D:true,
                pieHole: 0.4
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

</head>
<body>


<div style="width:100%;">
    <h3 align="center">Graficos  em Porcentagem de entrada de TONER</h3>
    <br />
    <div id="piechart"style="width: 100%;   min-height: 450px; " ></div>
    <br>



</div>


</body>
</html>