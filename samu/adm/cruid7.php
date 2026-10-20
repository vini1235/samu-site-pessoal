<?PHP
header('Content-Type: text/html; charset=utf-8');
?>

<?php

$conexao = new mysqli('127.0.0.1', 'root', '', 'ti_login');



$acao = $_GET['acao'];
$nome_usu= $_POST ['nome_usu'];
$email_usu= $_POST['email_usu'];
$senha_usu= $_POST['senha_usu'];
$adm= $_POST['adm'];

if(isset($_GET ["id"])){
    $id = $_GET["id"];
}
switch ($acao){
    case "atualizar":{
        $sql="UPDATE usuario SET nome_usu='$nome_usu',email_usu='$email_usu',senha_usu='$senha_usu',adm ='$adm' WHERE id =".$id;
        mysqli_set_charset($conexao,'utf8');
        $resultado  = $conexao->query($sql);
        if ($resultado == false){
            die(mysqli_error());

        }

        else {

            header("location: cadastrar.php");



        }
        break;

    }

}
?>
