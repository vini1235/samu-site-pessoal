<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');
?>
<?php
session_start();
include_once("../seguranca.php");

seguranca_adm();
?>
<?php

$conexao = $conn;
$banco = mysqli_select_db($conexao, $dbname);
mysqli_set_charset($conexao,'utf8');
$query ="SELECT * FROM entrada_toner ORDER BY ID DESC";
$result = mysqli_query($conexao, $query);


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
        tr {
            background-color: #a3a3a3;
        }

    </style>
    <style>

        th { white-space: nowrap; }

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

<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>


    <div align="center">
        <img src="../imagens/logo-jandira.png"  alt="some_text"/>
    </div>



    <h1 id="centro">Tabela de Entrada de Toner </h1>
    <br>
    <div class="container-fluid">
        <h3 align="center"></h3>
        <br />
        <div class="table-responsive">

            <div class="pull-right">


                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar</button>

                <a  href="gerarExcel2.php"  class="btn btn-primary"style="color:White;"  >Excel</a>
                <a  href="grafico2.php"  class="btn btn-danger"style="color:White;"  >Grafico</a>

            </div>
            <div class="pull-left">
                <form method="post" action="./excel/geralExcel4.php">

                    <label for="execel">Excel Especifico:</label>
                    <select class="selectpicker" data-style="btn-primary"  name="pesquisar" id="pesquisar">

                        <option value="AMMEJ">AMMEJ</option>
                        <option value="UBS-ALVORADA">UBS-ALVORADA</option>
                        <option value="UBS-FATIMA">UBS-FATIMA</option>
                        <option value="UBS-SAGRADO">UBS-SAGRADO</option>
                        <option value="UBS-VALE DO SOL">UBS-VALE DO SOL</option>
                        <option value="UBS-GABRIELA">UBS-GABRIELA</option>
                        <option value="UBS-TEREZA">UBS-TEREZA</option>
                        <option value="UBS-OURO VERDE">UBS-OURO VERDE</option>
                        <option value="UBS-ANALANDIA">UBS-ANALANDIA</option>
                        <option value="UBS-EUNICE">UBS-EUNICE</option>
                        <option value="UBS-BROTINHO">UBS-BROTINHO</option>
                        <option value="UBS-BROTINHO">SETOR-RH</option>
                        <option value="SETOR-GABINETE">SETOR-GABINETE</option>
                        <option value="SETOR-SUPRIMENTOS">SETOR-SUPRIMENTOS</option>
                        <option value="SETOR-DIRETORIA" >SETOR-DIRETORIA</option>
                        <option value="SETOR-PROTOCOLO">SETOR-PROTOCOLO</option>
                        <option value="SETOR-UAC">SETOR-UAC</option>
                        <option value="SETOR-ULTRASSOM">SETOR-ULTRASSOM</option>
                        <option value="SETOR-REGULACAO">SETOR-REGULACAO</option>
                        <option value="SETOR-ZOONOSES">SETOR-ZOONOSES</option>
                        <option value="SETOR-VISA">SETOR-VISA</option>
                        <option value="SETOR-VE">SETOR-VE</option>
                        <option value="SETOR-PLANTAO/AMBULANCIA">SETOR-PLANTAO/AMBULANCIA</option>
                        <option value="SETO-SAMU">SETO-SAMU</option>
                        <option value="SETOR-CTA">SETOR-CTA</option>
                        <option value="SETOR-SERVICO SOCIAL">SETOR-SERVICO SOCIAL</option>
                        <option value="SETOR-CRM">SETOR-CRM</option>
                        <option value="SETOR-CRH">SETOR-CRH</option>
                        <option value="SETOR-ALMOXARIFAD">SETOR-ALMOXARIFADO</option>
                        <option value="SETOR-CAPS">SETOR-CAPS</option>
						<option value="SETOR-CAPS">SETOR-CONVENIOS</option>
                        <option value="SETOR-TI-SAUDE">SETOR-TI-SAUDE</option>
                        <option value="SETOR-PATRIMONIO SAUDE">SETOR-PATRIMONIO SAUDE</option>
                        <option value="SETOR-CONSELHO M SAUDE">SETOR-CONSELHO M SAUDE</option>
                        <option value="SETOR-FARMACIA">SETOR-FARMACIA</option>

                    </select>
                    <input type="submit"  class="btn btn-primary" value="enviar"/>

                </form>


            </div>


            <!-- Inicio Modal -->
            <div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">

                            <form action="enviar_contato2.php" method="POST" id="form" enctype="multipart/form-data">
                                <ul>


                                    <li>
                                        <label for="entrada">Data</label>

                                        <input type="date" name="entrada" id="entrada"><date-util format="dd/MM/yyyy"></date-util><span class="required"></span>


                                    </li>
                                    <li>

                                        <label for="setor">Setor</label>
                                        <select name="setor" id="setor">
                                            <option value="AMMEJ">AMMEJ</option>
                                            <option value="UBS-ALVORADA">UBS-ALVORADA</option>
                                            <option value="UBS-FATIMA">UBS-FATIMA</option>
                                            <option value="UBS-SAGRADO">UBS-SAGRADO</option>
                                            <option value="UBS-VALE DO SOL">UBS-VALE DO SOL</option>
                                            <option value="UBS-GABRIELA">UBS-GABRIELA</option>
                                            <option value="UBS-TEREZA">UBS-TEREZA</option>
                                            <option value="UBS-OURO VERDE">UBS-OURO VERDE</option>
                                            <option value="UBS-ANALANDIA">UBS-ANALANDIA</option>
                                            <option value="UBS-EUNICE">UBS-EUNICE</option>
                                            <option value="UBS-BROTINHO">UBS-BROTINHO</option>
                                            <option value="UBS-BROTINHO">SETOR-RH</option>
                                            <option value="SETOR-GABINETE">SETOR-GABINETE</option>
                                            <option value="SETOR-SUPRIMENTOS">SETOR-SUPRIMENTOS</option>
                                            <option value="SETOR-DIRETORIA" >SETOR-DIRETORIA</option>
                                            <option value="SETOR-PROTOCOLO">SETOR-PROTOCOLO</option>
                                            <option value="SETOR-UAC">SETOR-UAC</option>
                                            <option value="SETOR-ULTRASSOM">SETOR-ULTRASSOM</option>
                                            <option value="SETOR-REGULACAO">SETOR-REGULACAO</option>
                                            <option value="SETOR-ZOONOSES">SETOR-ZOONOSES</option>
                                            <option value="SETOR-VISA">SETOR-VISA</option>
                                            <option value="SETOR-VE">SETOR-VE</option>
                                            <option value="SETOR-PLANTAO/AMBULANCIA">SETOR-PLANTAO/AMBULANCIA</option>
                                            <option value="SETO-SAMU">SETO-SAMU</option>
                                            <option value="SETOR-CTA">SETOR-CTA</option>
                                            <option value="SETOR-SERVICO SOCIAL">SETOR-SERVICO SOCIAL</option>
                                            <option value="SETOR-CRM">SETOR-CRM</option>
                                            <option value="SETOR-CRH">SETOR-CRH</option>
                                            <option value="SETOR-ALMOXARIFAD">SETOR-ALMOXARIFADO</option>
                                            <option value="SETOR-CAPS">SETOR-CAPS</option>
											<option value="SETOR-CAPS">SETOR-CONVENIOS</option>
                                            <option value="SETOR-TI-SAUDE">SETOR-TI-SAUDE</option>
                                            <option value="SETOR-PATRIMONIO SAUDE">SETOR-PATRIMONIO SAUDE</option>
                                            <option value="SETOR-CONSELHO M SAUDE">SETOR-CONSELHO M SAUDE</option>
                                            <option value="SETOR-FARMACIA">SETOR-FARMACIA</option>

                                        </select>



                                    </li>

                                    </li>

                                    <li>
                                        <label for="nome">Nome</label>
                                        <input type="text" name="nome" id="nome"  placeholder="Digite  seu Nome   " required="required"><span class="required"></span>
                                    </li>
                                    <li>



                                        <label for="toner">Toner</label>
                                        <select name="toner" id="toner">
                                            <option>D-111S</option>
                                            <option>CE-505A</option>
                                            <option>TN-580/620</option>
                                            <option>LEX-352</option>
                                            <option>CE 310A Black </option>
                                            <option>CE 311A Cyan</option>
                                            <option>CE 312A Yellow</option>
                                            <option>CE 313a Magenta</option>
                                            <option>ML-2850</option>
                                            <option>HP Q7551A</option>
                                            <option>SWITCH </option>
                                            <option>CF-280A</option>
                                            <option>CF-226A BLACK</option>
                                            <option>KIT REFIL 6110MPF</option>
                                            <option>PHASER-6110</option>





                                        </select>




                                    </li>




                                    <li>

                                        <label for="obs" class="control-label">OBS</label>
                                        <textarea name="obs" class="form-control" id="obs"></textarea>

                                    </li>
                                    <li>

                                        <input type="submit" id="send_message" value="Enviar"   />


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
            <div id="post_modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Detalhes da Tabela</h4>
                        </div>
                        <div class="modal-body" id="post_detail">




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <table id="employee_data" class="display" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <td>ID</td>
                    <td>ENTRADA</td>
                    <td>SETOR</td>
                    <td>NOME</td>
                    <td>TONER</td>
                    <td>OBS</td>
                    <td>+</td>
                    <td>PDF</td>
                    <td>EDITAR</td>
                    <td>EXCLUIR</td>

                </tr>
                </thead>

                <?php
                while($row = mysqli_fetch_array($result))

                {
                    $url_pdf = "gerar_pdf2.php?cod=".$row["id"] ;

                    $url_excluir = "delete2.php?cod=".$row["id"];

                    echo '
                               <tr xmlns="http://www.w3.org/1999/html">

                                    <td>' .$row["id"].'</td>
									<td>'.date ("d/m/Y",strtotime($row["entrada"])) .'</td>
                                    <td>'.$row["setor"].'</td>
                                    <td>'.$row["nome"].'</td>
                                    <td>'.$row["toner"].'</td>                                
                                    <td>'.$row["obs"].'</td>



                                 <td> <a  name="view" class="btn btn-info view" id="'.$row["id"].'" >+</a></td>
                                 <td><a href= '.$url_pdf.' class="btn btn-warning"style="color:White;" target="_blank" </a>PDF</td> 	</td>
                                
                                 <td> <a id="getEdit" class="btn btn-primary"style="color:White;"  data-toggle="modal" data-target="#myModal" data-id="'.$row[0].'">Editar</a></td> 
                                 
                                  <td><a href='.$url_excluir.' class = "btn btn-danger"style="color:White;" onclick="return confirm(\'Tem certeza que deseja deletar este registro?\')" >Apagar</a></td>
                        
                      
                     
                                    		
                               </tr>
                               ';
                }
                ?>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div id="content-data"></div>
    </div>
</div>



<!--script js for get edit data-->
<script>
    $(document).on('click','#getEdit',function(e){
        e.preventDefault();
        var id=$(this).data('id');
        //alert(per_id);
        $('#content-data').html('');
        $.ajax({
            url:'alterar2.php',
            type:'POST',
            data:'id='+id,
            dataType:'html'
        }).done(function(data){
            $('#content-data').html('');
            $('#content-data').html(data);
        }).fial(function(){
            $('#content-data').html('<p>Error</p>');
        });
    });
</script>


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
<script>
    $(document).ready(function(){
        $('#employee_data').DataTable();
    });
</script>
<script>
    $(document).ready(function(){

        function fetch_post_data(id)
        {
            $.ajax({
                url:"fetch3.php",
                method:"POST",
                data:{id:id},
                success:function(data)
                {
                    $('#post_modal').modal('show');
                    $('#post_detail').html(data);
                }
            });
        }

        $(document).on('click', '.view', function(){
            var id = $(this).attr("id");
            fetch_post_data(id);
        });

        $(document).on('click', '.previous', function(){
            var id = $(this).attr("id");
            fetch_post_data(id);
        });

        $(document).on('click', '.next', function(){
            var id = $(this).attr("id");
            fetch_post_data(id);
        });

    });
</script>
