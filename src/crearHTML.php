<?php

require_once '../vendor/autoload.php';
//use Twig_Environment;
//use Twig_Loader_Filesystem;


function crearHTML($preguntas){
  $loader = new Twig_Loader_Filesystem('plantillas');
  $twig = new Twig_Environment($loader);
  $templateAlumn = $twig->load('alumno.html');

  file_put_contents('pruebasResultados/EvaluacionAlumno.html', $templateAlumn->render(array('preguntas' => $preguntas)));
}


 ?>
