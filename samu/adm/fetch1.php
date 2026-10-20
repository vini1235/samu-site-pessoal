<?PHP
header('Content-Type: text/html; charset=utf-8');

?>
<html>
<head>
    <title>SAMU-JANDIRA</title>

    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8"/>
    <style>
        p {

            font-size: 12px;
        }
        h3 {
            font-size: 14px;


        }
    </style>

</head>
<body>
<?php

//fetch.php
if(isset($_POST["id"]))
{
    $connect = mysqli_connect("localhost", "root", "", "basesamu");
    $output = '';
    $query = "SELECT * FROM trauma WHERE id = '".$_POST["id"]."'";
    mysqli_set_charset($connect,'utf8');
    $result = mysqli_query($connect, $query);

    while($row = mysqli_fetch_array($result))

    {
        $output .= '
  <h2><label>Funcionario:'.$row["funcionario"].'</label></h2>
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
        $query_1 = "SELECT id FROM trauma WHERE id < '".$_POST['id']."' ORDER BY id DESC LIMIT 1";
        $result_1 = mysqli_query($connect, $query_1);

        $data_1 = mysqli_fetch_assoc($result_1);
        $query_2 = "SELECT id FROM trauma WHERE id > '".$_POST['id']."' ORDER BY id ASC LIMIT 1";
        $result_2 = mysqli_query($connect, $query_2);

        $data_2 = mysqli_fetch_assoc($result_2);
        $if_previous_disable = '';
        $if_next_disable = '';
        if($data_1["id"] == "")
        {
            $if_previous_disable = 'enable';
        }
        if($data_2["id"] == "")
        {
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

</body>
</html>
