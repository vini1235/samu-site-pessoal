<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');
?>

<?php



$conexao = $conn;
$banco = mysqli_select_db($conexao, $dbname);
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



