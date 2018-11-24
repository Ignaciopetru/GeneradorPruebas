<?php

namespace GeneradorPruebas;
//require_once '../vendor/autoload.php';


/**
  * @desc genera un pregunta,con su descripcion y respuestas
*/
class Pregunta
{

    protected $descripcion;
    protected $respuestasCorrectas;
    protected $respuestasIncorrectas;
    protected $ocultarTodasAnteriores = false;
    protected $ocultarNingunaAnteriores = false;
    protected $todasLasRespuestas = [];
    protected $correctasProfesor = ' ';

    /**
	  * @desc devuelve construye la clase pregunta
	  * @param array donde se encuentra la informaciosn necesaria
	  * @return
	*/
    public function __construct($preguntaYaml)
    {

        $this->descripcion = $preguntaYaml['descripcion'];
        $this->respuestasCorrectas = $preguntaYaml['respuestas_correctas'];
        $this->respuestasIncorrectas = $preguntaYaml['respuestas_incorrectas'];

        if (array_key_exists('ocultar_opcion_todas_las_anteriores', $preguntaYaml)) {
            $this->ocultarTodasAnteriores = true;
        }

        if (array_key_exists('ocultas_opcion_ninguna_de_las_anteriores', $preguntaYaml)) {
        	$this->ocultarNingunaAnteriores = true;
        }

        if ($this->ocultarTodasAnteriores != true && count($preguntaYaml['respuestas_incorrectas']) == 0) {
            $this->respuestasIncorrectas = $this->respuestasCorrectas;
            $this->respuestasCorrectas = [];
            array_push($this->respuestasCorrectas, 'Todas las anteriores');
        } else {
            if ($this->ocultarTodasAnteriores!= true && count($preguntaYaml['respuestas_incorrectas']) != 0) {
                array_push($this->respuestasIncorrectas, 'Todas las anteriores');
            }
        }

        if ($this->ocultarNingunaAnteriores != true && count($preguntaYaml['respuestas_correctas']) == 0) {
            array_push($this->respuestasCorrectas, 'Ninguna de las anteriores');
        } else {
            if ($this->ocultarNingunaAnteriores != true && count($preguntaYaml['respuestas_correctas']) != 0) {
                array_push($this->respuestasIncorrectas, 'Ninguna de las anteriores');
            }
        }

        $this->todasLasRespuestas = array_merge($this->respuestasCorrectas, $this->respuestasIncorrectas);
        $this->calcularCorrectasProfe();

    }

    /**
      * @desc mezcla las respuestas
    */
    public function mezclarRespuestas()
    {
        shuffle($this->todasLasRespuestas);
    }

    /**
      * @desc devuelve la descripcion
      * @return string
    */
    public function devuelveDescripcion()
    {
        return $this->descripcion;
    }

    /**
      * @desc devuelve las respuestas
      * @return array
    */
    public function devuelveRespuestas()
    {
        return $this->todasLasRespuestas;
    }

    /**
      * @desc devuelve las respuestas correctas
      * @return array
    */
    public function devuelveCorrectas()
    {
        return $this->respuestasCorrectas;
    }

    /**
      * @desc devuelve las respuestas incorrectas
      * @return array
    */
    public function devuelveIncorrectas()
    {
        return $this->respuestasIncorrectas;
    }

    /**
      * @desc devuelve las letras asigandas a las respuestas correctas
      * @return string
    */
    public function devuelveCorrectasProfe()
    {
        return $this->correctasProfesor;
    }

    /**
      * @desc genera las letras asigandas a las respuestas correctas
      * @return
    */
    private function calcularCorrectasProfe()
    {
    $this->mezclarRespuestas();
    $letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];
        for ($i=0; $i < count($this->todasLasRespuestas); $i++) {
            for ($j=0; $j < count($this->respuestasCorrectas); $j++) {
                if ($this->todasLasRespuestas[$i] == $this->respuestasCorrectas[$j]) {
                    $this->correctasProfesor = $this->correctasProfesor . $letras[$i];
                }
            }
        }
    }

}
