<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(1);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    samu_users_error(405, 'Use o formulário de cadastro.');
}
require_once __DIR__ . '/../conexao/conexao.php';
[$name, $email, $password, $role] = samu_users_input(true);
try {
    if (samu_users_email_exists($conn, $email)) {
        samu_users_error(409, 'Já existe um usuário com esse e-mail.');
    }
    $statement = $conn->prepare('INSERT INTO usuarios (nome, email, senha, niveis_acesso_id) VALUES (?, ?, ?, ?)');
    $statement->bind_param('sssi', $name, $email, $password, $role);
    $statement->execute();
} catch (mysqli_sql_exception $error) {
    samu_users_error(500, 'Não foi possível cadastrar o usuário.');
}
header('Location: usuario.php', true, 303);
exit;
