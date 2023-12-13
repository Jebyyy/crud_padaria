<html>
<!-- Logout.php --> 
	<head>
    <meta charset="UTF-8">
      <title>Padaria MM</title>
	  <link rel="icon" type="image/png" href="Imagens/favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
<body>

<?php
    session_start(); // informa ao PHP que iremos trabalhar com sessão
    session_destroy();
    header('location: /atp02_michelmartins/index.php');
    exit();
?>

</body>
</html>