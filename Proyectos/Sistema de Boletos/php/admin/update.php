<?php
    session_start();
    include '../../includes/config.php';
    $pdo = Database::getConnection();
    $result = false;

    if (!$_SESSION['admin'])
        header ("Location:../../index.php");

    if (!empty($_POST)) {
        $id = $_POST['id'];

        $newSerial = $_POST['serial'];
        $newEvento = $_POST['evento'];
        $newFecha  = $_POST['fecha'];
        $newZona   = $_POST['zona'];
        $sql = "UPDATE boletos SET serial=:serial, evento=:evento, fecha=:fecha, zona=:zona WHERE id=:id";
        $query = $pdo->prepare($sql);
        $result = $query->execute([
            'serial' => $newSerial,
            'evento' => $newEvento,
            'fecha' => $newFecha,
            'zona' => $newZona,
            'id' => $id
        ]);

    } else {
        $id = $_GET['id'];
        $sql = "SELECT * FROM boletos WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

        $row = $query->fetch(PDO::FETCH_ASSOC);

        $serial = $row['serial'];
        $evento = $row['evento'];
        $fecha  = $row['fecha'];
        $zona   = $row['zona'];
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
                <h3>Registro de boleto</h3>
                <?php if ($result): ?>
                    <div class='alert alert-success'>Boleto actualizado!</div>
                <?php endif ?>
                <form class="form-group" action="" method="POST">
                    <div class="form-group compra row">
                        <div class="col-md-4">
                            <label for="serial">Serial</label>
                            <input type="number" class="form-control" name="serial" id="serial" value="<?php echo $serial; ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="evento">Nombre del Evento</label>
                            <select class="form-control" name="evento" id="evento" required>
                                <?php
                                    $sql = "SELECT * FROM eventos";
                                    $query = $pdo->prepare ($sql);
                                    $query->execute ();

                                    while ($current = $query->fetch(PDO::FETCH_ASSOC)) :
                                        if ($current['disponible'] === 1) :
                                ?>
                                    <option value="<?= $current['evento']; ?>" <?php if ($current['evento'] == $evento) echo "selected"?>><?= $current['evento']; ?></option>
                                <?php endif; endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha">Fecha del Evento</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="<?= $fecha ?>" required>
                        </div>
                    </div>
                    <div class="form-group compra row">
                        <div class="col-md-4">
                            <select class="form-control" name="zona">
                                <?php
                                    $arr = ['Altos', 'Medios', "VIP", "Platino"];
                                    foreach ($arr as $value) :
                                ?>
                                    <option value="<?= $value ?>" <?php if ($value == $zona) echo "selected"?>><?= $value ?></option>

                                <?php endforeach ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary form" name="" value="Actualizar">
                        </div>
                    </div>
                </form>
            <?php else: ?>
                Necesita estar registrado para poder registrar la información de un boleto adquirido
            <?php endif ?>
        </div>
        <footer>
            <div class="container">
                <a href="list.php" class="btn btn-danger">Regresar</a>
            </div>
        </footer>
    </body>
</html>
