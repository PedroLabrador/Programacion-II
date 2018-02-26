<?php 
	session_start();
 ?>

<html>
<head>
	<title>J1 - Jugando</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class='contenedor'>
		<h1>El Ahorcado</h1>	
		<div class='comenzar'>
			<form method='post' action='game.php'>
				<label class='palabra' for='palabra'>Ingrese una palabra para comenzar</label>
				<br>
				<input id='palabra' name='palabra' type='text'>
				<input class='boton' type='submit' name='boton' value='Empezar!'>
			</form>
		</div>
	</div>
	<footer hidden>
		<small>Peor combinacion de colores no pude haber escojido</small>
	</footer>
</body>
</html>