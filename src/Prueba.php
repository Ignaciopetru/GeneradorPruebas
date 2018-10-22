<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';
require_once ("crearHTML.php");
use Symfony\Component\Yaml\Parser;


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
  public function crearHTML(){
    crearHTML($this->preguntas);
  }



}
