
<?php
require("conexao.php");

function parseToXML($htmlStr){
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

// Verifique se as datas inicial e final foram fornecidas na solicitação
if(isset($_GET['initialDate']) && isset($_GET['finalDate'])) {
    // Obter datas iniciais e finais da solicitação
    $initialDate = date("Y-m-d", strtotime($_GET['initialDate']));
    $finalDate = date("Y-m-d", strtotime($_GET['finalDate']));

    // Consulta SQL para selecionar marcadores dentro do intervalo de datas fornecido
    $query = "SELECT * FROM markers1 WHERE date BETWEEN '$initialDate' AND '$finalDate'";
    
    // Executar a consulta SQL
    $resultado_markers = mysqli_query($conn, $query);

    header("Content-type: text/xml");

    // Iniciar o arquivo XML, ecoando o nó pai
    echo '<markers>';

    // Iterar pelas linhas, imprimindo nós XML para cada uma
    while ($row_markers = mysqli_fetch_assoc($resultado_markers)){
        // Adicionar ao nó do documento XML
        echo '<marker ';
        echo 'name="' . parseToXML($row_markers['name']) . '" ';
        echo 'address="' . parseToXML($row_markers['address']) . '" ';
        echo 'lat="' . $row_markers['lat'] . '" ';
        echo 'lng="' . $row_markers['lng'] . '" ';
        echo 'type="' . $row_markers['type'] . '" ';
        echo 'entrada="' . $row_markers['entrada'] . '" ';
        echo '/>';
    }

    // Finalizar o arquivo XML
    echo '</markers>';
} else {
    // Caso as datas inicial e final não sejam fornecidas, retorne uma mensagem de erro
    echo "Erro: Datas inicial e final não fornecidas.";
}
?>