<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;
use Twig_Environment;
use Twig_Loader_Filesystem;


//Esta clase, toma un archivo .yml y genera la informacion de una prueba, En el futuro tal vez, genere mas de un tema
class Prueba{

  protected $preguntasYaml;
  protected $yaml;
  protected $lecturaYaml;
  protected $preguntas = [];

  public function __construct($archivo){
    $this->yaml = new Parser();
    $this->value = $this->yaml->parse(file_get_contents($archivo));
    $this->preguntasYaml = $this->value['preguntas'];
  }

  public function crearPreguntas(){
    $cantPreguntas = count($this->preguntasYaml);
    for ($i=0; $i < $cantPreguntas; $i++) {
      $this->preguntas[$i] = new Pregunta ($this->preguntasYaml[$i]);
    }
  }

  public function mezclarPreguntas(){
    shuffle($this->preguntas);
  }

  function crearHTML(){
    $loader = new Twig_Loader_Filesystem('plantillas');
    $twig = new Twig_Environment($loader);
    $plantillaAlumno = $twig->load('alumno.html');
    $plantillaProfesor = $twig->load('profesor.html');
    file_put_contents('pruebasResultados/EvaluacionAlumno.html', $plantillaAlumno->render(array('preguntas' => $this->preguntas)));
    file_put_contents('pruebasResultados/EvaluacionProfesor.html', $plantillaProfesor->render(array('preguntas' => $this->preguntas)));
  }


}
