<?php

namespace GeneradorPruebas;
use PHPUnit\Framework\TestCase;

class testPrueba extends TestCase {

    /**
      * @desc Genera y comprueba los datos de una prueba ejemplo
    */

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

    public function testPruebasMul() {
        $prueba = New Prueba( "./tests/preguntas.yml", 25, "Matematica", "28/11/18");
        $prueba->crearPreguntas();
        $this->assertEquals(count($prueba->devuelvePreguntas()), 25);
        $antes = $prueba->devuelvePreguntas();
        $prueba->mezclarPreguntas();
        $despues = $prueba->devuelvePreguntas();
        $this->assertFalse(current($despues) == current($antes));
        $prueba->crearHTML();
    }
}
