<?php

    session_start();
    include '../includes/config.php';
    $pdo = Database::getConnection();

    $result = false;

    ini_set('error_reporting', 0);

    function userExists($username) {
        $pdo = Database::getConnection();

        $query = $pdo->prepare("SELECT COUNT(id) FROM usuarios WHERE user = '$username'");
        $query->bindValue(1, $username);
        try{
            $query->execute();
            $rows = $query->fetchColumn();
            if($rows >= 1){
                return true;
            } else {
                return false;
            }
        }catch (PDOException $e){
            die($e->getMessage());
        }
     }

    if ($_POST) {
        $nombre = $_POST['nomb'];
        $cedula = $_POST['cedu'];
        $sexo = $_POST['sexo'];
        $direccion = $_POST['dire'];
        $telefono = $_POST['tele'];
        $correo = $_POST['corr'];

        $usuario = $_POST['usua'];
        $contrasena = md5 ($_POST['cont']);

        if (userExists($usuario)) {
            echo "<div class=''><p class='alert alert-danger'>El usuario ya existe</p></div>";
        } else {
            $sql = "INSERT INTO usuarios(name, dni, address, sex, phone, email, user, pass)" .
                   "VALUES (:name, :dni, :address, :sex, :phone, :email, :user, :pass)";
            $query = $pdo->prepare($sql);
            $result = $query->execute([
                'name' => $nombre,
                'dni' => $cedula,
                'address' => $direccion,
                'sex' => $sexo,
                'phone' => $telefono,
                'email' => $correo,
                'user' => $usuario,
                'pass' => $contrasena
            ]);
            $result = true;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistema de boletos de eventos - Registro</title>
        <link rel="stylesheet" href="../bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form class="form-group" action="" method="post">
                <fieldset id="">
                <legend>Registro</legend>
                <?php
                    if ($result)
                        echo "<div class='alert alert-success'>Registrado!</div>";
                ?>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="nomApe">Nombre y apellido</label>
                        <input type="text" class="form-control" name="nomb" id="nomApe" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cedula">Cédula</label>
                        <input type="number" class="form-control" name="cedu" id="cedula" required>
                    </div>
                    <div class="col-md-2">
                        <label for="sexo">Sexo</label><br>
                        Male <input type="radio" name="sexo" value="M" checked>
                        Female <input type="radio" name="sexo" value="F">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="dire" id="direccion" required>
                    </div>
                    <div class="col-md-3">
                        <label for="telefono">Telefono</label>
                        <div class="form-group">
                            <div class="col-md-5">
                                <select class="form-control" name="codArea">
                                    <option value="0416">0416</option>
                                    <option value="0416">0426</option>
                                    <option value="0416">0414</option>
                                    <option value="0416">0424</option>
                                    <option value="0416">0412</option>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="tele" id="telefono" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control" name="corr" id="email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5">
                        <label for="user">Usuario</label>
                        <input type="text" class="form-control" name="usua" id="user" required>
                    </div>
                    <div class="col-md-5">
                        <label for="contrasena">Contraseña</label>
                        <input type="password" class="form-control" name="cont" id="contrasena" required>
                    </div>
                    <div class="col-md-2">
                        <br>
                        <input type="submit" class="btn btn-primary"name="" value="Registrar">
                    </div>
                </div>
                </fieldset>
            </form>
        </div>
    </body>
</html>
