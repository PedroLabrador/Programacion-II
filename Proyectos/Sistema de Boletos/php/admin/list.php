<?php
    session_start();
    include '../../includes/config.php';
    $pdo = Database::getConnection();

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
            <h2>Listado de registros</h2>
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Evento</th>
                    <th>Zona</th>
                    <th>Detalles</th>
                    <th style="color: red">Editar</th>
                    <th style="color: red">Borrar</th>
                </tr>
            <?php

                $sql =  "SELECT usuarios.name, usuarios.dni, boletos.id, boletos.evento, boletos.zona " .
                        "FROM boletos INNER JOIN usuarios ON boletos.user_id = usuarios.id";

                $query = $pdo->prepare ($sql);
                $result = $query->execute ();

                while ($current = $query->fetch (PDO::FETCH_ASSOC)) :
            ?>
                <tr>
                    <td><?= $current['name'] ?></td>
                    <td><?= $current['dni'] ?></td>
                    <td><?= $current['evento'] ?></td>
                    <td><?= $current['zona'] ?></td>
                    <td><a href="details.php?id=<?= $current['id'] ?>">Detalles</a></td>
                    <td><a href="update.php?id=<?= $current['id'] ?>">Editar</a></td>
                    <td><a onClick="pro()" href='delete.php?id=<?= $current['id'] ?>'>Borrar</a></td>
                </tr>
            <?php endwhile ?>
            </table>
        </div>
        <footer>
            <div class="container">
                <a href="index.php" class="btn btn-danger">Regresar</a>
            </div>
        </footer>
    </body>
</html>
