<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM equipamentos 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["data_entrada"] = $row["data_entrada"];
		$output["setor"] = $row["setor"];
        $output["equipamento"] = $row["equipamento"];
        $output["numero"] = $row["numero"];
        $output["obs"] = $row["obs"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="../upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>