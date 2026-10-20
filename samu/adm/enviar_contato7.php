<?php
// Compatibility with the old registration form; use the current users endpoint.
$_POST['nome'] = $_POST['nome'] ?? $_POST['nome_usu'] ?? '';
$_POST['email'] = $_POST['email'] ?? $_POST['email_usu'] ?? '';
$_POST['senha'] = $_POST['senha'] ?? $_POST['senha_usu'] ?? '';
$_POST['niveis_acesso_id'] = $_POST['niveis_acesso_id'] ?? (($_POST['adm'] ?? '') === '1' ? '1' : '2');
require __DIR__ . '/cadastrar.php';
