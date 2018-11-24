<?php

namespace GeneradorPruebas;
//require_once '../vendor/autoload.php';

include ('index.php');
$canTemas = $_POST['canTemas'];
$archivo = $_POST['archivo'];
$materia = $_POST['materia'];
$fecha = $_POST['fecha'];

for ($i=1; $i <= $canTemas; $i++) {
    $salida = new Prueba($archivo, $i, $materia, $fecha);
    $salida->crearPreguntas();
    $salida->mezclarPreguntas();
    $salida->crearHTML();
}
