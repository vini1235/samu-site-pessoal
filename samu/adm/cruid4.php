<?php
header('Content-Type: text/html; charset=utf-8');

$conexao = new mysqli('127.0.0.1', 'root', '', 'basesamu');

// Verifica se todos os dados necessários estão definidos e não são nulos
if(isset($_GET['acao'], $_POST['txtdatahora'], $_POST['funcionario'], $_POST['plantao'], $_POST['ocorrencia'], $_POST['evento'], $_POST['qru'], $_POST['qra'], $_POST['qth'], $_POST['qti'], $_POST['message'], $_GET['id'])) {
    $acao = $_GET['acao'];
    $txtdatahora = $_POST['txtdatahora'];
    $funcionario = $_POST['funcionario'];
    $plantao = $_POST['plantao'];
    $ocorrencia = $_POST['ocorrencia'];
    $evento = $_POST['evento'];
    $qru = $_POST['qru'];
    $qra = $_POST['qra'];
    $qth = $_POST['qth'];
    $qti = $_POST['qti'];
    $message = $_POST['message'];
    $id = $_GET['id'];

    switch ($acao) {
        case "atualizar":
            $sql = "UPDATE ortopedia SET txtdatahora='$txtdatahora', funcionario='$funcionario', plantao='$plantao', ocorrencia='$ocorrencia', evento='$evento', qru='$qru', qra='$qra', qth='$qth', qti='$qti', message='$message' WHERE id=$id";
            mysqli_set_charset($conexao, 'utf8');
            $resultado = $conexao->query($sql);

            if ($resultado == false) {
                die(mysqli_error($conexao)); // Mostra o erro do MySQL, se houver
            } else {
                header("location: ortopedia.php");
                exit; // Saia do script depois de redirecionar
            }
            break;
    }
} else {
    echo "Dados incompletos ou incorretos.";
}
?>