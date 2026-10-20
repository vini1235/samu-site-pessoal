<?php
	function seguranca_user(){
		if((empty($_SESSION['usuarioId'])) || (empty($_SESSION['usuarioEmail'])) || (empty($_SESSION['usuarioNiveisAcessoId']))){		
			$_SESSION['loginErro'] = "Área restrita";
			header("Location: index.php");
		}else{
			if($_SESSION['usuarioNiveisAcessoId'] != "2"){
				$_SESSION['loginErro'] = "Área restrita";
				header("Location: index.php");
			}
		}
	}
?>