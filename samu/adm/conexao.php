<?php
header('Content-Type: text/html; charset=utf-8');

// Reutiliza a conexão central.
require_once __DIR__ . '/../conexao/conexao.php';

// Compatibilidade com o nome utilizado anteriormente.
$banco = mysqli_select_db($conn, 'basesamu');
?>