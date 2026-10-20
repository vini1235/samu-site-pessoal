<?PHP
require_once __DIR__ . '/../conexao/conexao.php';
$msqli = $conn;

?>

<?php
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql = "SELECT * FROM tickets where id =".$id;
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
 <link rel="stylesheet" href="../css/bootstrap.min.css">


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
            <h4 class="modal-title">Finalizarr</h4>
        </div>
        <div class="modal-body">

            <form method="POST" id="form" action="cruid6.php?id=<?php echo $id; ?>&acao=atualizar">

                <ul>





                    <li>
                        <label for="data_realizada">Data</label>

                        <input type="date" name="data_realizada" id="data_realizada"value="<?php echo $linha ["data_realizada"]; ?>"  ><date-util format="dd/MM/yyyy"></date-util><span class="required"></span>


                    </li>

                    <li>

                        <label for="resolvido">obs</label>
                        <input type="text" class="form-control" name="resolvido" id="obs" value="<?php echo $linha ["resolvido"]; ?>"   placeholder="Digite o defeito" required="required"><span class="required"></span>
                      
                    </li>
                      <li>

                        <input type="submit" id="send_message" value="Enviar"   />


                    </li>



                </ul>
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

