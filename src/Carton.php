<?php

namespace Bingo;

class CartonEjemplo {

  protected $numeros_carton = [];

  public function __construct($carton) {
    $numeros_carton = $carton->numeros_carton;
  }

  public function filas() {
    return $this->numeros_carton;
  }
  
  public function columnas() {
     $columnas = [];
     $Numeros = $this->numeros_carton;
     for($m=0;$m<9;$m++){
       $columnas[$m]=array( $Numeros[0] [$m], $Numeros[1] [$m], $Numeros[2] [$m]);
     }
     return $columnas;
  }
  
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }

}
