<?php
session_start();
ob_start();
// Export only the database configured for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';
include_once __DIR__ . '/gerar_backup.php';
header('Location: ../adm/administrativo.php');