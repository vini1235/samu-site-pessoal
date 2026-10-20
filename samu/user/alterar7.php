<?php
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/../conexao/conexao.php';
$msqli = $conn;
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql = "SELECT * FROM usuario where id =".$id;
    mysqli_set_charset($msqli,'utf8');
    $resultado  = $msqli->query($sql);
    if ($resultado == false){
        die ("Erro de seleção de dados");

    }
    else {

        $linha = mysqli_fetch_array($resultado);

    }
    ?>
    <html>
    <head>
        <meta charset="utf-8"/>

        <title>T.I Saude</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" type="text/css" href="estilo.css">



        <script type="text/javascript">
            $(document).ready(function(){
                $(".btn.btn-xs.btn-danger").click( function(event) {
                    var apagar = confirm('Deseja realmente excluir este registro?');
                    if (apagar){
                        // aqui vai a instrução para apagar registro
                    }else{
                        event.preventDefault();
                    }
                });
            });
        </script>

        <script type="text/javascript" src="lletras.js"></script>


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




    </head>
    <body>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Alterar Cadastro</h4>
        </div>
        <div class="modal-body">

            <form method="POST" id="form" action="cruid7.php?id=<?php echo $id; ?>&acao=atualizar">

                <ul>





                    <li>
                        <label for="nome_usu">NOME</label>

                        <input type="text" name="nome_usu" id="nome_usu" value="<?php echo $linha ["nome_usu"]; ?>" placeholder="Digite o Nome"  ><span class="required"></span>


                    </li>
                    <li>
                    <label for="email_usu">Email</label>

                    <input type="email" name="email_usu" id="email_usu"  value="<?php echo $linha ["email_usu"]; ?>"placeholder="Digite o Email"  ><span class="required"></span>
                    </li>

                    <li>

                        <label for="senha_usu">SENHA</label>
                        <input type="text" name="senha_usu" id="senha_usu"  value="<?php echo $linha ["senha_usu"]; ?>" placeholder="Digite a Senha" required="required"><span class="required"></span>

                    </li>
                   <li>
                    <label for="adm">ADM</label>
                    <select name="adm" id="adm">

                        <option <?php if ($linha['adm']=='1') echo 'selected' ; ?> value="1">ADM</option>
                        <option <?php if ($linha['adm']=='') echo 'selected' ; ?> value="">USUARIO</option>


                    </select>


                   </li>
                    <li>

                        <input type="submit" id="send_message" value="Enviar"   />


                    </li>



                </ul>



            </form>



            </form>





        </div>
        <div class="modal-footer">

        </div>
    </div>




    </body>
    </html>
    <?php
}//end if
?>

