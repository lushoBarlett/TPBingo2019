<?php

namespace Bingo;

class Carton implements CartonInterface{

  protected $numeros_carton = [];

  public function __construct(array $carton_aleatorio) {
    $this->numeros_carton = $carton_aleatorio;
  }

  public function columnas() {
    return $this->numeros_carton;
  }
  
  public function filas() {
     $filas = [];
     $Numeros = $this->numeros_carton;
     for($m=0;$m<3;$m++){
       $filas[$m]=array( $Numeros  [0] [$m] , $Numeros  [1] [$m] , $Numeros [2] [$m],
                         $Numeros  [3] [$m], $Numeros  [4] [$m], $Numeros [5] [$m] ,
                         $Numeros  [6] [$m]  , $Numeros  [7] [$m], $Numeros [8] [$m]);
     }
     return $filas;
  }
  
  public function numerosDelCarton() {
    $numeros = [];
    foreach ($this->filas() as $fila) {
      foreach ($fila as $celda) {
        if ($celda != 0) {
          $numeros[] = $celda;
        }
      }
    }
    return $numeros;
  }
  
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }

}
