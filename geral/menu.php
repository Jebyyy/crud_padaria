<!-- Top -->
	<?php 
	session_start();
	if(!isset($_SESSION ['login'])){                              // Não houve login ainda
        unset($_SESSION ['nao_autenticado']);
		unset($_SESSION ['mensagem_header'] ); 
		unset($_SESSION ['mensagem'] ); 
		header('location: /atp02_michelmartins/index.php');    // Vai para a página inicial
		exit();
    }
	?>
	<div class="w3-top"   > 
		<div class="w3-row w3-white w3-padding" >
			<div class="w3-half" style="margin:0 0 0 0">
				<a href="."><img src='Imagens/Logo.jpg' alt=' Padaria MM '></a>
			</div>
			<div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
				<div class="w3-right" style="font-family: Arapey ;"> Logado como: <?php echo $_SESSION['nome']; ?>&nbsp;<a href="logout.php" 
				class="w3-btn w3-red w3-hover-red">&nbsp;Sair&nbsp;</a>
				</div >
			</div>
		</div>
		<div class="w3-bar w3-theme w3-large" style="z-index:-1">
			<a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
			<a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="funciolistar.php" onclick="w3_show_nav('menuPadaria')">Padaria</a>
		</div>
	</div>

	<!-- Sidebar -->
	<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index: 2; width: 270px; margin-top: 13px; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);" id="mySidebar" >
		<div class="w3-bar w3-hide-large w3-large">
			<a href="javascript:void(0)" onclick="w3_show_nav('menuPadaria')"
			   class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Funcionários</a>

		</div>
		<a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large"
		   title="Close Menu">x</a>
		<div id="menuPadaria" class="myMenu">
			<div class="w3-container">
				<h3>Menu de Funcionários</h3>
			</div>
			<a class="w3-bar-item w3-button" href="funciolistar.php">Funcionários</a>
			<a class="w3-bar-item w3-button" href="funcioIncluir.php">Cadastro de Funcionários</a>


		</div>
		
	</div>

	<script type="text/javascript" src="js/myScriptClinic.js"></script>
