<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;

//Esta clase, toma un archivo .yml y genera la informacion de una prueba, En el futuro tal vez, genere mas de un tema
class Prueba{
  protected $a;
  protected $yaml = new Parser();
  protected $value;
  public function __construct($archivo){
    $this->value = $this->yaml->parse(file_get_contents('/home/ignaciopetru/Descargas/preguntas.yml'));
    $this->a = $this->value['preguntas'][0]['descripcion'];
  }
  public function hola(){
    return 'asdf';
  }
  public function as(){
    echo 'asdf';
  }
}



 ?>
