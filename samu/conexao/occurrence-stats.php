<?php

function samu_occurrence_chart_rows(mysqli $conn): array
{
    // Each table represents one specialty. Free-text labels can be empty or misspelled.
    $result = $conn->query("SELECT 'Clínica médica' AS especialidade, COUNT(*) AS total FROM clinica
        UNION ALL SELECT 'Trauma', COUNT(*) FROM trauma
        UNION ALL SELECT 'Obstetrícia', COUNT(*) FROM obstetricia
        UNION ALL SELECT 'Pediatria', COUNT(*) FROM pediatria
        UNION ALL SELECT 'Ortopedia', COUNT(*) FROM ortopedia
        UNION ALL SELECT 'Psiquiatria', COUNT(*) FROM psiquiatria");
    $rows = [['Especialidade', 'Ocorrências']];
    while ($row = $result->fetch_assoc()) {
        $rows[] = [$row['especialidade'], (int) $row['total']];
    }
    return $rows;
}
