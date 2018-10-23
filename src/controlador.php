<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';


include ('index.php');

//continua bajo pruebas, no es resultado final
$v = new Prueba('/home/ignaciopetru/Descargas/preguntas.yml'/*$_POST['archivo']*/, $_POST['canTemas'], $_POST['materia']);
$v->crearPreguntas();
$v->crearHTML();
//echo $a;
