<?php
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

//action.php
if(isset($_POST["action"]))
{
    $connect = $conn;
    if($_POST["action"] == "fetch")
    {
        $query = "SELECT * FROM equipamentos ORDER BY id DESC";
        $result = mysqli_query($connect, $query);

    }

    if($_POST["action"] == "insert")
    {
        $file = addslashes(file_get_contents($_FILES["image_file"]["tmp_name"]));
        $query = "INSERT INTO equipamentos(name) VALUES ('$file')";
        if(mysqli_query($connect, $query))
        {
            echo 'Image Inserted into Database';
        }
    }
    if($_POST["action"] == "update")
    {
        $file = addslashes(file_get_contents($_FILES["image_file"]["tmp_name"]));
        $query = "UPDATE tbl_images SET name = '$file' WHERE id = '".$_POST["image_id"]."'";
        if(mysqli_query($connect, $query))
        {
            echo 'Image Updated into Database';
        }
    }
    if($_POST["action"] == "delete")
    {
        $query = "DELETE FROM equipamentos WHERE id = '".$_POST["image_id"]."'";
        if(mysqli_query($connect, $query))
        {
            echo 'Image Deleted from Database';
        }
    }
}
?>