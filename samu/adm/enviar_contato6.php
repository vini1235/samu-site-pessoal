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
$sql = mysqli_query($conexao,"select * from tickets") or die("Erro");

?>
<?php

$data_realizada= $_POST['data_realizada'];

$resolvido= $_POST['resolvido'];

$sql = mysqli_query ($conexao,"INSERT INTO tickets(, data_realizada, resolvido  )VALUES('$data_realizada','$resolvido' )");

if($sql){
    header("location: tickets.php");


}



?>



