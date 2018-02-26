<?php
    session_start ();
    //var_dump ($_POST);

    //echo "Player 1: " . $_SESSION['player_1'] ." ---- Player 2: ". $_SESSION['player_2'];
    if ($_SESSION['turn'] == 1)
        echo '<br>Turn: ' . $_SESSION['player_1'];
    else
        echo '<br>Turn: ' . $_SESSION['player_2'];

    if ($_GET) {
        $_SESSION['row_mov'] = $_GET['row'];
        $_SESSION['col_mov'] = $_GET['col'];

        move($_SESSION['row_mov'], $_SESSION['col_mov']);
    }

    function move($i, $j) {

        if ($_SESSION['matrix'][$i][$j] == 0)
            if ($_SESSION['turn'] == 1)
                $_SESSION['matrix'][$i][$j] = 1;
            else
                $_SESSION['matrix'][$i][$j] = 2;
        if ($_SESSION['turn'] == 1)
            $_SESSION['turn'] = 2;
        else
            $_SESSION['turn'] = 1;

    }

    function showGame() {
        for ($i = 0; $i < $_SESSION['matrix_size']; $i++) {
            echo '<tr>';
            for ($j = 0; $j < $_SESSION['matrix_size']; $j++) {
                showEach($i, $j) ;
            }
            echo '</tr>';
        }
    }

    function showEach($row, $col) {
        if ($_SESSION['matrix'][$row][$col] == 1)
	        echo "<td class='caja x' onclick='getPosition($row,$col)'>X</td>";
        elseif ($_SESSION['matrix'][$row][$col] == 2)
            echo "<td class='caja o' onclick='getPosition($row,$col)'>O</td>";
        else
            echo "<td class='caja' onclick='getPosition($row,$col)'></td>";
	}

    function verify() {
        //esto no lo hice me dió pereza, solo hice todo esto para saber como funciona la vaina y tal
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tic-Tac-Toe</title>
        <style media="screen">
            .caja {
                width: 100px;
                height: 100px;
                background-color: aqua;
                color: black;
                text-align: center;
                font-size: 5em;
            }
            .x {
                color: red;
            }
            .o {
                color: blue;
            }

        </style>
    </head>
    <body>
        <div class="">
            <table id=''>
            <?php showGame(); ?>
            </table>
        </div>
        <form class="" name="act" method="post">
            <input type="hidden" name="turn" value="<?= $_SESSION['turn'] ?>">
        </form>
        <script type="text/javascript">
            function getPosition(i, j) {
                document.act.action = "game.php?row=" + i + "&col=" + j;
                document.act.submit();
            }
        </script>
    </body>
</html>
