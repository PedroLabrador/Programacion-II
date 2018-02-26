<?php

    session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistema de boletos de eventos</title>
        <link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h2>Seccion de usuarios</h2>
            <?php if (isset($_SESSION['userID']))
                echo "Bienvenido " . $_SESSION['userName'];
            ?>
            <ul>
                <li><a href="php/register_event.php">Registrar evento</a></li>
                <?php if ($_SESSION['admin']): ?>
                    <li><a href="php/admin/index.php">Admin Panel</a></li>
                <?php endif ?>
            </ul>
        </div>
        <footer>
            <div class="container">
                <?php if (!isset($_SESSION['userID']))
                    echo "<a class='btn' style='background-color: darkslategrey; border-color: darkslategrey; color: white;' href='auth/login.php'>Ingresar</a>";
                else
                    echo "<a class='btn btn-danger' href='auth/logout.php'>Salir</a>";
                ?>
            </div>
        </footer>
    </body>
</html>
