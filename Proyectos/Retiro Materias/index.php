<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema de retiro de asignaturas</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/master.css">
    </head>
    <body>
        <div class="container caja">
            <header>
                <h1>Sistema de retiro de asignaturas</h1>
            </header>
            <?php if ($resultado) {
                echo "coño bien hecho xd";
                // esto no sale por que no se como hacerlo son las 3am tengo pereza
                // new update: ya se como se hace, pero no quiero cambiar todo el codigo asi que lo dejo asi :v
            } ?>
            <form class="form-group" action="retiro.php" method="post">
                <fieldset id="alumno">
                    <legend>Alumno</legend>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="nomAlu">Nombre y Apellido: </label>
                            <input type="text" class="form-control" name="nombreAlumno" id="nomAlu" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-4">
                            <label for="cedAlu">Cédula: </label>
                            <input type="number" min="1" max="35000000" class="form-control" name="cedulaAlumno" id="cedAlu" placeholder="V-26458712" required>
                        </div>
                    </div>
                    <div class="form-group row nivel2">
                        <div class="col-md-8">
                            <label for="carAlu">Carrera: </label>
                            <input type="text" class="form-control" name="carreraAlumno" id="carAlu" placeholder="Ing. Informática" required>
                        </div>
                        <div class="col-md-4">
                            <label for="numSem">Semestre: </label>
                            <input type="number" min="1" max="10" class="form-control" name="numeroSemestre" id="numSem" placeholder="5" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="asignatura">
                    <legend>Asignatura</legend>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nomAsig">Nombre de la Asignatura: </label>
                            <input type="text" class="form-control" name="nombreAsignatura" id="nomAsig" placeholder="Programación II" required>
                        </div>
                        <div class="col-md-4">
                            <label for="codAsig">Código: </label>
                            <input type="number" class="form-control" name="codigoAsignatura" id="codAsig" placeholder="0415405T" required>
                        </div>
                        <div class="col-md-2">
                            <label for="ucAsig">U.C.</label>
                            <input type="number" class="form-control" name="ucAsignatura" id="ucAsig" placeholder="3" required>
                        </div>
                    </div>
                    <div class="">
                        <label for="motRetAsig">Motivo de retiro</label>
                        <textarea name="motivoRetiro" class="form-control" id="motRetAsig" rows="4" cols="80"></textarea>
                    </div>
                </fieldset>
                <div class="form-group" id="btn-center">
                    <input type="submit" class="btn btn-primary" value="Procesar retiro">
                </div>
            </form>
        </div>
    </body>
</html>
