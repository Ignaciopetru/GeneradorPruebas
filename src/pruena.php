<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;

$v = new Prueba('/home/ignaciopetru/Descargas/preguntas.yml');
$v->crearPreguntas();
$v->crearHTML();
//echo $a;
