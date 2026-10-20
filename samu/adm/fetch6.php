<?php
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';



//fetch.php
if(isset($_POST["id"]))
{
    $connect = $conn;
    $output = '';
    $query = "SELECT * FROM  tickets WHERE id = '".$_POST["id"]."'";
    $result = mysqli_query($connect, $query);

    while($row = mysqli_fetch_array($result))

    {
        $output .= '
 <h2><label>Nome:'.$row["nome"].'</label></h2>
 <p><label>Local: '.$row["setor"].'</label></p>
  <p><label>Id: '.$row["id"].'</label></p>
  <p><label>Data da entrada: '.date ("d/m/Y",strtotime($row["data_entrada"])) .'</label></p>
  <p><label>Assunto :'.$row["assunto"].'</label></p>
  <p><label>Resolvido :'.$row["resolvido"].'</label></p>
  <p><label>OBS :'.$row["obs"].'</label></p>
  <p><label>Data realizada:'.$row["data_realizada"].'</label></p>
 
      
  ';
        $query_1 = "SELECT id FROM tickets WHERE id < '".$_POST['id']."' ORDER BY id DESC LIMIT 1";
        $result_1 = mysqli_query($connect, $query_1);

        $data_1 = mysqli_fetch_assoc($result_1);
        $query_2 = "SELECT id FROM  tickets WHERE id > '".$_POST['id']."' ORDER BY id ASC LIMIT 1";
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
