<?php
    session_start();
    include '../../includes/config.php';
    $pdo = Database::getConnection();
    $result = false;

    if (!empty ($_POST)) {
        $sql = "INSERT INTO eventos(evento, altos, medios, vip, platino, disponible)".
                "VALUES (:evento, :altos, :medios, :vip, :platino, :disponible)";
        $query = $pdo->prepare ($sql);
        $result = $query->execute ([
            'evento' => $_POST['evento'],
            'altos' => $_POST['altos'],
            'medios' => $_POST['medios'],
            'vip' => $_POST['vip'],
            'platino' => $_POST['platino'],
            'disponible' => 1
        ]);
        $result = true;
    }

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
        <style media="screen">
            div.caja {
                width: 80%;
                margin: 0 auto;
            }
            .general {
                margin-bottom: 2em;
            }
            div.compra {
                width: 60%;
                margin: 0 auto;
                margin-bottom: 2em;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Compra de boletos</h2>
            <?php if (isset($_SESSION['userID'])) :
                echo "Bienvenido " . $_SESSION['userName'];
            ?>
                <h3>Registro de evento</h3>
                <?php if ($result): ?>
                    <div class='alert alert-success'>Evento registrado!</div>
                <?php endif ?>
                <form class="form-group" action="" method="POST">
                    <div class="form-group compra row">
                        <div class="col-md-4">
                            <label for="evento">Evento</label>
                            <input type="text" class="form-control" name="evento" id="evento" value="" required>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <label for="altos">Altos</label>
                                <input type="number" class="form-control" name="altos" id="altos" value="" required>
                            </div>
                            <div class="col-md-3">
                                <label for="medios">Medios</label>
                                <input type="number" class="form-control" name="medios" id="medios" value="" required>
                            </div>
                            <div class="col-md-3">
                                <label for="vip">VIP</label>
                                <input type="number" class="form-control" name="vip" id="evento" value="" required>
                            </div>
                            <div class="col-md-3">
                                <label for="platino">Platino</label>
                                <input type="number" class="form-control" name="platino" id="platino" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group compra row">

                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary form" name="" value="Registrar">
                        </div>
                    </div>
                </form>
            <?php else: ?>
                Necesita estar registrado para poder registrar la información de un boleto adquirido
            <?php endif ?>
        </div>
        <footer>
            <div class="container">
                <a href="index.php" class="btn btn-danger">Regresar</a>
            </div>
        </footer>
    </body>
</html>
