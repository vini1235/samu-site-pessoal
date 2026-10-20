
<?php


//Estilo procedural
$link = new mysqli('127.0.0.1', 'root', '', 'tisaude');



$id = $_REQUEST ['cod'];

if ($link){

    $query =  mysqli_query($link,"delete from usuarios where id='$id'");
    if($query){
        header("location: usuario.php");


    }else{

        die ("Erro: ".mysqli_error($link));
    }
}else{
    die("erro: ".mysqli_error($link));
}