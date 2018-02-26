<?php
    session_start ();

    if (!$_SESSION['admin'])
        header ("Location:../../index.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistema de boletos de eventos</title>
        <link rel="stylesheet" href="../../bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h2>Seccion de administradores</h2>
            <ul>
                <li><a href="list.php">Listado de registros</a></li>
                <li><a href="register_event.php">Registrar Evento</a></li>
            </ul>
        </div>
        <footer>
            <div class="container">
                <a href="../../index.php" class="btn btn-danger">Regresar</a>
            </div>
        </footer>
    </body>
</html>
