<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/../seguranca.php';
seguranca_adm();
require_once __DIR__ . '/../../conexao/conexao.php';
require_once __DIR__ . '/../../conexao/occurrence-stats.php';
$chartRows = samu_occurrence_chart_rows($conn);
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
    <script src="../../js/occurrence-chart.js?v=2"></script>
    <script>
        google.charts.load('current', { packages: ['corechart'], language: 'pt-BR' });
        google.charts.setOnLoadCallback(function () {
            renderOccurrenceChart(<?php echo json_encode($chartRows, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR); ?>);
        });
    </script>
</body>
</html>
