<?php

namespace GeneradorPruebas;
//require_once '../vendor/autoload.php';



class Pregunta
{

    protected $descripcion;
    protected $respuestasCorrectas;
    protected $respuestasIncorrectas;
    protected $ocultarTodasAnteriores = false;
    protected $ocultarNingunaAnteriores = false;
    protected $todasLasRespuestas = [];
    protected $correctasProfesor = ' ';

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

    public function mezclarRespuestas()
    {
        shuffle($this->todasLasRespuestas);
    }

    public function devuelveDescripcion()
    {
        return $this->descripcion;
    }

    public function devuelveRespuestas()
    {
        return $this->todasLasRespuestas;
    }

    public function devuelveCorrectas()
    {
        return $this->respuestasCorrectas;
    }

    public function devuelveIncorrectas()
    {
        return $this->respuestasIncorrectas;
    }

    public function devuelveCorrectasProfe()
    {
        return $this->correctasProfesor;
    }

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
