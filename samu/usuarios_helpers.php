<?php
function samu_users_require_role($role)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['usuarioId']) || empty($_SESSION['usuarioEmail']) ||
        (string) ($_SESSION['usuarioNiveisAcessoId'] ?? '') !== (string) $role) {
        samu_users_error(403, 'Acesso restrito. Entre na sua conta para continuar.');
    }
}

function samu_users_error($status, $message)
{
    http_response_code($status);
    header('Content-Type: text/plain; charset=utf-8');
    exit($message);
}

function samu_users_input($passwordRequired)
{
    foreach (['nome', 'email', 'senha', 'niveis_acesso_id'] as $field) {
        if (isset($_POST[$field]) && !is_string($_POST[$field])) {
            samu_users_error(422, 'Dados de usuário inválidos.');
        }
    }
    $name = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['senha'] ?? '';
    $role = $_POST['niveis_acesso_id'] ?? '';
    if ($name === '' || strlen($name) > 220 || strlen($email) > 220 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        ($passwordRequired && $password === '') || strlen($password) > 220 ||
        !in_array($role, ['1', '2'], true)) {
        samu_users_error(422, 'Informe nome, e-mail, senha e nível de acesso válidos.');
    }
    return [$name, $email, $password, (int) $role];
}

function samu_users_email_exists($conn, $email, $exceptId = 0)
{
    $statement = $conn->prepare('SELECT id FROM usuarios WHERE email = ? AND id <> ? LIMIT 1');
    $statement->bind_param('si', $email, $exceptId);
    $statement->execute();
    return $statement->get_result()->num_rows > 0;
}

function samu_users_escape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
