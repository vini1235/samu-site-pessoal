<?php
if($_FILES["upload_file"]["name"] != '')
{
    $data = explode(".", $_FILES["upload_file"]["name"]);
    $extension = $data[1];
    $allowed_extension = array("jpg", "png", "gif","rar","zip","pdf","sql","doc","xml","xls","xlt","exe","txt");
    if(in_array($extension, $allowed_extension))
    {
        $new_file_name = rand() . '.' . $extension;
        $path = $_POST["hidden_folder_name"] . '/' . $new_file_name;
        if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $path))
        {
            echo 'Image Uploaded';
        }
        else
        {
            echo 'Existe algum erro';
        }
    }
    else
    {
        echo 'Arquivo de Imagem Inválido';
    }
}
else
{
    echo 'Por favor selecione Image';
}
?>
