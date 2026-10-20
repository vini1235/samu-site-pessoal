<?php header ('Content-type: text/html; charset=ISO-8859-1');?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabela samu</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="secretaria da saude" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">




    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon"/>

    <link rel="stylesheet" type="text/css" href="tabela.css">
    <link rel="stylesheet" type="text/css" href="estilo.css">




</head>
<body>
<?PHP include('menu.php'); ?>

<?PHP
#session_start();
if(isset($_SESSION['nome_usu_sessao']))
{
?>
<div class="borda2 padding20">




    <div align="center">
        <img src="../imagens/samu.png"  alt="some_text"/>
    </div>

    <div class="section group">

        <h1 id="centro"> Formulario Samu Jandira</h1>

        <br>
        <a href="gerarExcel.php">Gerar relatorio em Excel</a>
        <br>
        <br>


        <a href="conteudo.php" button class="button button2" >voltar </a></button>
        <br>
        <br>





        <br>


        <h1> formulario de apontamento geografico de ocorrência</h1>

        <iframe  src="../maps1/form.php" title="Registrar localização da ocorrência" width="800" height="700" scrolling="no"></iframe>



    </div>
    <br>
    <br>
    <?PHP
    }
    else
    {
        ?>
        <div class="borda1 padding20">
            <center> <img  src="../imagens/lock.png" width="150"></center>
            <br>
            <br>
            Esta é uma área restrita, por favor, <a href="../index.php"><strong>efetue login</strong></a>.
        </div>
        <?PHP
    }
    ?>




    <footer id="rodape">

        <p>Copyright &copy; 2017 - by Renato Cristian  WEB Designer <br/>




    </footer>
</body>
</html>
