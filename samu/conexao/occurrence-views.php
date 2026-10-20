<?php
require_once __DIR__ . '/occurrences.php';

function samuRenderOccurrence(string $table, int $role): void
{
    $row = samuLoadOccurrence($table, $role);
    $connection = samuOccurrenceConnection();
    header('Content-Type: text/html; charset=utf-8');
    echo '<div class="occurrence-detail"><h3>Funcionário: ' . samuOccurrenceEscape($row['funcionario']) . '</h3>';
    $fields = ['id'=>'Id', 'txtdatahora'=>'Data', 'plantao'=>'Plantão', 'ocorrencia'=>'Ocorrência',
        'evento'=>'Evento', 'qru'=>'Q.R.U', 'qra'=>'Q.R.A', 'qth'=>'Q.T.H', 'qti'=>'Q.T.I', 'message'=>'Obs'];
    foreach ($fields as $field=>$label) {
        echo '<p><strong>' . $label . ':</strong> ' . samuOccurrenceEscape($row[$field] ?? '') . '</p>';
    }
    echo '<div class="text-center">';
    foreach (['previous'=>['<','DESC','Anterior'], 'next'=>['>','ASC','Próximo']] as $button=>$settings) {
        [$operator,$direction,$label] = $settings;
        $statement = $connection->prepare("SELECT id FROM `$table` WHERE id $operator ? ORDER BY id $direction LIMIT 1");
        $statement->bind_param('i', $row['id']);
        $statement->execute();
        $neighbor = $statement->get_result()->fetch_assoc();
        $statement->close();
        $id = $neighbor ? (string)(int)$neighbor['id'] : '';
        echo '<button type="button" name="' . $button . '" class="btn btn-warning btn-sm ' . $button . '" id="' . $id . '"' . ($neighbor ? '' : ' disabled') . '>' . $label . '</button> ';
    }
    echo '</div></div>';
}

function samuExportOccurrences(string $table, int $role): void
{
    samuOccurrenceRequireUser($role);
    if ($table !== 'samuform') { samuOccurrenceTable($table); }
    $connection = samuOccurrenceConnection();
    $result = $connection->query("SELECT id,txtdatahora,funcionario,plantao,ocorrencia,evento,qru,qra,qth,qti,message FROM `$table`");
    $filename = $table === 'samuform' ? 'SAMU15082018.xls' : 'SAMU.xls';
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: no-store');
    echo '<!DOCTYPE html><html lang="pt-br"><head><meta charset="utf-8"></head><body><table border="1">';
    echo '<tr><th colspan="11">SAMU Jandira — Exportação de ocorrências</th></tr><tr>';
    foreach (['ID','Data/hora','Funcionário','Plantão','Ocorrência','Evento','Q.R.U','Q.R.A','Q.T.H','Q.T.I','OBS'] as $label) {
        echo '<th>' . $label . '</th>';
    }
    echo '</tr>';
    while ($row = $result->fetch_row()) {
        echo '<tr>';
        foreach ($row as $value) { echo '<td style="mso-number-format:\'\\@\'">' . samuOccurrenceEscape($value) . '</td>'; }
        echo '</tr>';
    }
    echo '</table></body></html>';
}

function samuDeleteRecord(string $table, int $role, string $redirect): void
{
    samuOccurrenceRequireUser($role);
    if (!preg_match('/^markers[1-6]$/D', $table)) { samuOccurrenceTable($table); }
    $id = samuOccurrenceId($_POST['cod'] ?? $_GET['cod'] ?? null);
    $connection = samuOccurrenceConnection();
    $statement = $connection->prepare("DELETE FROM `$table` WHERE id = ? LIMIT 1");
    $statement->bind_param('i', $id);
    $statement->execute();
    $statement->close();
    header('Location: ' . $redirect, true, 302);
    exit;
}
