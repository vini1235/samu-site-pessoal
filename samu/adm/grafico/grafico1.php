

<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao/conexao.php");
seguranca_adm();
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">


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







    <style>
        tr#table {
            background-color: #a3a3a3;
        }

    </style>
    <style>

        th#table1 { white-space: nowrap; }

    </style>



    <script>

        $(document).ready(function() {
            $('#').DataTable( {
                "scrollY": 200,
                "scrollX": true
            } );
        } );

    </script>

    <script>

        $(document).ready(function() {
            $('#').DataTable( {
                scrollY:        '50vh',
                "scrollCollapse": true,
                "paging":         true
            } );
        } );


    </script>


    <script>
        function somenteNumeros(num) {
            var er = /[^0-9.]/;
            er.lastIndex = 0;
            var campo = num;
            if (er.test(campo.value)) {
                campo.value = "";
            }
        }
    </script>
    <script>

        $(document).ready(function() {
            $('#').DataTable( {
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ total +' total)'
                    );
                }
            } );
        } );


    </script>


</head>
<body role="document">
<?php
if(isset($_SESSION['msg'])){
    echo "<p>".$_SESSION['msg']."</p>";
    unset($_SESSION['msg']);
}
?>

<header class="site-header push">SAMU-JANDIRA</header>


<!-- Pushy Menu -->
<nav class="pushy pushy-left" data-focus="#first-link">
    <div class="pushy-content">
        <ul>
            <a href="administrativo.php"><button type="submit" class="btn btn-primary">Home</button></a>

            <li class="pushy-submenu">



            <li class="pushy-link"><a href="clinica.php">CLINICA MÉDICA</a></li>



            </li>
            <li class="pushy-submenu">


            <li class="pushy-link"><a href="trauma.php">TRAUMA</a></li>



            </li>
            <li class="pushy-submenu">

            <li class="pushy-link"><a href="obstetricia.php">OBSTETRÍCIA</a></li>


            </li>
            <li class="pushy-submenu">


            <li class="pushy-link"><a href="pediatria.php">PEDIATRIA</a></li>


            </li>
            <li class="pushy-link"><a href="ortopedia.php">ORTOPEDIA</a></li>
            <li class="pushy-link"><a href="psiquiatria.php">PSIQUIATRIA</a></li>



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




    <div class="container-fluid">
        <h1 id="centro">Clinica Médica</h1>
        <br />








        <div class="site-overlay"></div>


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