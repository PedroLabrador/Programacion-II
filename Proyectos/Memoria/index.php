<?php 
	session_start();



	function iniciar() {
		$_SESSION['turno'] = 0;			

		for ($i=0; $i < 4; $i++) { 
			for ($j=0; $j < 4; $j++) { 
				$_SESSION['mat'][$i][$j] = -1;
			}
		}

		for ($i=0; $i < 4; $i++) { 
			for ($j=0; $j < 4; $j++) { 
				$vuelta = true;
				while ($vuelta) {
					$numero = rand(1,8);
					$contador = 0;
					for ($x=0; $x < 4; $x++) { 
						for ($y=0; $y < 4; $y++) { 
							if ($numero == $_SESSION['mat'][$x][$y])
								$contador++;
						}
					}
					if ($contador < 2) {
						$_SESSION['mat'][$i][$j] = $numero;
						$vuelta = false;	
					}
				} 
			}
		}
	}

	iniciar();

?>

<html>
<head>
	<title></title>
</head>
<body>
	<form action="juego.php" method="post">
		<label for="iniciar">Iniciar</label>
		<!-- <input type="text" name="iniciar" id="iniciar"> -->
		<hr>
		<button name="boton">Iniciar juego</button>
	</form>
</body>
</html>