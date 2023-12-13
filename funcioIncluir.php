<!DOCTYPE html>
<html>
<head>
	<title>Padaria</title>
	<link rel="icon" type="image/png" href="Imagens/favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuPadaria')">
	<!-- Inclui MENU.PHP  -->
	<?php require 'geral/menu.php'; ?>
	<?php require 'bd/conectaBD.php'; ?>

	<!-- Conteúdo Principal: deslocado paa direita em 270 pixels quando a sidebar é visível -->
	<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

		<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<!-- h1 class="w3-xxlarge">Contratação de Médico</h1 -->
			<p class="w3-large">
			<div class="w3-code cssHigh notranslate">
				<!-- Acesso em:-->
				<?php

				date_default_timezone_set("America/Sao_Paulo");
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>
				<!-- Acesso ao BD-->
				<?php
				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				// Obtém as Funcões dos Funcionários na Base de Dados para um combo box
				$sqlG = "SELECT ID_Funcao, Nome_Funcao FROM Funcao";
				$result = $conn->query($sqlG);
				$optionsEspec = array();

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						array_push($optionsEspec, "\t\t\t<option value='" . $row["ID_Funcao"] . "'>" . $row["Nome_Funcao"] . "</option>\n");
					}
				} else {
					echo "Erro executando SELECT: " . $conn->connect_error;
				}
				$conn->close();
				?>
				<div class="w3-responsive w3-card-4">
					<div class="w3-container w3-theme">
						<h2>Informe os dados do novo Funcionário</h2>
					</div>
					<form class="w3-container" action="funcioIncluir_exe.php" method="post" enctype="multipart/form-data">
						<table class='w3-table-all'>
						<tr>
						<td style="width:50%;">
						<p>
							<label class="w3-text-IE"><b>Nome</b>*</label>
							<input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome entre 10 e 100 letras." required>
						</p>
						<p>
							<label class="w3-text-IE"><b>CPF</b>*</label>
    						<input class="w3-input w3-border w3-light-grey" name="CPF" id="CPF" type="text" maxlength="14" placeholder="123.456.789-01" title="123.456.789-01" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required>
						</p>
						</p>
						<p>
							<label class="w3-text-IE"><b>Data de Nascimento</b></label>
							<input class="w3-input w3-border w3-light-grey" name="DataNasc" type="date" placeholder="dd/mm/aaaa" title="dd/mm/aaaa"</p>
						<p>
						<p><label class="w3-text-IE"><b>Área de Atuação</b>*</label>
							<select name="Funcao" id="Funcao" class="w3-input w3-border w3-light-grey" required>
								<option value=""></option>
								<?php
								foreach ($optionsEspec as $key => $value) {
									echo $value;
								}
								?>
							</select>
						</p>
						</td>
						<td>
						<p style="text-align:center"><label class="w3-text-IE"><b>Imagem para Identificação: </b></label></p>
						<p style="text-align:center"><img id="imagemSelecionada" src="Imagens/pessoa.jpg" /></p>
						<p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem
								<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
								<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);"></label>
						</p>
						</td>
						</tr>
						<tr>
						<td colspan="2" style="text-align:center">
						<p>
							<input type="submit" value="Salvar" class="w3-btn w3-theme">
							<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='funcioListar.php'">
						</p>
						</td>
						</tr>
						</table>
					</form>
					<br>
				</div>
			</div>
			</p>
		</div>

		<?php require 'geral/sobre.php'; ?>
		<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php'; ?>
</body>
</html>