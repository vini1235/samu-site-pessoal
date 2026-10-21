<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(2);
header('Location: administrativo.php', true, 302);
exit;
