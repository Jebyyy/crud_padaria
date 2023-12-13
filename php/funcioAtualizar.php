<!DOCTYPE html>
<html>
<head>
	<title>Padaria MM</title>
	<link rel="icon" type="image/png" href="imagens/favicon.png" />
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
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>

				<!-- Acesso ao BD-->
				<?php
				$id = $_GET['id']; // Obtém PK do Funcionário que será atualizado

				// Cria conexão
				$conn = new mysqli($servername, $username, $password, $database);

				// Verifica conexão 
				if ($conn->connect_error) {
					die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
				}

				// Faz Select na Base de Dados
				$sql = "SELECT ID_Funcionario, Nome, CPF, Dt_Nasc, ID_Funcao, Foto FROM Funcionario WHERE ID_Funcionario = $id";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = $conn->query($sql)) {   // Consulta ao BD ok
					if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
						$row = $result->fetch_assoc();

						$funcao = $row['ID_Funcao'];
						$id_funcionario     = $row['ID_Funcionario'];
						$nome          = $row['Nome'];
						$CPF           = $row['CPF'];
						$dataNasc      = $row['Dt_Nasc'];
						$foto          = $row['Foto'];

						// Obtém as funções dos funcionários na Base de Dados para um combo box
						$sqlG = "SELECT ID_Funcao, Nome_Funcao FROM Funcao";
						$resultG = $conn->query($sqlG);
						$optionsFuncao = array();

						if ($resultG->num_rows > 0) {
							while ($rowG = $resultG->fetch_assoc()) {
								$idFuncao = $rowG["ID_Funcao"];
								$nomeFuncao = $rowG["Nome_Funcao"];
								$optionsFuncao[$idFuncao] = $nomeFuncao;
							}
						} else {
							echo "Erro executando SELECT: " . $conn->connect_error;
						}

				?>
						<div class="w3-container w3-theme">
							<h2>Altere os dados do Funcionário Cód. = [<?php echo $id_funcionario; ?>]</h2>
						</div>
						<form class="w3-container" action="funcioAtualizar_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all'>
								<tr>
									<td style="width:50%;">
										<p>
											<input type="hidden" id="Id" name="Id" value="<?php echo $id_funcionario; ?>">
										<p>
										<label class="w3-text-IE"><b>Nome</b></label>
										<input class="w3-input w3-border w3-light-grey " name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" title="Nome entre 10 e 100 letras." value="<?php echo $nome; ?>" required>
										</p>
										<p>
										<p>
										<label class="w3-text-IE"><b>CPF</b>*</label>
    									<input class="w3-input w3-border w3-light-grey" name="CPF" id="CPF" type="text" maxlength="14" placeholder="123.456.789-01" title="123.456.789-01" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="<?php echo $CPF; ?>" required>
										</p>
										<p>
										<label class="w3-text-IE"><b>Data de Nascimento</b></label>
										<input class="w3-input w3-border w3-light-grey " name="DataNasc" type="date" placeholder="dd/mm/aaaa" title="dd/mm/aaaa" title="Formato: dd/mm/aaaa" value="<?php echo $dataNasc; ?>">
										</p>

										<<p><label class="w3-text-IE"><b>Função</b>*</label>
											<select name="Funcao" id="Funcao" class="w3-input w3-border w3-light-grey" required>
												<?php
												foreach ($optionsFuncao as $id => $nome) {
													$selected = ($id == $funcao) ? 'selected' : '';
													echo "<option value=\"$id\" $selected>$nome</option>";
												}
												?>
											</select>
										</p>
									</td>
									<td>
									<p style="text-align:center"><label class="w3-text-IE"><b>Minha Imagem para Identificação: </b></label></p>
									<?php
									if ($foto) { ?>
										<p style="text-align:center">
											<img id="imagemSelecionada" class="w3-circle w3-margin-top" src="data:image/png;base64,<?= base64_encode($foto); ?>" />
										</p>
									<?php
									} else {
									?>
										<p style="text-align:center">
											<img id="imagemSelecionada" class="w3-circle w3-margin-top" src="imagens/pessoa.jpg" />
										</p>
									<?php
									}
									?>
									<p style="text-align:center"><label class="w3-btn w3-theme">Selecione uma Imagem
											<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
											<input type="file" id="Imagem" name="Imagem" accept="imagem/*" onchange="validaImagem(this);" /></label>
									</p>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">
									<p>
										<input type="submit" value="Alterar" class="w3-btn w3-red">
										<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='funciolistar.php'">
									</p>
									</td>
								</tr>
							</table>
							<br>
						</form>
					<?php
					} else { ?>
						<div class="w3-container w3-theme">
							<h2>Funcionário inexistente</h2>
						</div>
						<br>
				<?php
					}
				} else {					
					echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn->connect_error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn->close(); //Encerra conexao com o BD
				?>
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