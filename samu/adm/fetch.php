<?php
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

//fetch.php
if(isset($_POST["id"])) {
    $connect = $conn;
    $output = '';
    $query = "SELECT * FROM clinica WHERE id = '".$_POST["id"]."'";
    mysqli_set_charset($connect,'utf8');
    $result = mysqli_query($connect, $query);

    while($row = mysqli_fetch_array($result)) {
        $output .= '
            <h3><label>Funcionario:'.$row["funcionario"].'</label></h3>
            <p><label>Id: '.$row["id"].'</label></p>
            <p><label>Data: '.$row["txtdatahora"].'</label></p>
            <p><label>Plantao: '.$row["plantao"].'</label></p>
            <p><label>Ocorrencia:'.$row["ocorrencia"].'</label></p>
            <p><label>Evento:'.$row["evento"].'</label></p>
            <p><label>Q.R.U:'.$row["qru"].'</label></p>
            <p><label>Q.R.A:'.$row["qra"].'</label></p>
            <p><label>Q.T.H:'.$row["qth"].'</label></p>
            <p><label>Q.T.I:'.$row["qti"].'</label></p>
            <p><label>Obs:'.$row["message"].'</label></p>
        ';

        $query_1 = "SELECT id FROM clinica WHERE id < '".$_POST['id']."' ORDER BY id DESC LIMIT 1";
        $result_1 = mysqli_query($connect, $query_1);
        $data_1 = mysqli_fetch_assoc($result_1);

        $query_2 = "SELECT id FROM clinica WHERE id > '".$_POST['id']."' ORDER BY id ASC LIMIT 1";
        $result_2 = mysqli_query($connect, $query_2);
        $data_2 = mysqli_fetch_assoc($result_2);

        $if_previous_disable = '';
        $if_next_disable = '';

        // Verificar se há resultados da consulta 1
        if ($data_1 !== null && isset($data_1["id"])) {
            $if_previous_disable = 'enable';
        }

        // Verificar se há resultados da consulta 2
        if ($data_2 !== null && isset($data_2["id"])) {
            $if_next_disable = 'enable';
        }

        $output .= '
            <br /><br />
            <div align="center">
                <button type="button" name="previous" class="btn btn-warning btn-sm previous" id="'.$data_1["id"].'" '.$if_previous_disable.'>Previous</button>
                <button type="button" name="next" class="btn btn-warning btn-sm next" id="'.$data_2["id"].'" '.$if_next_disable.'>Next</button>
            </div>
            <br /><br />
        ';
    }
    echo $output;
}
?>


