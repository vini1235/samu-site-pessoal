<?PHP
header('Content-Type: text/html; charset=utf-8');
?>
<?php
session_start();
include_once("../seguranca.php");

?>
<?php
require_once __DIR__ . '/../../conexao/conexao.php';
mysqli_set_charset($conn, 'utf8');

$query = "SELECT ocorrencia, COUNT(*) AS number FROM clinica GROUP BY ocorrencia";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gráfico de ocorrências - SAMU Jandira</title>
    <link rel="stylesheet" href="../../css/occurrence-chart.css">
</head>
<body>
    <main class="occurrence-chart" id="occurrence-chart">
        <div id="piechart" role="img" aria-label="Distribuição das ocorrências por especialidade"></div>
        <ul class="chart-legend" id="chart-legend" aria-label="Legenda das especialidades"></ul>
    </main>

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../../js/occurrence-chart.js"></script>
    <script>
        google.charts.load('current', { packages: ['corechart'], language: 'pt-BR' });
        google.charts.setOnLoadCallback(function () {
            renderOccurrenceChart([
                ['ocorrencia', 'Number'],
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo "['".$row["ocorrencia"]."', ".$row["number"]."],";
                }
                ?>
            ]);
        });
    </script>
</body>
</html>
