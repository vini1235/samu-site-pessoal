<?PHP
header('Content-Type: text/html; charset=utf-8');

?>
<?php


include("../conexao.php");

// Definimos o nome do arquivo que será exportado
$arquivo = 'TISAUDE.xls';
$pesquisar = $_POST['pesquisar'];
// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">  Planilha de Saida de Toner</tr>';
$html .= '</tr>';


$html .= '<tr>';
$html .= '<td><b>ID</b></td>';
$html .= '<td><b>SAIDA</b></td>';
$html .= '<td><b>SETOR</b></td>';
$html .= '<td><b>NOME</b></td>';
$html .= '<td><b>TONER</b></td>';
$html .= '<td><b>OBS</b></td>';





$html .= '</tr>';

//Selecionar todos os itens da tabela

$result_samuform = "SELECT * FROM  saida_toner WHERE setor LIKE '%$pesquisar%'";
mysqli_set_charset($conexao,'utf8');
$resultado_samuform = mysqli_query($conexao , $result_samuform);
while($row_samuform = mysqli_fetch_assoc($resultado_samuform)){
    $html .= '<tr>';
    $html .= '<td>'.$row_samuform["id"].'</td>';
    $html .= '<td>'.$row_samuform["saida"].'</td>';
    $html .= '<td>'.$row_samuform["setor"].'</td>';
    $html .= '<td>'.$row_samuform["nome"].'</td>';
    $html .= '<td>'.$row_samuform["toner"].'</td>';
    $html .= '<td>'.$row_samuform["obs"].'</td>';



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