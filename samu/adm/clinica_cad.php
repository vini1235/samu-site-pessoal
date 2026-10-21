<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(1);
header('Location: clinica.php', true, 302);
exit;
