<?php
// Centraliza a conexão utilizando o arquivo único.
require_once __DIR__ . '/../conexao/conexao.php';

// Compatibilidade: expõe a mesma variável que os arquivos antigos esperavam.
$connection = $conn;
?>