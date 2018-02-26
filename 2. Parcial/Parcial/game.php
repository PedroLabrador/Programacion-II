<?php 
	session_start();

	if (isset($_POST['boton'])) {
		$_SESSION['palabra'] = strtoupper($_POST['palabra']);
		$_SESSION['gameover'] = false;

		$actual = $_SESSION['palabra'];

		$_SESSION['jugando'] = '';
		$_SESSION['incorrectas'] = '';
		
		for ($i=0; $i < strlen($actual); $i++) {
			$_SESSION['jugando'] .= '_';
			if ($actual[$i] == ' ')
				$_SESSION['jugando'][$i] = " ";
		}
			
		$_SESSION['turno'] = 0;
	}

	if (isset($_POST['letra'])) {
		$letra = $_POST['letra'];
		$palabra = $_SESSION['palabra'];
		if (strpos($palabra, $letra) !== false) {
	   		for ($i=0; $i < strlen($palabra); $i++)
    				if ($palabra[$i] == $letra)
					$_SESSION['jugando'][$i] = $letra;		
		} else {
			$_SESSION['incorrectas'] .= $letra;
			$_SESSION['turno']++;
		}
	}
	
	$turno = $_SESSION['turno'];
	echo "<div class='contenedor'><strong>Incorrectas: </strong>" . $_SESSION['incorrectas'] . "</div>";
	echo "<div class='contenedor'><strong>Cantidad	 turnos restantes: </strong>" . (8 - $_SESSION['turno']) . "</div>";
	echo "<div class='imagen'><img src='/img/$turno.jpg'></div>";
	echo "<div class='contenedor letras'>". $_SESSION['jugando'] . "</div>";
	if ($turno == 8) {
		echo "<div class='ganador'>La palabra era: " . $_SESSION['palabra']  . "</div>";
		echo "<div class='perdedor'>PERDISTE</div>";
		$_SESSION['gameover'] = true;
	} else {
		$actual = $_SESSION['jugando'];
		if (strpos($actual, '_') === false)  {
			echo "<div class='ganador'>GANASTE</div>";
			$_SESSION['gameover'] = true;
		}
	}
	$gameover = $_SESSION['gameover'];
?>

<html>
<head>
	<title>J2 - Jugando</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="contenedor">
		<?php if (!$gameover): ?>
			<form method='post'>
				<div class="teclado">
					<div class='col1'>
						<input class='boton' type='submit' value='Q' name='letra'>
						<input class='boton' type='submit' value='W' name='letra'>
						<input class='boton' type='submit' value='E' name='letra'>
						<input class='boton' type='submit' value='R' name='letra'>
						<input class='boton' type='submit' value='T' name='letra'>
						<input class='boton' type='submit' value='Y' name='letra'>
						<input class='boton' type='submit' value='U' name='letra'>
						<input class='boton' type='submit' value='I' name='letra'>
						<input class='boton' type='submit' value='O' name='letra'>
						<input class='boton' type='submit' value='P' name='letra'>
					</div>
					<div clas='col2'>
						<input class='boton' type="submit" value="A" name='letra'>
						<input class='boton' type="submit" value="S" name='letra'>
						<input class='boton' type="submit" value="D" name='letra'>
						<input class='boton' type="submit" value="F" name='letra'>
						<input class='boton' type="submit" value="G" name='letra'>
						<input class='boton' type="submit" value="H" name='letra'>
						<input class='boton' type="submit" value="J" name='letra'>
						<input class='boton' type="submit" value="K" name='letra'>
						<input class='boton' type="submit" value="L" name='letra'>
					</div>
					<div class='col3'>
						<input class='boton' type="submit" value="Z" name='letra'>
						<input class='boton' type="submit" value="X" name='letra'>
						<input class='boton' type="submit" value="C" name='letra'>
						<input class='boton' type="submit" value="V" name='letra'>
						<input class='boton' type="submit" value="B" name='letra'>
						<input class='boton' type="submit" value="N" name='letra'>
						<input class='boton' type="submit" value="M" name='letra'>
					</div>
				</div>
				<br>
			</form>
		<?php endif ?>
		<a href="/" class='boton'>REINICIAR</a>
	</div>
</body>
</html>
