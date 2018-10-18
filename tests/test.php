<?php
namespace GeneradorPruebas;
use PHPUnit\Framework\TestCase;
class PruebaTest extends TestCase {
  public function testSaldoCero() {
    $v = new Prueba('/home/ignaciopetru/Descargas/preguntas.yml');
    assertEquals($v->hola(), 'asdf');
  }
}
