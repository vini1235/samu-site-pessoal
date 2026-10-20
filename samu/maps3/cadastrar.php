<?php
session_start();
include_once("conexao.php");
?>
<!DOCTYPE html>
  <head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Cadastrar</title>
	</head>
	<body>
		<a href="index.php">Mapa</a><br><br>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<form method="POST" action="processa_cad.php">
			<label>Nome: </label>
			<input type="text" name="name" placeholder="Nome da Empresa ou Filial"><br><br>

			<label>Endereço: </label>
			<input type="text" name="address" placeholder="Digite o número e o Logradouro"><br><br>

			<label>Latitude: </label>
			<input type="text" name="lat" placeholder="Digite a latitude"><br><br>

			<label>Longitude: </label>
			<input type="text" name="lng" placeholder="Digite a mensagem"><br><br>

			<label>Tipo da Empresa: </label>
			<input type="text" name="type" placeholder="Educação, Restaurante..."><br><br>

			<input type="submit" value="Cadastrar"><br><br>
		</form>

		<div class="row"><div class="col-lg-6 alert alert-info">Google Map </div></div>
		<form method="post">

			<div class="row">
				<div class="col col-lg-6">
					Name
					<input type="text" name="name" class="form-control"><br>
					type
					<input type="text" name="type" placeholder="Educação, Restaurante..."><br>

					<input type="hidden" name="lat" id="lat">
					<input type="hidden" name="lng" id="lng">
					<input type="hidden" name="location" id="location">

					<input id="pac-input" class="controls" type="text"
						   placeholder="Enter a location">
					<div id="type-selector" class="controls">
						<input type="radio" name="type" id="changetype-all" checked="checked">
						<label for="changetype-all">All</label>


					</div>
					<div id="map" style="height: 400px;width: 600px"></div>

					<input type="submit" name="submit" value="Save" class="form-control btn btn-primary">
				</div>
			</div><!--End of row-->
		</form>


	</body>
</html>