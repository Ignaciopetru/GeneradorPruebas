<?php

namespace GeneradorPruebas;
require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;


class Pregunta{

  protected $descripcion;
  protected $respuestasCorrectas;
  protected $respuestasIncorrectas;
  protected $todasLasAnteriores = 'Todas las anteriores';
  protected $ningunaDeLasAnteriores = 'Ninguna de las anteriores';
  protected $ocultarTodasAnteriores = false;
  protected $ocultarNingunaAnteriores = false;
  protected $todasLasRespuestas = [];

  public function __construct($preguntaYaml){

    $this->descripcion = $preguntaYaml['descripcion'];
    $this->respuestasCorrectas = $preguntaYaml['respuestas_correctas'];
    $this->respuestasIncorrectas = $preguntaYaml['respuestas_incorrectas'];

    if (array_key_exists('ocultar_opcion_todas_las_anteriores', $preguntaYaml)) {
					$this->ocultarTodasAnteriores = true;
		}

    if (array_key_exists('ocultar_opcion_ninguna_de_las_anteriores', $preguntaYaml)) {
					$this->ocultarNingunaAnteriores = true;
    }
    if($this->ocultarTodasAnteriores != true && $preguntaYaml['respuestas_incorrectas'] = []){
      array_push($this->respuestasCorrectas, $this->todasLasAnteriores);
    }else{
      if($this->ocultarTodasAnteriores!= true && $preguntaYaml['respuestas_incorrectas'] != []){
        array_push($this->respuestasIncorrectas, $this->todasLasAnteriores);
      }
    }
    if($this->ocultarNingunaAnteriores != true && $preguntaYaml['respuestas_correctas'] = []){
      array_push($this->respuestasCorrectas, $this->$ningunaDeLasAnteriores);
    }else{
      if($this->ocultarNingunaAnteriores != true && $preguntaYaml['respuestas_correctas'] != []){
        array_push($this->respuestasIncorrectas, $this->$ningunaDeLasAnteriores);
      }
    }
    $this->todasLasRespuestas = array_merge($this->respuestasCorrectas, $this->respuestasIncorrectas);
  }

  public function mexclarRespuestas() {
    shuffle($this->todasLasRespuestas);
  }

  public function devuelveDescripcion(){
    return $this->descripcion;
  }

  public function devuelveRespuestas(){
    return $this->todasLasRespuestas;
  }

  public function devuelveCorrectas(){
    return $this->respuestasCorrectas;
  }

}
