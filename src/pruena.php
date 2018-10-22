<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;
spl_autoload_register(function ($nombre_clase) {
    include $nombre_clase . '.php';
});

$v = new Prueba('/home/ignaciopetru/Descargas/preguntas.yml');
$v->crearPreguntas();
$v->crearHTML();
//echo $a;
