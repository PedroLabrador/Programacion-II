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
            <h2>Detalles de registro de asistencia</h2>
            <?php
                if (isset($_GET['id']))
                    $id = $_GET['id'];

                $sql =  "SELECT * FROM boletos WHERE id=$id";
                $query = $pdo->prepare ($sql);
                $query->execute ();
                $current = $query->fetch (PDO::FETCH_ASSOC);

                $user_id = $current['user_id'];

                $sql    = "SELECT * FROM usuarios WHERE id=$user_id";
                $query  = $pdo->prepare ($sql);
                $query->execute ();
                $user   = $query->fetch (PDO::FETCH_ASSOC);

                echo "User: " . $user['name'] . " Address: " . $user['address'] . "<br>";
                echo "Evento: " . $current['evento'];
            ?>
        </div>
        <footer>
            <div class="container">
                <a href="list.php" class="btn btn-danger">Regresar</a>
            </div>
        </footer>
    </body>
</html>
