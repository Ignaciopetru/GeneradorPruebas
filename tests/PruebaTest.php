<?php

namespace GeneradorPruebas;
use PHPUnit\Framework\TestCase;

class testPrueba extends TestCase {

    public function testPruebas() {
        $prueba = New Prueba( "./tests/archivoTest.yml", 1, "Matematica", "23/5/12");
        $prueba->crearPreguntas();
        $this->assertEquals(count($prueba->devuelvePreguntas()), 1);
        $antes = $prueba->devuelvePreguntas();
        $prueba->mezclarPreguntas();
        $despues = $prueba->devuelvePreguntas();
        $this->assertTrue(current($despues) == current($antes));
        $prueba->crearHTML();
    }
}
