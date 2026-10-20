<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');

?>
<?php
$connect = $conn;
$query = "SELECT setor, count(*) as number FROM equipamentos GROUP BY setor";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" >

    <title>TI-SAUDE</title>


    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Sistema de controle de serviços de TI  Developer by Renato Cristian Gonçalves" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/demo.css">
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../css/pushy.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>





    <script src="../js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="../DataTables/css/jquery.dataTables.min.css">
    <script src="../js/jquery-1.12.4.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>



    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon"/>




    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../css/theme.css" rel="stylesheet">
    <link href="./estilo.css" rel="stylesheet">
    <script src="../js/ie-emulation-modes-warning.js"></script>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <style>
        #map {
            width: 100%;
            min-height: 450px;

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
                ['setor', 'Number'],
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo "['".$row["setor"]."', ".$row["number"]."],";
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

<body role="document">
<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao/conexao.php");
seguranca_user();
?>


<header class="site-header push">TI-SAÚDE</header>


<!-- Pushy Menu -->
<nav class="pushy pushy-left" data-focus="#first-link">
    <div class="pushy-content">
        <ul>
            <a href="administrativo.php"><button type="submit" class="btn btn-primary">Home</button></a>

            <li class="pushy-submenu">
                <button id="first-link">Entrada de Equipamento</button>

                <ul>
                    <li class="pushy-link"><a href="equipamento_entrada.php">Entrada de Equipamento</a></li>
                    <li class="pushy-link"><a href="equipamento_saida.php">Saida de Equipamento</a></li>

                </ul>
            </li>
            <li class="pushy-submenu">
                <button>Entrada de Toner</button>
                <ul>
                    <li class="pushy-link"><a href="entrada_toner.php">Entrada de Torner</a></li>
                    <li class="pushy-link"><a href="saida_toner.php">Saida de Toner</a></li>

                </ul>
            </li>
            <li class="pushy-submenu">
                <button>Património</button>
                <ul>
                    <li class="pushy-link"><a href="equipamento.php">Equipamento</a></li>

                </ul>
            </li>
            <li class="pushy-submenu">
                <button>Serviços</button>
                <ul>

                    <li class="pushy-link"><a href="servico.php">Serviços</a></li>

                </ul>
            </li>
            <li class="pushy-link"><a href="tickets.php">Emissao-de-tickets </a></li>
            <li class="pushy-link"><a href="arquivos.php">Dowload</a></li>
            <li class="pushy-link"><a href="arquivo/index.php">Upload de Arquivos</a></li>
            <li class="pushy-link"><a href="usuario.php">Cadastrar</a></li>


            <a href="sair.php"><button type="submit" class="btn btn-success">Sair</button></a>
        </ul>
    </div>
</nav>



<div class="site-overlay"></div>

<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>


    <div align="center">
        <img src="../imagens/logo-jandira.png"  alt="some_text"/>
    </div>






    <div class="section group">

        <h1 id="centro"> Grafico saida de Toner por Setor</h1>



        <div style="width:100%;">
            <h3 align="center">Graficos  em Porcentagem  Setor</h3>
            <br />
            <div id="piechart"  style="width: 100%;   min-height: 450px; "></div>
            <br>



        </div>






    </div>
    <br>
    <br>
    <footer id="footer" class="clearfix">
        <div id="footer-widgets">

            <div class="container">

                <div id="footer-wrapper">



                </div> <!-- end #footer-wrapper -->

            </div> <!-- end .container -->
        </div> <!-- end #footer-widgets -->

        <div id="sub-floor">
            <div class="container">
                <div class="col-md-4 copyright">
                    </br>
                    TI-SAUDE  © 2018</br>
                    -------------------------</br>
                    Tel: (11)4619-9433</br>

                    suporte.ti.saude@jandira.sp.gov.br</br>
                    </br>
                    </br>
                </div>
                <div class="col-md-4 col-md-offset-4 attribution">
                    Developer by Renato Cristian Gonçalves  <a target="_blank" href="#"></a></br>
                    </br>
                    <p>(11)97736-7521 <span class="glyphicon glyphicon-phone-alt"></span></p>

                    renatocristiang@gmail.com  <span class="glyphicon glyphicon-envelope"></span>
                    renatocristian@hotmail.com  <span class="glyphicon glyphicon-envelope"></span>
                    </br>


                    </br>
                    </br>
                </div>
            </div>
        </div>

    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/pushy.min.js"></script>
</body>
</html>
