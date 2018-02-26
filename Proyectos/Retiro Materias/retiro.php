<?php

    $resultado = false;

    if ($_POST) {
        $nombreAlumno = $_POST['nombreAlumno'] . '<br>';
        $cedulaAlumno = 'V-'. $_POST['cedulaAlumno'] . '<br>';
        $carrerAlumno = $_POST['carreraAlumno'] . '<br>';
        $semestAlumno = $_POST['numeroSemestre']. '<br>';

        $nombreAsigna = $_POST['nombreAsignatura'] . '<br>';
        $codigoAsigna = $_POST['codigoAsignatura'] . 'T' . '<br>';
        $unidadAsigna = $_POST['ucAsignatura'] . '<br>';
        $motivoAsigna = $_POST['motivoRetiro'] . '<br>';

        echo $nombreAlumno;
        echo $cedulaAlumno;
        echo $carrerAlumno;
        echo $semestAlumno;

        echo $nombreAsigna;
        echo $codigoAsigna;
        echo $unidadAsigna;
        echo $motivoAsigna;

    } else {
        header("Location:index.php");
    }
