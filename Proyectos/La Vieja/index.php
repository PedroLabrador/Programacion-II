<?php
    session_start ();
    $_SESSION['matrix'] = null;
    $_SESSION['matrix_size'] = 3;

    $_SESSION['player_1'] = 1;
	$_SESSION['player_2'] = 2;

    function generate() {
        for ($i = 0; $i < $_SESSION['matrix_size']; $i++)
            for ($j = 0; $j < $_SESSION['matrix_size']; $j++)
                $_SESSION['matrix'][$i][$j] = 0;
    }

    generate();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tic-Tac-Toe</title>
    </head>
    <body>
        <div class="">
            <form class="" method="POST">
                <label for="p1">Player 1</label>
                <input type="text" name="p1" id="p1" value="" required>
                <label for="p2">Player 2</label>
                <input type="text" name="p2" id="p2" value="" required>
                <select class="" name="turn">
                    <option value="1">Turn P1</option>
                    <option value="2">Turn P2</option>
                </select>
                <input type="submit" name="submit_button" value="Take me to the game!">
                <?php
					if (isset($_POST['submit_button'])){
						if ($_POST['p1'] != '' && $_POST['p2'] != ''){
							$_SESSION['player_1'] = $_POST['p1'];
							$_SESSION['player_2'] = $_POST['p2'];
                            $_SESSION['turn'] = $_POST['turn'];
							header("Location: game.php");
						}
					}
				?>
            </form>
        </div>
    </body>
</html>
