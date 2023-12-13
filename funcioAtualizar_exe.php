<!DOCTYPE html>
<html>
	<head>
	  <title>Padaria MM</title>
	  <link rel="icon" type="image/png" href="Imagens/favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
	<body onload="w3_show_nav('menuPadaria')">
	<!-- Inclui MENU.PHP  -->
	<?php require 'geral/menu.php'; ?>
	<?php require 'bd/conectaBD.php'; ?>
	
	<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:130px;">

	<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">

	  <p class="w3-large">
	  <div class="w3-code cssHigh notranslate">
	  <!-- Acesso em:-->
		<?php

		date_default_timezone_set("America/Sao_Paulo");
		$data = date("d/m/Y H:i:s",time());
		echo "<p class='w3-small' > ";
		echo "Acesso em: ";
		echo $data;
		echo "</p> "
		?>
		<div class="w3-container w3-theme">
		<h2>Atualização de Funcionário</h2>
		</div>
		<!-- Acesso ao BD-->
		<?php
			// Recebe os dados que foram preenchidos no formulário, com os valores que serão atualizados
			$id      = $_POST['Id'];  // identifica o registro a ser alterado
			$nome    = $_POST['Nome'];
			$CPF     = $_POST['CPF'];
			$dtNasc  = $_POST['DataNasc'];
			$funcao   = $_POST['Funcao'];

			// Cria conexão
			$conn = new mysqli($servername, $username, $password, $database);

			// Verifica conexão
			if ($conn->connect_error) {
				die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
			}
			?>
			
			<?php
		
			// Faz Update na Base de Dados
			if ($_FILES['Imagem']['size'] == 0) { // Não recebeu uma imagem binária
				$sql = "UPDATE Funcionario SET Nome = '$nome', CPF = '$CPF', Dt_Nasc = '$dtNasc', ID_Funcao = '$funcao' WHERE ID_Funcionario = $id";
			}else{
				$imagem = addslashes(file_get_contents($_FILES['Imagem']['tmp_name'])); // Prepara para salvar em BD
				$sql = "UPDATE Funcionario SET Nome = '$nome', CPF = '$CPF', Dt_Nasc = '$dtNasc', ID_Funcao = '$funcao', Foto = '$imagem' WHERE ID_Funcionario = $id";	
			}

			echo "<div class='w3-responsive w3-card-4'>";
			if ($result = $conn->query($sql)) {
				echo "<p>&nbsp;Registro alterado com sucesso! </p>";
			} else {
				echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn->connect_error . "</p>";
			}
			echo "</div>";
			$conn->close(); //Encerra conexao com o BD

		?>
	  </div>
	</div>

	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
