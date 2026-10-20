<?php
	// Configuração central de conexão com MySQL.
	$servidor = "localhost";
	$usuario = 'samu_pessoal';
	$senha = '';
	$port = 3306;
	$dbname = 'basesamu_pessoal';

	// Criar a conexão compartilhada.
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname, $port);

	if (!$conn) {
		die("Falha na conexao: " . mysqli_connect_error());
	}

	// Alias para compatibilidade com códigos existentes.
	$conexao = $conn;
	$connection = $conn;
	$connect = $conn;
	$msqli = $conn;
?>
