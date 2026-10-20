<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(1);
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_GET['acao'] ?? '') !== 'atualizar') {
    samu_users_error(405, 'Use o formulário de edição.');
}
require_once __DIR__ . '/../conexao/conexao.php';
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    samu_users_error(422, 'Usuário inválido.');
}
[$name, $email, $password, $role] = samu_users_input(false);
try {
    $existing = $conn->prepare('SELECT id FROM usuarios WHERE id = ?');
    $existing->bind_param('i', $id);
    $existing->execute();
    if (!$existing->get_result()->fetch_assoc()) {
        samu_users_error(404, 'Usuário não encontrado.');
    }
    if (samu_users_email_exists($conn, $email, $id)) {
        samu_users_error(409, 'Já existe um usuário com esse e-mail.');
    }
    if ($password === '') {
        $statement = $conn->prepare('UPDATE usuarios SET nome = ?, email = ?, niveis_acesso_id = ? WHERE id = ?');
        $statement->bind_param('ssii', $name, $email, $role, $id);
    } else {
        $statement = $conn->prepare('UPDATE usuarios SET nome = ?, email = ?, senha = ?, niveis_acesso_id = ? WHERE id = ?');
        $statement->bind_param('sssii', $name, $email, $password, $role, $id);
    }
    $statement->execute();
} catch (mysqli_sql_exception $error) {
    samu_users_error(500, 'Não foi possível atualizar o usuário.');
}
header('Location: usuario.php', true, 303);
exit;
