<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   */
  public function testUnoANoventa() {
    $carton = new CartonEjemplo();
    $numeros = $carton->numerosDelCarton();
    foreach($numeros as $numero){
      $this->assertTrue($numero >= 1 && $numero <= 90);
    }
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   */
  public function testCincoNumerosPorFila() {
    $carton = new CartonEjemplo();
    $filas = $carton->filas();
    foreach($filas as $fila){
      $count = 0;
      foreach($fila as $celda){
        if($celda != 0){
          $count++;
        }
      }
      $this->assertTrue($count == 5);
    }
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   */
  public function testColumnaNoVacia() {
    $carton = new CartonEjemplo();
    $columnas = $carton->columnas();
    foreach($columnas as $columna){
      $count = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $count++;
        }
      }
      $this->assertTrue($count > 0);
    }
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   */
  public function testColumnaCompleta() {
    $carton = new CartonEjemplo();
    $columnas = $carton->columnas();
    foreach($columnas as $columna){
      $count = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $count++;
        }
      }
      $this->assertTrue($count <= 3);
    }
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   */
  public function testTresCeldasIndividuales() {
    $carton = new CartonEjemplo();
    $columnas = $carton->columnas();
    $unaCelda = 0;
    foreach($columnas as $columna){
      $count = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $count++;
        }
      }
      if($count == 1){
        $unaCelda++;
      }
    }
    $this->assertTrue($unaCelda == 3);
  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   */
  public function testNumerosIncrementales() {
    $carton = new CartonEjemplo();
    $columnas = $carton->columnas();
    
    // paso previo al paso iterativo (columna 1)
    $max = 0;
    for($j = 0; $j < count($columnas[$i]); $j++){
        $max = $max < $celda ? $celda : $max;
    }
    
    for($i = 1; $i < count($columnas); $i++){
      $min = 91;
      for($j = 0; $j < count($columnas[$i]); $j++){
        $min = $min > $columnas[$i][$j] && $columnas[$i][$j] != 0 ? $columnas[$i][$j] : $min;
      }
      // minimo de una columna mayor al maximo de la anterior
      $this->assertTrue($min > $max);
      $max = 0;
      for($j = 0; $j < count($columnas[$i]); $j++){
        $max = $max < $celda ? $celda : $max;
      }
    }
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   */
  public function testFilasConVaciosUniformes() {
    $carton = new CartonEjemplo();
    $columnas = $carton->columnas();
    foreach($columnas as $columna){
      for($i = 0; $i < count($columna) - 1; $i++){
        $this->assertFalse($columna[$i] == 0 && $columna[$i+1] == 0);
      }
    }
  }

}
