<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');
?>


<html>
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="secretaria da saude" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="estilo.css">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon"/>
</head>
<body>
<?php
//baixar a class mPDF no site http://www.mpdf1.com/mpdf/index.php
//Descompactar o arquivo na pasta pdf
include ('../pdf/mpdf.php');


//Criar a conexão
mysqli_set_charset($conn,'utf8');
if(!$conn){
    die("Falha na conexao: " . mysqli_connect_error());
}else{
    //echo "Conexao realizada com sucesso";
}
$id = $_REQUEST ['cod'];

$result_usuario = "SELECT * FROM tickets WHERE id = '$id' LIMIT 1";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);


$pagina =
    "<html>
            
			<body>
			 <div align=\"center\">
             <img src=\"../imagens/logo-jandira.png\" alt=\"some_text\"/>
             </div>
             <p></p>
             <p></p>
             <div>
						
             <p></p>
             <h2 align='center'>Secretaria da Saúde</h2>
             <h3 align='center'>Setor de T.I Saúde</h3>
             <p></p>
             
             <p></p>
             
				<h3 align='center'>Relatório de chamada de ticket da Secretaria da Saude </h3>
		     <p></p>
			 <p></p>
			 <h3></h3>
			 <p></p>
				Id: ".$row_usuario['id']."<br>
				Data: ".$row_usuario['data_entrada']."<br>
				Setor: ".$row_usuario['setor']."<br>
				Nome: ".$row_usuario['nome']."<br>
				Assunto: ".$row_usuario['assunto']."<br>
			    Obs: ".$row_usuario['obs']."<br>
			    Serviço/Realizado: ".$row_usuario['reolvido']."<br>
			    Data/realizada: ".$row_usuario['data_realizada']."<br>
			    
			   
			    
		     <p></p>
            <h2 align='center'><img  src=\"../imagens/produtos/".($row_usuario['arquivo'] )."\" height=\"100\" width=\"100\" class=\"img-thumbnail\" /></h2>
             <p></p>
		      
             <p align='center'>Aproveitamos para elevar nossos votos de estima consideração.</p>
				 <p></p>
				  <h4 align='center'>Assinatura do Responsável</h4>
				
				<p align='center'>--------------------------------</p>
				<p align='center'>Coordenador de TI</p>
				
			</body>
		</html>
		";

$arquivo = "Cadastro01.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($pagina);

$mpdf->Output($arquivo, 'I');

// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
?>
</body>
</html>