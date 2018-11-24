<?php

namespace GeneradorPruebas;
//require_once '../vendor/autoload.php';
use Symfony\Component\Yaml\Parser;
use Twig_Environment;
use Twig_Loader_Filesystem;


//Esta clase, toma un archivo .yml y genera la informacion de una prueba, En el futuro tal vez, genere mas de un tema
class Prueba
{

    protected $preguntasYaml;
    protected $yaml;
    protected $lecturaYaml;
    protected $preguntas = [];
    protected $canTemas;
    protected $materia;
    protected $fecha;

    public function __construct($directorio, $tema, $materia, $fecha)
    {
        $this->fecha = $fecha;
        $this->materia = $materia;
        $this->tema = $tema;
        $this->yaml = new Parser();
        $this->value = $this->yaml->parse(file_get_contents($directorio));
        $this->preguntasYaml = $this->value['preguntas'];
    }

    public function crearPreguntas()
    {
        $cantPreguntas = count($this->preguntasYaml);
        for ($i=0; $i < $cantPreguntas; $i++) {
          $this->preguntas[$i] = new Pregunta ($this->preguntasYaml[$i]);
        }
    }

    public function devuelvePreguntas()
    {
        return $this->preguntas;
    }

    public function mezclarPreguntas()
    {
        shuffle($this->preguntas);
    }

    function crearHTML()
    {
        $loader = new Twig_Loader_Filesystem('plantillas');
        $twig = new Twig_Environment($loader);
        $plantillaAlumno = $twig->load('alumno.html');
        $plantillaProfesor = $twig->load('profesor.html');
        file_put_contents('pruebasResultados/EvaluacionAlumno'.$this->tema.'.html', $plantillaAlumno->render(array('preguntas' => $this->preguntas,'materia' => $this->materia, 'tema' => $this->tema, 'fecha' => $this->fecha)));
        file_put_contents('pruebasResultados/EvaluacionProfesor'.$this->tema.'.html', $plantillaProfesor->render(array('preguntas' => $this->preguntas ,'materia' => $this->materia, 'tema' => $this->tema, 'fecha' => $this->fecha)));
        return true;
    }


}
