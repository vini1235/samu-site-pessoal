<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(2);
require_once __DIR__ . '/../conexao/conexao.php';
$id = filter_var($_POST['cod'] ?? $_GET['cod'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    samu_users_error(422, 'Usuário inválido.');
}
try {
    $statement = $conn->prepare('DELETE FROM usuarios WHERE id = ?');
    $statement->bind_param('i', $id);
    $statement->execute();
} catch (mysqli_sql_exception $error) {
    samu_users_error(500, 'Não foi possível excluir o usuário.');
}
header('Location: usuario.php', true, 303);
exit;
