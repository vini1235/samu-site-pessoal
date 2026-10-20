<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO equipamentos (data_entrada, setor, equipamento, numero, obs, image) 
			VALUES (:data_entrada,:setor,:equipamento,:numero,:obs,:image)
		");
		$result = $statement->execute(
			array(

                ':data_entrada'	=>	$_POST["data_entrada"],
                ':setor'	=>	$_POST["setor"],
                ':equipamento'	=>	$_POST["equipamento"],
                ':numero'	=>	$_POST["numero"],
                ':obs'	=>	$_POST["obs"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE equipamentos
			SET data_entrada = :data_entrada, setor = :setor, equipamento = :equipamento, numero = :numero, obs = :obs, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':data_entrada'	=>	$_POST["data_entrada"],
				':setor'	=>	$_POST["setor"],
                ':equipamento'	=>	$_POST["equipamento"],
                ':numero'	=>	$_POST["numero"],
                ':obs'	=>	$_POST["obs"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>