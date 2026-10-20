<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../conexao/conexao.php';
mysqli_set_charset($conn, 'utf8');

$columns = [
    'id',
    'txtdatahora',
    'funcionario',
    'plantao',
    'ocorrencia',
    'evento',
    'qru',
    'qra',
    'qth',
    'qti',
    'message',
    'action_view',
    'action_edit'
];
$searchableColumns = array_slice($columns, 0, 11);

$draw = isset($_POST['draw']) ? (int) $_POST['draw'] : 0;
$start = isset($_POST['start']) ? (int) $_POST['start'] : 0;
$length = isset($_POST['length']) ? (int) $_POST['length'] : 25;
$length = $length > 0 ? $length : 25;
$searchValue = isset($_POST['search']['value']) ? trim($_POST['search']['value']) : '';
$orderColumnIndex = isset($_POST['order'][0]['column']) ? (int) $_POST['order'][0]['column'] : 0;
$orderDirection = (isset($_POST['order'][0]['dir']) && strtolower($_POST['order'][0]['dir']) === 'asc') ? 'ASC' : 'DESC';
$orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id';
$orderColumn = ($orderColumn === 'action_view' || $orderColumn === 'action_edit') ? 'id' : $orderColumn;
$typeFilter = isset($_GET['type']) ? trim($_GET['type']) : '';

// Mapeamento de tipo para tabela do banco
$tableMap = [
    'CLINICA MEDICA' => 'clinica',
    'TRAUMA'         => 'trauma',
    'OBSTETRICIA'    => 'obstetricia',
    'PEDIATRIA'      => 'pediatria',
    'ORTOPEDIA'      => 'ortopedia',
    'PSIQUIATRIA'    => 'psiquiatria',
];

$tableName = isset($tableMap[$typeFilter]) ? $tableMap[$typeFilter] : 'clinica';

function bindParams($stmt, $types, $params)
{
    if ($types !== '' && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
}

function runCount($conn, $sql, $types, $params)
{
    $stmt = $conn->prepare($sql);
    bindParams($stmt, $types, $params);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return (int) $count;
}

$baseWhere = [];
$baseParams = [];
$baseTypes = '';

$whereBaseSql = '';

$searchWhere = $baseWhere;
$searchParams = $baseParams;
$searchTypes = $baseTypes;

if ($searchValue !== '') {
    $searchParts = [];
    foreach ($searchableColumns as $columnName) {
        $searchParts[] = "$columnName LIKE ?";
        $searchParams[] = '%' . $searchValue . '%';
        $searchTypes .= 's';
    }
    $searchWhere[] = '(' . implode(' OR ', $searchParts) . ')';
}

$whereSearchSql = $searchWhere ? 'WHERE ' . implode(' AND ', $searchWhere) : '';

$totalRecords = runCount($conn, "SELECT COUNT(*) AS total FROM $tableName", '', []);
$filteredRecords = runCount($conn, "SELECT COUNT(*) AS total FROM $tableName $whereSearchSql", $searchTypes, $searchParams);

$dataSql = "SELECT id, txtdatahora, funcionario, plantao, ocorrencia, evento, qru, qra, qth, qti, message
            FROM $tableName
            $whereSearchSql
            ORDER BY $orderColumn $orderDirection
            LIMIT ? OFFSET ?";

$stmt = $conn->prepare($dataSql);
$dataTypes = $searchTypes . 'ii';
$dataParams = array_merge($searchParams, [$length, $start]);
bindParams($stmt, $dataTypes, $dataParams);
$stmt->execute();
$result = $stmt->get_result();

$rows = [];
while ($row = $result->fetch_assoc()) {
    $id = (int) $row['id'];
    $rows[] = [
        $id,
        htmlspecialchars($row['txtdatahora'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['funcionario'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['plantao'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['ocorrencia'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['evento'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['qru'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['qra'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['qth'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['qti'], ENT_QUOTES, 'UTF-8'),
        htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8'),
        '<a name="view" class="btn btn-info view" id="' . $id . '">+</a>',
        '<a id="getEdit" class="btn btn-primary" style="color:White;" data-toggle="modal" data-target="#myModal" data-id="' . $id . '">Editar</a>'
    ];
}
$stmt->close();

$response = [
    'draw' => $draw,
    'recordsTotal' => $totalRecords,
    'recordsFiltered' => $filteredRecords,
    'data' => $rows
];

echo json_encode($response);