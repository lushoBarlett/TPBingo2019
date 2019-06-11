<?php

namespace Bingo;

class FabricaCartones {
  
  protected $randomCarton = [];

  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
    do{
      $this->randomCarton = $this->intentoCarton();
    }while($this->cartonEsValido($randomCarton) == FALSE);
    
    return $randomCarton;
  }

  protected function cartonEsValido($carton) {
    if (validarUnoANoventa($carton) &&
      validarCincoNumerosPorFila($carton) &&
      validarColumnaNoVacia($carton) &&
      validarColumnaCompleta($carton) &&
      validarTresCeldasIndividuales($carton) &&
      validarNumerosIncrementales($carton) &&
      validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
    return FALSE;
  }
  
  // validate
  
  protected function validarUnoANoventa($carton) {
  $numeros = $carton->numerosDelCarton();
    foreach($numeros as $numero){
      if(!($numero >= 1 && $numero <= 90)){
        return FALSE;
      }
    }
    return TRUE;
  }

  protected function validarCincoNumerosPorFila($carton) {
   $filas = $carton->filas();
    foreach($filas as $fila){
      $count = 0;
      foreach($fila as $celda){
        if($celda != 0){
          $count++;
        }
      }
      if($count != 5){
        return FALSE;
      }
    }
    return TRUE;
  }

  protected function validarColumnaNoVacia($carton) {
  $columnas = $carton->columnas();
    foreach($columnas as $columna){
      $count = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $count++;
        }
      }
      if($count <= 0){
        return FALSE;
      }
    }
    return TRUE;
  }

  protected function validarColumnaCompleta($carton) {
  $columnas = $carton->columnas();
    foreach($columnas as $columna){
      $count = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $count++;
        }
      }
      if($count >= 3){
        return FALSE;
      }
    }
    return TRUE;
  }

  protected function validarTresCeldasIndividuales($carton) {
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
    if($unaCelda == 3){
      return TRUE;
    }
    return FALSE;
  }

  protected function validarNumerosIncrementales($carton) {
  $columnas = $carton->columnas();
    
    // paso previo al paso iterativo (columna 1)
    $max = 0;
    for($j = 0; $j < count($columnas[0]); $j++){
        $max = $max < $columnas[0][$j] ? $columnas[0][$j] : $max;
    }
    
    for($i = 1; $i < count($columnas); $i++){
      $min = 91;
      for($j = 0; $j < count($columnas[$i]); $j++){
        $min = $min > $columnas[$i][$j] && $columnas[$i][$j] != 0 ? $columnas[$i][$j] : $min;
      }
      // minimo de una columna mayor al maximo de la anterior
      if($min <= $max){
        return FALSE;
      }
      $max = 0;
      for($j = 0; $j < count($columnas[$i]); $j++){
        $max = $max < $columnas[$i][$j] ? $columnas[$i][$j] : $max;
      }
    }
    return TRUE;
  }

  protected function validarFilasConVaciosUniformes($carton) {
  $filas = $carton->filas();
    foreach($filas as $fila){
      for($i = 0; $i < count($fila) - 2; $i++){
        if($fila[$i] == 0 && $fila[$i+1] == 0 && $fila[$i+2] == 0){
          return FALSE;
        }
      }
    }
    return TRUE;
  }


  public function intentoCarton() {
    $contador = 0;

    $carton = [
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0]
    ];
    $numerosCarton = 0;

    while ($numerosCarton < 15) {
      $contador++;
      if ($contador == 50) {
        return $this->intentoCarton();
      }
      $numero = rand (1, 90);

      $columna = floor ($numero / 10);
      if ($columna == 9) { $columna = 8;}
      $huecos = 0;
      for ($i = 0; $i<3; $i++) {
        if ($carton[$columna][$i] == 0) {
          $huecos++;
        }
        if ($carton[$columna][$i] == $numero) {
          $huecos = 0;
          break;
        }
      }
      if ($huecos < 2) {
        continue;
      }

      $fila = 0;
      for ($j=0; $j<3; $j++) {
        $huecos = 0;
        for ($i = 0; $i<9; $i++) {
          if ($carton[$i][$fila] == 0) { $huecos++; }
        }

        if ($huecos < 5 || $carton[$columna][$fila] != 0) {
          $fila++;
        } else{
          break;
        }
      }
      if ($fila == 3) {
        continue;
      }

      $carton[$columna][$fila] = $numero;
      $numerosCarton++;
      $contador = 0;
    }

    for ( $x = 0; $x < 9; $x++) {
      $huecos = 0;
      for ($y =0; $y < 3; $y ++) {
        if ($carton[$x][$y] == 0) { $huecos++;}
      }
      if ($huecos == 3) {
        return $this->intentoCarton();
      }
    }

    return $carton;
  }

}
