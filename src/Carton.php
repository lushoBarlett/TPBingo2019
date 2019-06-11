<?php

namespace Bingo;

class Carton {

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
     for($m=0;$m<9;$m++){
       $filas[$m]=array( $Numeros[0] [$m], $Numeros[1] [$m], $Numeros[2] [$m]);
     }
     return $filas;
  }
  
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }

}
