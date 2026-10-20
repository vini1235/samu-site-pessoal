<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM equipamentos ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE data_entrada LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR setor LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR equipamento LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR numero LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR obs LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
    $url_pdf = "gerar_pdf5.php?cod=".$row["id"] ;


	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="../upload/'.$row["image"].'" class="img-thumbnail" width="55" height="35" />';
	}
	else
	{
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = $image;
	$sub_array[] = $row["data_entrada"];
	$sub_array[] = $row["setor"];
    $sub_array[] = $row["equipamento"];
    $sub_array[] = $row["numero"];
    $sub_array[] = $row["obs"];
    $sub_array[] = '<a type="button" name="view"  id="'.$row["id"].'" class="btn btn-info view">+</a>';
    $sub_array[] = '<a type="button" href= '.$url_pdf.'  target="_blank" style="color:White;" class="btn btn-warning ">PDF</a>';
    $sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary update">Update</button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>