<?php
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');

// Reutiliza a conexão central.


// Compatibilidade com o nome utilizado anteriormente.
$banco = mysqli_select_db($conn, $dbname);
?>