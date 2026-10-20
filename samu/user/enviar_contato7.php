<?PHP
header('Content-Type: text/html; charset=utf-8');
?>



<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "ti_login";

$conexao = mysqli_connect('localhost','root','');
$banco = mysqli_select_db($conexao,'ti_login');
mysqli_set_charset($conexao,'utf8');
$sql = mysqli_query($conexao,"select * from usuario") or die("Erro");

?>
<?php

$nome_usu= $_POST['nome_usu'];
$email_usu= $_POST['email_usu'];
$senha_usu= $_POST['senha_usu'];
$adm= $_POST['adm'];


$sql = mysqli_query ($conexao,"INSERT INTO usuario (nome_usu,  email_usu,  senha_usu, adm )VALUES('$nome_usu', '$email_usu', '$senha_usu', '$adm' )");

if($sql){
    header("location: cadastrar.php");


}

?>






