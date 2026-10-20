<?php
function samu_login_path()
{
    // Guard callers can be in adm/, user/, or their nested folders.
    $scriptPath = $_SERVER['SCRIPT_NAME'] ?? '';
    $loginPath = preg_replace('~/(?:adm|user)/.*$~', '/index.php', $scriptPath);
    return $loginPath !== $scriptPath && $loginPath !== '' ? $loginPath : 'index.php';
}

function samu_require_access_level($expectedLevel)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['usuarioId']) || empty($_SESSION['usuarioEmail']) ||
        (string) ($_SESSION['usuarioNiveisAcessoId'] ?? '') !== (string) $expectedLevel) {
        $_SESSION['loginErro'] = 'Área restrita';
        header('Location: ' . samu_login_path(), true, 302);
        exit;
    }
}

function seguranca_adm()
{
    samu_require_access_level(1);
}

function seguranca_user()
{
    samu_require_access_level(2);
}
