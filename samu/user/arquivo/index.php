<?PHP
header('Content-Type: text/html; charset=utf-8');
?>
<?php
session_start();
include_once("../seguranca.php");

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


    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/demo.css">
    <!-- Pushy CSS -->
    <link rel="stylesheet" href="../../css/pushy.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>





    <script src="../../js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../../js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="../../js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="../../DataTables/css/jquery.dataTables.min.css">
    <script src="../../js/jquery-1.12.4.js"></script>
    <script src="../../js/jquery.dataTables.min.js"></script>



    <link rel="shortcut icon" href="../../imagens/favicon.jpg" type="image/x-icon"/>




    <link href="../../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../../css/theme.css" rel="stylesheet">
    <link href="./../estilo.css" rel="stylesheet">
    <script src="../../js/ie-emulation-modes-warning.js"></script>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>





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
            <a href="../administrativo.php"><button type="submit" class="btn btn-primary">Home</button></a>

            <li class="pushy-submenu">
                <button id="first-link">Entrada de Equipamento</button>

                <ul>
                    <li class="pushy-link"><a href="../equipamento_entrada.php">Entrada de Equipamento</a></li>
                    <li class="pushy-link"><a href="../equipamento_saida.php">Saida de Equipamento</a></li>

                </ul>
            </li>
            <li class="pushy-submenu">
                <button>Entrada de Toner</button>
                <ul>
                    <li class="pushy-link"><a href="../entrada_toner.php">Entrada de Torner</a></li>
                    <li class="pushy-link"><a href="../saida_toner.php">Saida de Toner</a></li>

                </ul>
            </li>
            <li class="pushy-submenu">
                <button>Património</button>
                <ul>
                    <li class="pushy-link"><a href="../equipamento.php">Equipamento</a></li>

                </ul>
            </li>
            <li class="pushy-submenu">
                <button>Serviços</button>
                <ul>

                    <li class="pushy-link"><a href="../servico.php">Serviços</a></li>

                </ul>
            </li>
            <li class="pushy-link"><a href="../tickets.php">Emissao-de-tickets </a></li>
            <li class="pushy-link"><a href="../arquivos.php">Dowload</a></li>
            <li class="pushy-link"><a href="../arquivo/index.php">Upload de Arquivos</a></li>
            <li class="pushy-link"><a href="../usuario.php">Cadastrar</a></li>


            <a href="../sair.php"><button type="submit" class="btn btn-success">Sair</button></a>
        </ul>
    </div>
</nav>



<div class="site-overlay"></div>

<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>


    <div align="center">










    <div class="borda2 padding20">


    <div align="center">
        <img src="../../imagens/logo-jandira.png"  alt="some_text"/>
    </div>
    <h1 id="centro">T.I SAÚDE </h1>
    <br>
    <br>

    <div class="section group">



        <div class="container">
            <h2 align="center">Sistema de envio de arquivos para o Servidor</a></h2>
            <br />

            <br/>
            <br/>
            <div align="right">
                <button type="button" name="create_folder" id="create_folder" class="btn btn-success">Create</button>
            </div>
            <br />
            <div class="table-responsive" id="folder_table">

            </div>
        </div>


        <div id="folderModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="change_title">Create Folder</span></h4>
                    </div>
                    <div class="modal-body">
                        <p>Enter Folder Name
                            <input type="text" name="folder_name" id="folder_name" class="form-control" /></p>
                        <br />
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="old_name" id="old_name" />
                        <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create" />

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="uploadModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload File</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="upload_form" enctype='multipart/form-data'>
                            <p>Select Image
                                <input type="file" name="upload_file" /></p>
                            <br />
                            <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" />
                            <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="filelistModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">File List</h4>
                    </div>
                    <div class="modal-body" id="file_list">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



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
        <
        <script>window.jQuery || document.write('<script src="../../js/jquery.min.js"><\/script>')</script>
        <script src="../../js/pushy.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->









</body>
</html>
<script>
    $(document).ready(function(){

        load_folder_list();

        function load_folder_list()
        {
            var action = "fetch";
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action},
                success:function(data)
                {
                    $('#folder_table').html(data);
                }
            });
        }

        $(document).on('click', '#create_folder', function(){
            $('#action').val("create");
            $('#folder_name').val('');
            $('#folder_button').val('Create');
            $('#folderModal').modal('show');
            $('#old_name').val('');
            $('#change_title').text("Pasta criada");
        });

        $(document).on('click', '#folder_button', function(){
            var folder_name = $('#folder_name').val();
            var old_name = $('#old_name').val();
            var action = $('#action').val();
            if(folder_name != '')
            {
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:{folder_name:folder_name, old_name:old_name, action:action},
                    success:function(data)
                    {
                        $('#folderModal').modal('hide');
                        load_folder_list();
                        alert(data);
                    }
                });
            }
            else
            {
                alert("Enter Folder Name");
            }
        });

        $(document).on("click", ".update", function(){
            var folder_name = $(this).data("name");
            $('#old_name').val(folder_name);
            $('#folder_name').val(folder_name);
            $('#action').val("change");
            $('#folderModal').modal("show");
            $('#folder_button').val('Update');
            $('#change_title').text("Change Folder Name");
        });

        $(document).on("click", ".delete", function(){
            var folder_name = $(this).data("name");
            var action = "delete";
            if(confirm("Tem certeza de que deseja removê-lo?"))
            {
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:{folder_name:folder_name, action:action},
                    success:function(data)
                    {
                        load_folder_list();
                        alert(data);
                    }
                });
            }
        });

        $(document).on('click', '.upload', function(){
            var folder_name = $(this).data("name");
            $('#hidden_folder_name').val(folder_name);
            $('#uploadModal').modal('show');
        });

        $('#upload_form').on('submit', function(){
            $.ajax({
                url:"upload.php",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    load_folder_list();
                    alert(data);
                }
            });
        });

        $(document).on('click', '.view_files', function(){
            var folder_name = $(this).data("name");
            var action = "fetch_files";
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{action:action, folder_name:folder_name},
                success:function(data)
                {
                    $('#file_list').html(data);
                    $('#filelistModal').modal('show');
                }
            });
        });

        $(document).on('click', '.remove_file', function(){
            var path = $(this).attr("id");
            var action = "remove_file";
            if(confirm("Tem certeza de que deseja removê-lo?"))
            {
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:{path:path, action:action},
                    success:function(data)
                    {
                        alert(data);
                        $('#filelistModal').modal('hide');
                        load_folder_list();
                    }
                });
            }
        });

        $(document).on('blur', '.change_file_name', function(){
            var folder_name = $(this).data("folder_name");
            var old_file_name = $(this).data("file_name");
            var new_file_name = $(this).text();
            var action = "change_file_name";
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{folder_name:folder_name, old_file_name:old_file_name, new_file_name:new_file_name, action:action},
                success:function(data)
                {
                    alert(data);
                }
            });
        });

    });
</script>