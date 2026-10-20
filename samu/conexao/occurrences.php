<?php

function samuOccurrenceError($status, $message)
{
    http_response_code($status);
    header('Content-Type: text/plain; charset=utf-8');
    echo $message;
    exit;
}

function samuOccurrenceRequireUser($requiredRole)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['usuarioId']) || empty($_SESSION['usuarioEmail'])) {
        samuOccurrenceError(401, 'Entre no sistema para continuar.');
    }
    if ((int) ($_SESSION['usuarioNiveisAcessoId'] ?? 0) !== $requiredRole) {
        samuOccurrenceError(403, 'Seu perfil não permite esta operação.');
    }
}

function samuOccurrenceTable($table)
{
    $allowed = ['clinica', 'trauma', 'obstetricia', 'pediatria', 'ortopedia', 'psiquiatria'];
    if (!in_array($table, $allowed, true)) {
        samuOccurrenceError(500, 'Não foi possível identificar a especialidade.');
    }
    return $table;
}

function samuOccurrenceConnection()
{
    global $conn;
    require_once __DIR__ . '/conexao.php';
    $conn->set_charset('utf8mb4');
    return $conn;
}

function samuOccurrenceId($value)
{
    if (!is_string($value) && !is_int($value)) {
        samuOccurrenceError(400, 'Informe um identificador de ocorrência válido.');
    }
    $id = filter_var($value, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 2147483647],
    ]);
    if ($id === false) {
        samuOccurrenceError(400, 'Informe um identificador de ocorrência válido.');
    }
    return $id;
}

function samuOccurrenceEscape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function samuLoadOccurrence($table, $requiredRole)
{
    samuOccurrenceRequireUser($requiredRole);
    $table = samuOccurrenceTable($table);
    $id = samuOccurrenceId($_POST['id'] ?? $_GET['id'] ?? null);
    try {
        $connection = samuOccurrenceConnection();
        $statement = $connection->prepare("SELECT * FROM `$table` WHERE id = ?");
        $statement->bind_param('i', $id);
        $statement->execute();
        $row = $statement->get_result()->fetch_assoc();
        $statement->close();
        if (!$row) {
            samuOccurrenceError(404, 'Ocorrência não encontrada.');
        }
        return $row;
    } catch (mysqli_sql_exception $error) {
        samuOccurrenceError(500, 'Não foi possível carregar a ocorrência. Tente novamente.');
    }
}

function samuSaveOccurrence($table, $requiredRole, $mode)
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        header('Allow: POST');
        samuOccurrenceError(405, 'Envie os dados pelo formulário.');
    }
    samuOccurrenceRequireUser($requiredRole);
    $table = samuOccurrenceTable($table);
    if ($mode !== 'create' && $mode !== 'update') {
        samuOccurrenceError(500, 'Não foi possível identificar a operação.');
    }
    $id = null;
    if ($mode === 'update') {
        if (($_GET['acao'] ?? '') !== 'atualizar') {
            samuOccurrenceError(400, 'A operação de edição é inválida.');
        }
        $id = samuOccurrenceId($_GET['id'] ?? null);
    }

    $fields = [
        'txtdatahora' => 'Data/Hora',
        'funcionario' => 'Funcionário',
        'plantao' => 'Plantão',
        'ocorrencia' => 'Ocorrência',
        'evento' => 'Nº do evento',
        'qru' => 'Q.R.U',
        'qra' => 'Q.R.A',
        'qth' => 'Q.T.H',
        'qti' => 'Q.T.I',
        'message' => 'Observação',
    ];
    $values = [];
    foreach ($fields as $name => $label) {
        if (!isset($_POST[$name]) || !is_string($_POST[$name])) {
            samuOccurrenceError(400, "O campo $label não foi enviado corretamente.");
        }
        $value = $_POST[$name];
        if (trim($value) === '') {
            samuOccurrenceError(422, "Preencha o campo $label.");
        }
        $length = preg_match_all('/./us', $value);
        if ($length === false) {
            samuOccurrenceError(422, "O campo $label contém texto inválido.");
        }
        if ($length > 250) {
            samuOccurrenceError(422, "O campo $label deve ter no máximo 250 caracteres.");
        }
        $values[] = $value;
    }

    try {
        $connection = samuOccurrenceConnection();
        if ($mode === 'create') {
            $statement = $connection->prepare(
                "INSERT INTO `$table` (txtdatahora, funcionario, plantao, ocorrencia, evento, qru, qra, qth, qti, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            $statement->bind_param('ssssssssss', ...$values);
        } else {
            $exists = $connection->prepare("SELECT id FROM `$table` WHERE id = ?");
            $exists->bind_param('i', $id);
            $exists->execute();
            $found = $exists->get_result()->fetch_assoc();
            $exists->close();
            if (!$found) {
                samuOccurrenceError(404, 'Ocorrência não encontrada.');
            }
            $statement = $connection->prepare(
                "UPDATE `$table` SET txtdatahora=?, funcionario=?, plantao=?, ocorrencia=?, evento=?, qru=?, qra=?, qth=?, qti=?, message=? WHERE id=?"
            );
            $values[] = $id;
            $statement->bind_param('ssssssssssi', ...$values);
        }
        $statement->execute();
        $statement->close();
    } catch (mysqli_sql_exception $error) {
        if (in_array((int) $error->getCode(), [1048, 1366, 1406], true)) {
            samuOccurrenceError(422, 'Revise o tamanho e os caracteres dos campos antes de salvar.');
        }
        samuOccurrenceError(500, 'Não foi possível salvar a ocorrência. Tente novamente.');
    }

    header("Location: $table.php", true, 302);
    exit;
}
