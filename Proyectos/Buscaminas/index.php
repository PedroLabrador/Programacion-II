<?php
    session_start();
    $_SESSION['map_size'] = 8;
    $_SESSION['map'] = null;
    $_SESSION['map_aux'] = null;

    $_SESSION['game'] = true;

    function generateMap() {
        for ($i = 0; $i < $_SESSION['map_size']; $i++) {
            for ($j = 0; $j < $_SESSION['map_size']; $j++) {
                $_SESSION['map'][$i][$j] = 0;
                $_SESSION['map_aux'][$i][$j] = false;
            }
        }
    }
    function generateMines() {
        $counter = 10;
        while ($counter > 0) {
            for ($i = 0; $i < $_SESSION['map_size']; $i++) {
                for ($j = 0; $j < $_SESSION['map_size']; $j++) {
                    $numb = rand(0, 100);
                    if ($numb > 75) {
                        $_SESSION['map'][$i][$j] = -1;
                        $counter--;
                    }
                    if ($counter == 0)
                        break;
                }
            }
        }
    }
    function calculateMines() {
        for ($i = 0; $i < $_SESSION['map_size']; $i++) {
            for ($j = 0; $j < $_SESSION['map_size']; $j++) {
                if ($_SESSION['map'][$i][$j] == -1) {
                    if ($i-1 >= 0 && $j-1 >= 0 && $_SESSION['map'][$i-1][$j-1] != -1)
                        $_SESSION['map'][$i-1][$j-1]++;
                    if ($i-1 >= 0 && $_SESSION['map'][$i-1][$j] != -1)
                        $_SESSION['map'][$i-1][$j]++;
                    if ($i-1 >= 0 && $j+1 < $_SESSION['map_size'] && $_SESSION['map'][$i-1][$j+1] != -1)
                        $_SESSION['map'][$i-1][$j+1]++;
                    if ($j-1 >= 0 && $_SESSION['map'][$i][$j-1] != -1)
                        $_SESSION['map'][$i][$j-1]++;
                    if ($j+1 <  $_SESSION['map_size'] && $_SESSION['map'][$i][$j+1] != -1)
                        $_SESSION['map'][$i][$j+1]++;
                    if ($i+1 <  $_SESSION['map_size'] && $j+1 < $_SESSION['map_size'] && $_SESSION['map'][$i+1][$j+1] != -1)
                        $_SESSION['map'][$i+1][$j+1]++;
                    if ($i+1 <  $_SESSION['map_size'] && $_SESSION['map'][$i+1][$j] != -1)
                        $_SESSION['map'][$i+1][$j]++;
                    if ($i+1 <  $_SESSION['map_size'] && $j-1 >= 0 && $_SESSION['map'][$i+1][$j-1] != -1)
                        $_SESSION['map'][$i+1][$j-1]++;
                }
            }
        }
    }



    generateMap();
    generateMines();
    calculateMines();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minesweeper</title>

    </head>
    <body>
        <div class="">
            <form class="" action="game.php" method="post">
                <input type="submit" name="" value="Start">
            </form>
        </div>
    </body>
</html>
