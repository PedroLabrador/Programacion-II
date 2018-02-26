<?php
    session_start();
    include '../includes/config.php';

    if (isset($_SESSION['userID'])) {
        header ("Location: ../index.php");
    }

    if ($_POST) {

        $pdo = Database::getConnection();

        $username = $_POST['user'];
        $password = md5 ($_POST['pass']);

        $query = $pdo->prepare("SELECT * FROM usuarios WHERE user=:username AND pass=:password LIMIT 1");

        try {
            $query->execute([
                'username' => $username,
                'password' => $password
            ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($username === $user['user'] && $password === $user['pass']) {
                $_SESSION['userID'] = $user['id'];
                $_SESSION['userName'] = $user['name'];
                if ($user['privileges'])
                    $_SESSION['admin'] = true;
                else
                    $_SESSION['admin'] = false;
                header("Location: ../index.php");
            } else {
                echo "no coinciden papuh";
            }
        } catch (PDOException $e){
            die($e->getMessage());
        }






    }


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Sistema de boletos de eventos - Login</title>
    <style>
        body {
            padding-top: 2em;
        }
        div.contenedor, div.caja {
            width: 40%;
            margin: 0 auto;
        }
        #botonsito {
            margin-top: 1em;
        }
    </style>
</head>
<body>
    <div class="container contenedor">
        <form class="form-group row" action="" method="POST">
            <div class="form-group">
                <div class="col-md-12">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="user" id="usuario">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" class="form-control" name="pass" id="contrasena">
                    <small>Se diferencia entre mayúsculas y minúsculas</small>
                </div>
            </div>
            <div class="form-group botonsito">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary form-control" id="botonsito" value="Ingresar">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
