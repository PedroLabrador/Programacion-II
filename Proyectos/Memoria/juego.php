<?php 
	session_start();


	function mostrar() {
		if (isset($_GET['row']) && isset($_GET['col'])) {

			$_SESSION['turno']++;

			$row = $_GET['row'];
			$col = $_GET['col'];

			if ($_SESSION['turno'] == 1) {
			 	$_SESSION['x'] = $row;
			 	$_SESSION['y'] = $col;	
			}

			for ($i=0; $i < 4; $i++) { 
				echo "<tr>";
				for ($j=0; $j < 4; $j++) {
					if ($row == $i && $col == $j) {
						switch ($_SESSION['mat'][$i][$j]) {
							case 0:
								echo "<td class='hecho' onclick='casilla($i, $j)'> </td>";			
								break;
							case 1:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/FLor.bmp'></td>";
								break;
							case 2:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Mariposa.bmp'></td>";
								break;
							case 3:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Ojo.bmp'></td>";
								break;
							case 4:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Perro.bmp'></td>";
								break;	
							case 5:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Pez.bmp'></td>";
								break;
							case 6:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Rana.bmp'></td>";
								break;
							case 7:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Raton.bmp'></td>";
								break;
							case 8:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Sol.bmp'></td>";
								break;
							case defaut:
								echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Gris.bmp'></td>";
								break;
						}	
					} else if ($_SESSION['mat'][$i][$j] != 0)
						echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Gris.bmp'></td>";
					else 
						echo "<td class='hecho' onclick='casilla($i, $j)'> </td>";			
				}
				echo "</tr>";
			}
		} else {
			for ($i=0; $i < 4; $i++) { 
				echo "<tr>";
				for ($j=0; $j < 4; $j++) {
					if ($_SESSION['mat'][$i][$j] != 0)
						echo "<td class='caja' onclick='casilla($i, $j)'><img src='/img/Gris.bmp'></td>";
					else 
						echo "<td class='hecho' onclick='casilla($i, $j)'> </td>";		
				}
				echo "</tr>";
			}
		}
		echo $_SESSION['turno'];
		juego();
	}

	function juego() {
		if ($_SESSION['turno'] == 2) {
			$_SESSION['turno'] = 0;
			if ($_SESSION['mat'][$_GET['row']][$_GET['col']] == $_SESSION['mat'][$_SESSION['x']][$_SESSION['y']]) {
				$_SESSION['mat'][$_GET['row']][$_GET['col']] = 0;
				$_SESSION['mat'][$_SESSION['x']][$_SESSION['y']] = 0;
			}
		}
	}

?>

<html>
<head>
	<title></title>
	<style type="text/css">
		.caja {
			width: 50px;
			height: 50px;
			text-align: center;
			background-color: gray;
		}
		.hecho {
			width: 50px;
			height: 50px;
			text-align: center;
			background-color: blue;
		}
	</style>
</head>
<body>
	<table>

		<?php
			mostrar();
			// juego();
		?>
		
	</table>
<form method="post" name="myform"></form>
<script type="text/javascript">
	function casilla(i, j) {
		document.myform.action = "juego.php?row=" + i + "&col=" + j;		
		document.myform.submit();
	}
</script>
</body>
</html>