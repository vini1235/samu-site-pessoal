<?PHP
header('Content-Type: text/html; charset=utf-8');
?>
<html>
<head>

    <meta charset="UTF-8" >


</head>
<body>
<?php


include("conexao.php");

// Definimos o nome do arquivo que será exportado
$arquivo = 'SAMU.xls';

// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Samu Jandira  Planilha de Ocorrencia Obstetricia</tr>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td><b>ID</b></td>';
$html .= '<td><b>Tada/hora</b></td>';
$html .= '<td><b>Funcionario</b></td>';
$html .= '<td><b>Plantao</b></td>';
$html .= '<td><b>Ocorrencia</b></td>';
$html .= '<td><b>Evento</b></td>';
$html .= '<td><b>Q.R.U</b></td>';
$html .= '<td><b>Q.R.A</b></td>';
$html .= '<td><b>Q.T.H</b></td>';
$html .= '<td><b>Q.T.I</b></td>';
$html .= '<td><b>OBS</b></td>';



$html .= '</tr>';






//Selecionar todos os itens da tabela
$result_samuform = "SELECT * FROM obstetricia ";
mysqli_set_charset($conexao,'utf8');
$resultado_samuform = mysqli_query($conexao , $result_samuform);

while($row_samuform = mysqli_fetch_assoc($resultado_samuform)){
    $html .= '<tr>';
    $html .= '<td>'.$row_samuform["id"].'</td>';
    $html .= '<td>'.$row_samuform["txtdatahora"].'</td>';
    $html .= '<td>'.$row_samuform["funcionario"].'</td>';
    $html .= '<td>'.$row_samuform["plantao"].'</td>';
    $html .= '<td>'.$row_samuform["ocorrencia"].'</td>';
    $html .= '<td>'.$row_samuform["evento"].'</td>';
    $html .= '<td>'.$row_samuform["qru"].'</td>';
    $html .= '<td>'.$row_samuform["qra"].'</td>';
    $html .= '<td>'.$row_samuform["qth"].'</td>';
    $html .= '<td>'.$row_samuform["qti"].'</td>';
    $html .= '<td>'.$row_samuform["message"].'</td>';

    $html .= '</tr>';
    ;
}
// Configurações header para forçar o download

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );
// Envia o conteúdo do arquivo
echo $html;
exit; ?>
</body>
</html>