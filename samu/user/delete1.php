
<?php
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';



//Estilo procedural
$link = $conn;



$id = $_REQUEST ['cod'];

if ($link){

    $query =  mysqli_query($link,"delete from trauma where id='$id'");
    if($query){
        header("location: trauma.php");


    }else{

        die ("Erro: ".mysqli_error($link));
    }
}else{
    die("erro: ".mysqli_error($link));
}

