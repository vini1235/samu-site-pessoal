
<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');
?>
<html>

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/signin.css" rel="stylesheet">
    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon"/>
    <script src="../js/ie-emulation-modes-warning.js"></script>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.css.map" rel="stylesheet">
    <link href="../css/bootstrap.min.css.map" rel="stylesheet">



</head>
<body>
<?php

$conexao = $conn;


$acao = $_GET['acao'];
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
if(isset($_GET ["id"])){
    $id = $_GET["id"];


}
switch ($acao){
    case "atualizar":{
        $sql="UPDATE trauma SET txtdatahora='$txtdatahora',funcionario='$funcionario',plantao='$plantao',ocorrencia='$ocorrencia',evento='$evento',qru ='$qru',qra ='$qra', qth='$qth', qti='$qti',message='$message' WHERE id =".$id;
        mysqli_set_charset($conexao,'utf8');
        $resultado  = $conexao->query($sql);

        if ($resultado == false){
            die(mysqli_error());

        }

        else {


            header("location: trauma.php");





        }
        break;

    }

}
?>
<?php

?>