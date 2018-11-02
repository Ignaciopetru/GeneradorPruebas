<?php

namespace GeneradorPruebas;
use PHPUnit\Framework\TestCase;


class testPregunta extends TestCase {
    public function testPreguntas() {
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
}
