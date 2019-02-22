<?php require_once("config/config.php"); ?>
<!DOCTYPE html5>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<html>
<title>Relatorios Easy Sistemas</title>
<head>
    <style>
        
        div.formulario {
          display: block;
          text-align: center;
        }

        form {
          display: inline-block;
          margin-left: auto;
          margin-right: auto;
          text-align: center; 
        }

        p {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 15;
        }

        h2 {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        .button {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          font-size: 15;
          background-color: grey;
          color: white;
          transition-duration: 0.15s;
          display: inline-block;
          cursor: pointer;
          border: 2px solid grey;
          text-align: center;
          display: inline-block;
          padding: 4px 6px;

        }
        .button:hover {
          background-color: white;
          color: grey;
        }

      </style>
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