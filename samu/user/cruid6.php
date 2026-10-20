<?PHP
header('Content-Type: text/html; charset=utf-8');
?>

<?php

$conexao = new mysqli('127.0.0.1', 'root', '', 'tisaude');



$acao = $_GET['acao'];

$data_realizada= $_POST['data_realizada'];

$resolvido= $_POST['resolvido'];
if(isset($_GET ["id"])){
    $id = $_GET["id"];
}
switch ($acao){
    case "atualizar":{
        $sql="UPDATE tickets SET data_realizada='$data_realizada',resolvido='$resolvido' WHERE id =".$id;
        mysqli_set_charset($conexao,'utf8');
        $resultado  = $conexao->query($sql);
        if ($resultado == false){
            die(mysqli_error());

        }

        else {

            header("location: tickets.php");



        }
        break;

    }

}
?>
