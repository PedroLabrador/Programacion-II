<?php
    session_start ();

    function printMap() {
        for ($i = 0; $i < $_SESSION['map_size']; $i++) {
            echo '<tr>';
            for ($j = 0; $j < $_SESSION['map_size']; $j++) {
                if ($_SESSION['map_aux'][$i][$j])
                    printEach($i, $j, true);
                else
                    printEach($i, $j);
            }
            echo '</tr>';
        }
    }
    function printEach($row, $col, $set = false) {
        if ($set) {
            if ($_SESSION['map'][$row][$col] == -1)
                echo "<td class='caja' onclick='touch($row,$col)'>*</td>";
            else if ($_SESSION['map'][$row][$col] == 0)
                echo "<td class='caja' style='background-color:lightgray' onclick='touch($row,$col)'></td>";
            else if ($_SESSION['map'][$row][$col] == 1)
                echo "<td class='caja' style='color:yellow; background-color:lightgray' onclick='touch($row,$col)'>". $_SESSION['map'][$row][$col] ."</td>";
            else if ($_SESSION['map'][$row][$col] == 2)
                echo "<td class='caja' style='color:blue; background-color:lightgray' onclick='touch($row,$col)'>". $_SESSION['map'][$row][$col] ."</td>";
            else if ($_SESSION['map'][$row][$col] == 3)
                echo "<td class='caja' style='color:red; background-color:lightgray' onclick='touch($row,$col)'>". $_SESSION['map'][$row][$col] ."</td>";
            else if ($_SESSION['map'][$row][$col] == 4)
                echo "<td class='caja' style='color:green; background-color:lightgray' onclick='touch($row,$col)'>". $_SESSION['map'][$row][$col] ."</td>";
            else if ($_SESSION['map'][$row][$col] == 5)
                echo "<td class='caja' style='color:darkblue; background-color:lightgray' onclick='touch($row,$col)'>". $_SESSION['map'][$row][$col] ."</td>";
            else
                echo "<td class='caja' style='color:black; background-color:lightgray' onclick='touch($row,$col)'> </td>";
        } else
            echo "<td class='caja' style='color:black' onclick='touch($row,$col)'> </td>";
    }

    if ($_GET) {
        if ($_SESSION['game']) {
            $row = $_GET['row'];
            $col = $_GET['col'];

            if ($_SESSION['map'][$row][$col] == -1) {
                $_SESSION['map_aux'][$row][$col] = true;
                $_SESSION['game'] = false;
                header("Location:game.php");
            }
            check($row, $col);
        }
        header("Location:game.php");
    }



    /*if () {

    }*/

    function verify() {
        for ($i = 0; $i < $_SESSION['map_size']; $i++) {
            for ($j = 0; $j < $_SESSION['map_size']; $j++) {

            }
        }
    }
    $_SESSION['test'] = false;
    function check ($row, $col) {
        if ($_SESSION['test'])
            return;
        if ($row < 0 || $row >= $_SESSION['map_size'])
            return;
        if ($col < 0 || $col >= $_SESSION['map_size'])
            return;
        if ($_SESSION['map'][$row][$col] == -1) {
            $_SESSION['test'] = true;
            return;
        }
        if ($_SESSION['map_aux'][$row][$col] == true)
            return;

        $_SESSION['map_aux'][$row][$col] = true;
        check($row+1, $col);
        check($row-1, $col);
        check($row, $col+1);
        check($row, $col-1);
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minesweeper - Playing</title>
        <style media="screen">
            .caja {
                width: 50px;
                height: 50px;
                background-color: gray;
                margin: 0 auto;
                text-align: center;
                color: black;
                font-family: 'Terminal';
            }
            body {
                background-color: darkgray;
            }
        </style>
    </head>
    <body>
        <div id="">
			<table id="">

				<?php
                    /*for ($i=0; $i < 8; $i++) {
                        echo "<tr>";
                        for ($j=0; $j < 8; $j++) {
                            printEach($i, $j, true);
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<hr>";
                    echo "<table id=''>";*/
                    printMap();
                    if (!$_SESSION['game']) {
                        echo "HAS PERDIDO";
                    }


				?>
			</table>

            <form class="" name="theform" action="index.html" method="post">
            </form>
        </div>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript">
            function touch(i, j, click){
                document.theform.action = "game.php?row=" + i + "&col=" + j +"&click=" + click;
                document.theform.submit();
            }
        </script>
    </body>
</html>
