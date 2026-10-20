<?php
// Use only the configured database for this personal copy.
// This adapter is also included inside legacy helper functions.
global $servidor, $usuario, $senha, $dbname, $port;
require_once __DIR__ . '/../conexao/conexao.php';


$connection = new PDO("mysql:host={$servidor};port={$port};dbname={$dbname};charset=utf8mb4", $usuario, $senha);

?>