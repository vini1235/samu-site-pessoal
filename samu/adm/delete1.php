
<?php


//Estilo procedural
$link = new mysqli('127.0.0.1', 'root', '', 'basesamu');



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

