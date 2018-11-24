<?php

namespace GeneradorPruebas;
//require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
  * @desc genera un prueba,y dos archivos html
*/
class Prueba
{

    protected $preguntasYaml;
    protected $yaml;
    protected $lecturaYaml;
    protected $preguntas = [];
    protected $canTemas;
    protected $materia;
    protected $fecha;

    /**
      * @desc devuelve construye la clase pruega
      * @param string toma un directorio un tema una materia y una fecha y genera una prueba
      * @return
    */
    public function __construct($directorio, $tema, $materia, $fecha)
    {
        $this->fecha = $fecha;
        $this->materia = $materia;
        $this->tema = $tema;
        $this->yaml = new Parser();
        $this->value = $this->yaml->parse(file_get_contents($directorio));
        $this->preguntasYaml = $this->value['preguntas'];
    }

    /**
      * @desc crea una array de objetos pregunta
    */
    public function crearPreguntas()
    {
        $cantPreguntas = count($this->preguntasYaml);
        for ($i=0; $i < $cantPreguntas; $i++) {
          $this->preguntas[$i] = new Pregunta ($this->preguntasYaml[$i]);
        }
    }

    /**
      * @desc devuelve las preguntas
      * @return array
    */
    public function devuelvePreguntas()
    {
        return $this->preguntas;
    }

    /**
      * @desc mezcla las preguntas
    */
    public function mezclarPreguntas()
    {
        shuffle($this->preguntas);
    }

    /**
      * @desc crea el html de las pruebas
      * @return html retorna dos archivos html
    */
    function crearHTML()
    {
        $loader = new Twig_Loader_Filesystem('plantillas');
        $twig = new Twig_Environment($loader);
        $plantillaAlumno = $twig->load('alumno.html');
        $plantillaProfesor = $twig->load('profesor.html');
        $antes= count(glob('GeneradorPruebas/pruebasResultados/{.html}',GLOB_BRACE));
        file_put_contents('pruebasResultados/EvaluacionAlumno'.$this->tema.'.html', $plantillaAlumno->render(array('preguntas' => $this->preguntas,'materia' => $this->materia, 'tema' => $this->tema, 'fecha' => $this->fecha)));
        file_put_contents('pruebasResultados/EvaluacionProfesor'.$this->tema.'.html', $plantillaProfesor->render(array('preguntas' => $this->preguntas ,'materia' => $this->materia, 'tema' => $this->tema, 'fecha' => $this->fecha)));
        $total = count(glob('GeneradorPruebas/pruebasResultados/{.html}',GLOB_BRACE));
    }


}
