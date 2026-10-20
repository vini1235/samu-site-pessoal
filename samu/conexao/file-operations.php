<?php
require_once __DIR__ . '/occurrences.php';

function samuFileSegment($name): string
{
    if (!is_string($name) || trim($name) === '' || $name !== trim($name) ||
        $name === '.' || $name === '..' || strpbrk($name, "/\\<>:\"|?*") !== false ||
        preg_match('/[\x00-\x1F]/', $name) || str_ends_with($name, '.') ||
        preg_match('/^(CON|PRN|AUX|NUL|COM[1-9]|LPT[1-9])(?:\.|$)/i', $name)) {
        samuOccurrenceError(400, 'Informe um nome de arquivo ou pasta válido.');
    }
    return $name;
}

function samuFileFolder(string $root, $name, bool $mustExist = true): string
{
    $name = samuFileSegment($name);
    $path = $root . DIRECTORY_SEPARATOR . $name;
    if (is_link($path)) { samuOccurrenceError(400, 'Pasta inválida.'); }
    if (file_exists($path)) {
        $resolved = realpath($path);
        if (!is_dir($path) || !$resolved || strcasecmp(dirname($resolved), realpath($root)) !== 0) {
            samuOccurrenceError(400, 'Pasta inválida.');
        }
    } elseif ($mustExist) { samuOccurrenceError(404, 'Pasta não encontrada.'); }
    return $path;
}

function samuFilePath(string $root, $folder, $file): string
{
    $path = samuFileFolder($root, $folder) . DIRECTORY_SEPARATOR . samuFileSegment($file);
    if (is_link($path) || (file_exists($path) && (!is_file($path) || strcasecmp(dirname(realpath($path)), realpath(dirname($path))) !== 0))) {
        samuOccurrenceError(400, 'Arquivo inválido.');
    }
    return $path;
}

function samuFileExtension(string $name): string
{
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (!in_array($extension, ['jpg','jpeg','png','gif','rar','zip','pdf','sql','doc','docx','xml','xls','xlsx','xlt','exe','txt'], true)) {
        samuOccurrenceError(400, 'Tipo de arquivo não permitido.');
    }
    return $extension;
}

function samuGuardFileAction(string $root, int $role): void
{
    samuOccurrenceRequireUser($role);
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { samuOccurrenceError(405, 'Envie a operação pelo formulário.'); }
    $action = $_POST['action'] ?? '';
    if (!is_string($action) || !in_array($action, ['fetch','create','change','delete','fetch_files','remove_file','change_file_name'], true)) {
        samuOccurrenceError(400, 'Operação inválida.');
    }
    chdir($root);
    if ($action === 'fetch') { return; }
    if ($action === 'remove_file') {
        $parts = is_string($_POST['path'] ?? null) ? explode('/', str_replace('\\', '/', $_POST['path'])) : [];
        if (count($parts) !== 2) { samuOccurrenceError(400, 'Caminho inválido.'); }
        samuFilePath($root, $parts[0], $parts[1]);
        return;
    }
    $folder = samuFileFolder($root, $_POST['folder_name'] ?? null, !in_array($action, ['create','change'], true));
    if ($action === 'change') { samuFileFolder($root, $_POST['old_name'] ?? null); }
    if ($action === 'delete') {
        foreach (scandir($folder) as $name) {
            if ($name === '.' || $name === '..') { continue; }
            samuFilePath($root, $_POST['folder_name'], $name);
        }
    }
    if ($action === 'change_file_name') {
        samuFilePath($root, $_POST['folder_name'], $_POST['old_file_name'] ?? null);
        $new = samuFilePath($root, $_POST['folder_name'], $_POST['new_file_name'] ?? null);
        samuFileExtension($new);
        if (file_exists($new)) { samuOccurrenceError(409, 'Já existe um arquivo com esse nome.'); }
    }
}

function samuUploadFile(string $root, int $role): void
{
    samuOccurrenceRequireUser($role);
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { samuOccurrenceError(405, 'Envie o arquivo pelo formulário.'); }
    $file = $_FILES['upload_file'] ?? null;
    if (!is_array($file) || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_string($file['name'] ?? null)) {
        samuOccurrenceError(400, 'Selecione um arquivo válido dentro do limite de envio.');
    }
    $extension = samuFileExtension(samuFileSegment($file['name']));
    $folder = samuFileFolder($root, $_POST['hidden_folder_name'] ?? null);
    $target = $folder . DIRECTORY_SEPARATOR . bin2hex(random_bytes(16)) . '.' . $extension;
    if (!move_uploaded_file($file['tmp_name'], $target)) { samuOccurrenceError(500, 'Não foi possível salvar o arquivo.'); }
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Arquivo enviado com sucesso.';
}
