
<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');

?>

<?php
session_start();




$conexao = $conn;
$banco = mysqli_select_db($conexao, $dbname);
mysqli_set_charset($conexao,'utf8');
$sql = mysqli_query($conexao,"select * from clinica") or die("Erro");

?>
<?php

$txtdatahora= $_POST['txtdatahora'];
$funcionario= $_POST ['funcionario'];
$plantao= $_POST['plantao'];
$ocorrencia= $_POST['ocorrencia'];
$evento= $_POST['evento'];
$qru= $_POST['qru'];
$qra= $_POST['qra'];
$qth= $_POST['qth'];
$qti= $_POST['qti'];
$message= $_POST['message'];

$sql = mysqli_query ($conexao,"INSERT INTO clinica(txtdatahora,funcionario, plantao, ocorrencia, evento, qru, qra, qth, qti,message )VALUES('$txtdatahora','$funcionario', '$plantao', '$ocorrencia', '$evento', '$qru','$qra','$qth','$qti','$message' )");
 if($sql){
        header("location: clinica.php");


    }


?>




