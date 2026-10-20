<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');
?>



<?php

$conexao = $conn;
$banco = mysqli_select_db($conexao, $dbname);
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






