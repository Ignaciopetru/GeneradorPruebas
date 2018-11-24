<?php

namespace GeneradorPruebas;
use PHPUnit\Framework\TestCase;


class testPregunta extends TestCase {

    /**
      * @desc Comprueba que los metodos de la clase pregunta funcionen correctamente. En los siguientes tests
      * varia los posibles casos.
      */
    public function testPreguntas1() {
        $preguntaYaml = array(
                "descripcion" => "Esto es un test",
                "respuestas_correctas" => array("Esta respuesta es correcta", "Esta tambien"),
                "respuestas_incorrectas" => array("Esta respuesta es incorrecta", "Esta es incorrecta"),
                "ocultar_opcion_todas_las_anteriores" => true,
                );

        $pregunta = New Pregunta($preguntaYaml);

        $this->assertEquals($pregunta->devuelveDescripcion(), "Esto es un test");
        $this->assertEquals($pregunta->devuelveCorrectas(), array("Esta respuesta es correcta", "Esta tambien"));
        $this->assertEquals(count($pregunta->devuelveRespuestas()), 5);
        $this->assertEquals(mb_strlen($pregunta->devuelveCorrectasProfe()), 3);
        $sinM = $pregunta->devuelveRespuestas();
        $pregunta->mezclarRespuestas();
        if($sinM == $pregunta->devuelveRespuestas()){
            $iguales = true;
        }else{
            $iguales = false;
        }
        $this->assertFalse($iguales);
    }
    
    public function testPreguntas2() {
        $preguntaYaml = array(
                "descripcion" => "Esto es un test",
                "respuestas_correctas" => array("Esta respuesta es correcta", "Esta tambien"),
                "respuestas_incorrectas" => array("Esta respuesta es incorrecta", "Esta es incorrecta"),
                "ocultar_opcion_todas_las_anteriores" => true,
                "ocultar_opcion_ninguna_de_las_anteriores" => true,
                );

        $pregunta = New Pregunta($preguntaYaml);

        $this->assertEquals($pregunta->devuelveDescripcion(), "Esto es un test");
        $this->assertEquals($pregunta->devuelveCorrectas(), array("Esta respuesta es correcta", "Esta tambien"));
        $this->assertEquals(count($pregunta->devuelveRespuestas()), 4);
        $this->assertEquals(mb_strlen($pregunta->devuelveCorrectasProfe()), 3);
    }
   
    public function testPreguntas3() {
        $preguntaYaml = array(
                "descripcion" => "Esto es un test",
                "respuestas_correctas" => array("Esta respuesta es correcta", "Esta tambien"),
                "respuestas_incorrectas" => array(),
                "ocultar_opcion_ninguna_de_las_anteriores" => true,
                );

        $pregunta = New Pregunta($preguntaYaml);

        $this->assertEquals($pregunta->devuelveCorrectas(), array("Todas las anteriores"));
        $this->assertEquals(count($pregunta->devuelveRespuestas()), 3);
        $this->assertEquals(count($pregunta->devuelveIncorrectas()), 2);
    }

    public function testPreguntas4() {
        $preguntaYaml = array(
                "descripcion" => "Esto es un test",
                "respuestas_correctas" => array("Esta respuesta es correcta", "Esta tambien"),
                "respuestas_incorrectas" => array("Hay una mas incorrecta"),
                "ocultar_opcion_ninguna_de_las_anteriores" => true,
                );

        $pregunta = New Pregunta($preguntaYaml);

        $this->assertEquals($pregunta->devuelveIncorrectas(), array("Hay una mas incorrecta","Todas las anteriores"));
    }

    public function testPreguntas5() {
        $preguntaYaml = array(
                "descripcion" => "Esto es un test",
                "respuestas_correctas" => array(),
                "respuestas_incorrectas" => array("Hay una mas incorrecta"),
                );

        $pregunta = New Pregunta($preguntaYaml);

        $this->assertEquals($pregunta->devuelveCorrectas(), array("Ninguna de las anteriores"));
    }

}
