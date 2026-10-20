<?PHP
header('Content-Type: text/html; charset=utf-8');

?>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "tisaude";



$conexao = mysqli_connect('localhost','root','');
$banco = mysqli_select_db($conexao,'tisaude');
mysqli_set_charset($conexao,'utf8');
$sql = mysqli_query($conexao,"select * from usuarios") or die("Erro");

?>
<?php

$nome= $_POST['nome'];
$email= $_POST['email'];
$senha= $_POST['senha'];
$niveis_acesso_id= $_POST['niveis_acesso_id'];


$sql = mysqli_query ($conexao,"INSERT INTO usuarios(nome,  email, senha, niveis_acesso_id )VALUES('$nome','$email', '$senha', '$niveis_acesso_id' )");

header("location: usuario.php");


?>




