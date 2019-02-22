<?php require_once("config/config.php"); ?>
<!DOCTYPE html5>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
<title>Relatorios Easy Sistemas</title>
<head>
<link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="formulario"> 
	<h2>Vendas Por Horário - Balcão</h2>
<form action="datahora.php" method="GET">

	<p>Data/Hora Inicial:</p>
	<input type="datetime-local" name="dhInicial"></br>
	<p>Data/Hora Final:</p>
	<input type="datetime-local" name="dhFinal"></br></br>
	<input type="submit" class="button" value="Gerar Relatorio">

</form>
</div>
</body>
</html>