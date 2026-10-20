<?php
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/../conexao/conexao.php';


$banco = mysqli_select_db($conn, 'basesamu');
?>