<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(2);
require_once __DIR__ . '/../conexao/conexao.php';
header('Content-Type: text/html; charset=utf-8');
$result = $conn->query('SELECT id, nome, email, niveis_acesso_id FROM usuarios ORDER BY id DESC');
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
        function somenteNumeros(num) {
            var er = /[^0-9.]/;
            er.lastIndex = 0;
            var campo = num;
            if (er.test(campo.value)) {
                campo.value = "";
            }
        }
    </script>



    <script type="text/javascript">
        /* Máscaras ER */
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mtel(v){
            v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
            v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('telefone').onkeyup = function(){
                mascara( this, mtel );
            }
        }
    </script>



</head>
<body role="document">
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>


<header class="site-header push">TI-SAÚDE</header>


<!-- Pushy Menu -->
<?php require_once dirname(__DIR__) . '/navigation.php'; samuAuxiliaryMenu(); ?>



<div class="site-overlay"></div>

<!-- Your Content -->
<div id="container">
    <!-- Menu Button -->
    <button class="menu-btn">&#9776; Menu</button>





    <hr class="featurette-divider">




    <div align="center">
        <img src="../imagens/logo-jandira.png"  alt="some_text"/>
    </div>
    <h1 id="centro">Cadastro de Usuário </h1>
    <div class="section group">





        <br>
        <div class="container-fluid">
            <h3 align="center"></h3>
            <br />
            <div class="table-responsive">

                <div class="pull-right">


                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar</button>



                </div>
                <br>
                <!-- Inicio Modal -->
                <div class="modal fade" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center" id="myModalLabel">Cadastro de cliente</h4>
                            </div>
                            <div class="modal-body">

                                <form action="cadastrar.php"class="form-control" method="POST" id="form" enctype="multipart/form-data">
                                    <ul>

                                        <li>
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome"id="nome" placeholder="Digite o nome e o sobrenome">
                                        </li>
                                        <li>
                                            <label for="email">E-mail</label>
                                            <input type="email" name="email"id="email" placeholder="Digite o seu e-mail">
                                        </li>

                                        <li>
                                            <label for="senha">Senha</label>
                                            <input type="password" name="senha" id="senha" placeholder="Digite a senha">
                                        </li>
                                        <li>
                                            <label for="niveis_acesso_id">ADM</label>
                                            <select name="niveis_acesso_id" id="niveis_acesso_id">

                                                <option value="1">ADM</option>
                                                <option value="2">USUARIO</option>


                                            </select>
                                        </li>

                                        <li>
                                            <input type="submit" name="btnCadUsuario"class="btn btn-success"style="color:White;"  value="Cadastrar">
                                        </li>

                                    </ul>


                                </form>


                            </div>
                            <div class="modal-footer">




                            </div>

                        </div>
                    </div>
                </div>

                <br>

                <table   id="employee_data" class="display" cellspacing="0" width="100%">

                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>NOME</td>
                        <td>EMAIL</td>
                        <td>NIVEL ACESSO</td>
                        <td>EDITAR</td>
                        <td>EXCLUIR</td>
                    </tr>
                    </thead>


                    <?php
                    while($row = mysqli_fetch_array($result))

                    {
                        $url_pdf = "gerar_pdf.php?cod=".$row["id"] ;

                        $url_excluir = "delete7.php?cod=".$row["id"];

                        echo '
                               <tr xmlns="http://www.w3.org/1999/html">

                                    <td>' .$row["id"].'</td>							
                                    <td>'.samu_users_escape($row["nome"]).'</td>
                                    <td>'.samu_users_escape($row["email"]).'</td>
                                    <td>'.$row["niveis_acesso_id"].'</td>
                                 
                        
                        
                               
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



    <!-- Inicio Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div id="content-data"></div>
        </div>
    </div>
    <!-- Fim Modal -->


    <!--script js for get edit data-->
    <script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'alterar7.php',
                type:'POST',
                data:'id='+id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fail(function(){
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



<script>
$(function () {
    $('#employee_data').DataTable();
});
</script>
</body>
</html>
