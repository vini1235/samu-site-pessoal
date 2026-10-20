<?php


//Estilo procedural
$link = new mysqli('127.0.0.1', 'root', '', 'basesamu');



$id = $_REQUEST ['cod'];

if ($link){

    $query =  mysqli_query($link,"delete from markers2 where id='$id'");
    if($query){
        header("location: maps/maps2.php");


    }else{

        die ("Erro: ".mysqli_error($link));
    }
}else{
    die("erro: ".mysqli_error($link));
}
