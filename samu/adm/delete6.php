
<?php


//Estilo procedural
$link = new mysqli('127.0.0.1', 'root', '', 'tisaude');



$id = $_REQUEST ['cod'];

if ($link){

    $query =  mysqli_query($link,"delete from tickets where id='$id'");
    if($query){
        header("location: tickets.php");


    }else{

        die ("Erro: ".mysqli_error($link));
    }
}else{
    die("erro: ".mysqli_error($link));
}