<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');

?>
<?php

$conexao = $conn;
$banco = mysqli_select_db($conexao, $dbname);
mysqli_set_charset($conexao, 'utf8');

$query = "SELECT * FROM clinica ORDER BY ID DESC";
$result = mysqli_query($conexao, $query);


?>

<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao/conexao.php");
seguranca_adm();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">

    <title>SAMU-JANDIRA</title>


    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Sistema de apontamento de ocorrencia SAMU de TI  Developer by Renato Cristian Gonçalves" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/demo.css">
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../css/pushy.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <script src="../js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>



    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon" />




    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../css/theme.css" rel="stylesheet">
    <link href="./estilo.css" rel="stylesheet">
    <script src="../js/ie-emulation-modes-warning.js"></script>







    <style>
        tr#table {
            background-color: #a3a3a3;
            font-size: 12px;
        }
    </style>
    <style>
        th#table1 {
            white-space: nowrap;
            font-size: 9px;
        }
    </style>

    <style>
        td#table1 {

            font-size: 8px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#').DataTable({
                "scrollY": 200,
                "scrollX": true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#').DataTable({
                scrollY: '50vh',
                "scrollCollapse": true,
                "paging": true
            });
        });
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
            $('#').DataTable({
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(5)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(5, {
                            page: 'current'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(
                        '$' + pageTotal + ' ( $' + total + ' total)'
                    );
                }
            });
        });
    </script>


</head>

<body role="document">
    <?php
    if (isset($_SESSION['msg'])) {
        echo "<p>" . $_SESSION['msg'] . "</p>";
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
            <img src="../imagens/samu.png" alt="some_text" />
        </div>




        <div class="container-fluid">
            <h1 id="centro">Clinica Médica</h1>
            <br />
            <div class="pull-right">
                <a href="clinica.php" class="btn btn-primary" style="color:White;">Voltar</a>

                <a href="clinica_cad.php" class="btn btn-primary" style="color:White;">Clinica-cadastro</a>

                <a href="maps/maps1.php" class="btn btn-danger" style="color:White;">Mapa</a>



            </div>
            <div class="site-overlay"></div>
            <p></p>
            <h1 id="centro">Formulario </h1>
            <br />



            <div class="table-responsive">




                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Data</label>
                            <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                                <input type="text" class="form-control" name="txtdatahora" placeholder="Data da visita">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </span>
                            </div>
                            <script src="../js/bootstrap.min.js"></script>
                            <script src="../js/bootstrap-datetimepicker.min.js"></script>
                            <script src="../js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
                            <script type="text/javascript">
                                $('.data_formato').datetimepicker({
                                    weekStart: 1,
                                    todayBtn: 1,
                                    autoclose: 1,
                                    todayHighlight: 1,
                                    startView: 2,
                                    forceParse: 0,
                                    showMeridian: 1,
                                    language: "pt-BR",
                                    //startDate: '+0d'
                                });
                            </script>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Funcionario</label>

                            <input type="text" class="form-control" name="funcionario" id="funcionario" placeholder="Digite o nome do funcionario " required="required"><span class="required"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">nome</label>
                            <input type="text" class="form-control" placeholder="Email">

                            <input type="text" name="funcionario" id="funcionario" placeholder="Digite o Nome " required="required"><span class="required"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>


                <!-- Inicio Modal -->
                <div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center" id="myModalLabel"> </h4>
                            </div>
                            <div class="modal-body">

                                <form action="enviar_contato.php" method="POST" id="form" enctype="multipart/form-data">
                                    <ul>


                                        <li>
                                            <div class="form-group">
                                                <label for="inputPassword3" class="col-sm-2 control-label">Data/Hora</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                                                        <input type="text" class="form-control" name="txtdatahora" placeholder="Data da visita">
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>


                                            <script src="../js/bootstrap.min.js"></script>
                                            <script src="../js/bootstrap-datetimepicker.min.js"></script>
                                            <script src="../js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
                                            <script type="text/javascript">
                                                $('.data_formato').datetimepicker({
                                                    weekStart: 1,
                                                    todayBtn: 1,
                                                    autoclose: 1,
                                                    todayHighlight: 1,
                                                    startView: 2,
                                                    forceParse: 0,
                                                    showMeridian: 1,
                                                    language: "pt-BR",
                                                    //startDate: '+0d'
                                                });
                                            </script>

                                        </li>
                                        <li>
                                            <label for="funcionario">Funcionário </label>
                                            <input type="text" name="funcionario" id="funcionario" placeholder="Digite o Nome " required="required"><span class="required"></span>
                                        </li>
                                        <li>
                                            <label for="plantao">Plantâo</label>
                                            <input type="text" name="plantao" id="plantao" placeholder="Digite o Plantao" required="required"><span class="required"></span>
                                        </li>

                                        <li>
                                        <li>
                                            <label for="ocorrencia">Ocorrencia</label>
                                            <select name="ocorrencia" id="ocorrencia">
                                                <option>CLINICA MEDICA</option>

                                            </select>



                                        <li>
                                            <label for="evento">N°/Evento</label>
                                            <input type="text" name="evento" id="evento" placeholder="Digite o Numero do Evento" required="required"><span class="required"></span>
                                        </li>
                                        <li>
                                            <label for="qru">Q.R.U</label>
                                            <input type="text" name="qru" id="qru" placeholder="Digite o Q.R.U" required="required"><span class="required"></span>

                                        </li>
                                        <li>
                                            <label for="qra">Q.R.A</label>
                                            <input type="text" name="qra" id="qra" placeholder="Digite o Q.R.A" required="required"><span class="required"></span>
                                        </li>
                                        <li>
                                            <label for="qth">Q.T.H</label>
                                            <input type="text" name="qth" id="qth" placeholder="Digite o Q.T.H" required="required"><span class="required"></span>

                                        </li>
                                        <li>
                                            <label for="qti">Q.T.I</label>
                                            <input type="text" name="qti" id="qti" placeholder="Digite o Q.T.I" required="required"><span class="required"></span>

                                        </li>
                                        <li>
                                            <label for="message">OBS</label>

                                            <textarea name="message" id="message" rows="30" cols="30" placeholder="Digite a Observação" required="required"></textarea>

                                        </li>
                                        <li>

                                            <input type="submit" id="send_message" value="Enviar" />


                                        </li>


                                    </ul>
                                </form>



                                <div class="modal-footer">




                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <br>


                <br>

            </div>
        </div>
    </div>
    </div>
    </div>


    <!--script js for get edit data-->
    <script>
        $(document).on('click', '#getEdit', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url: 'alterar.php',
                type: 'POST',
                data: 'id=' + id,
                dataType: 'html'
            }).done(function(data) {
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fial(function() {
                $('#content-data').html('<p>Error</p>');
            });
        });
    </script>






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
                    TI-SAUDE © 2018</br>
                    -------------------------</br>
                    Tel: (11)4619-9433</br>

                    suporte.ti.saude@jandira.sp.gov.br</br>
                    </br>
                    </br>
                </div>
                <div class="col-md-4 col-md-offset-4 attribution">
                    Developer by Renato Cristian Gonçalves <a target="_blank" href="#"></a></br>
                    </br>
                    <p>(11)97736-7521 <span class="glyphicon glyphicon-phone-alt"></span></p>

                    renatocristiang@gmail.com <span class="glyphicon glyphicon-envelope"></span>
                    renatocristian@hotmail.com <span class="glyphicon glyphicon-envelope"></span>
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
<script language="JavaScript" type="text/javascript">
    function checkDelete() {
        return confirm('Tem certeza que deseja deletar este registro?');
    }
</script>