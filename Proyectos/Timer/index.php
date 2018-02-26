<?php 
	$gameOver = false;
	if (isset($_GET['game']))
		if ($_GET['game'] == 'over')
			$gameOver = true;
?>

<html>
<head>
	<title></title>
</head>
<body>
	<?php if (!$gameOver): ?>
		<form method='get'>
			<table>
				<tr>
					<td><button>1</button></td>
					<td><button>2</button></td>
				</tr>
					<td><button>3</button></td>
					<td><button>4</button></td>
				</tr>
			</table>
		</form>
	<?php endif ?>
	<div id="counter"></div>
<script>
	
	var y = setInterval(function() {

		var n = localStorage.getItem('on_load_counter');
		 
		if (n === null)
		    n = 300;

		n--;

		localStorage.setItem("on_load_counter", n);
		
		var minutes = Math.floor(n / 60);
		var seconds = n - minutes * 60;

		document.getElementById('counter').innerHTML = ((minutes<10)?"0":"") + minutes + ":" + ((seconds<10)?"0":"") + seconds ;

		if (n < 0) {
			clearInterval(y);
			<?php $gameOver = true; ?>
			document.getElementById('counter').innerHTML = 'GAME OVER';
		}

	}, 1000);

	function reset_counter() {
	    localStorage.removeItem('on_load_counter');
	}
</script>
</body>
</html>