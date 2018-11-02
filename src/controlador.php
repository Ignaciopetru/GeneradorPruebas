<?php

namespace GeneradorPruebas;
//require_once '../vendor/autoload.php';

include ('index.php');
$canTemas = $_POST['canTemas'];
$materia = $_POST['materia'];
$directorio = $_POST['archivo'];

for ($i=1; $i <= $canTemas; $i++) {
    $salida = new Prueba($_POST['archivo'], $i, $_POST['materia']);
    $salida->crearPreguntas();
    $salida->mezclarPreguntas();
    $salida->crearHTML();
}
