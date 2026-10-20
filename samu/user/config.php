<?php
header('Content-Type: text/html; charset=utf-8');

// Centraliza a conexão no arquivo único.
require_once __DIR__ . '/../conexao/conexao.php';

// Seleciona o banco esperado por estes scripts.
$banco = mysqli_select_db($conn, 'sistema_login');
?>