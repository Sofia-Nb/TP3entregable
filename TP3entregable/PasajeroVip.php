<?php
include_once 'Pasajero.php';
class  PasajeroVip extends Pasajero{
    private $numViajeroFrecuente;
    private $cantidadMillas;

    public function __construct($vNombre, $vNumeroAsiento, $vNumeroTicket, $numViajero, $cantMillas){
        parent::__construct($vNombre, $vNumeroAsiento, $numViajero);
        $this->numViajeroFrecuente = $numViajero;
        $this->cantidadMillas = $cantMillas;
    }

    public function getNumViajero(){
        return $this->numViajeroFrecuente;
    }

    public function getCantMillas(){
        return $this->cantidadMillas;
    }

    public function setNumViajero($numViaje){
        $this->numViajeroFrecuente = $numViaje;
    }

    public function setCantMillas($cantidadMillas){
        $this->cantidadMillas = $cantidadMillas;
    }

    public function darPorcentajeIncremento(){
        $incremento = 0;
        $cantMillas = $this->getCantMillas();
        if ($cantMillas > 300){
            $incremento = 30;
        }else{
            $incremento = 35;
        }
        return $incremento;
    }

    public function __toString(){
        $cartel2 = parent::__toString();
        $cartel2 .= "Número de pasajero frecuente: ".$this->getNumViajero()."\n";
        $cartel2 .= "Cantidad de millas: ".$this->getCantMillas()."\n";
         return $cartel2;
    }
}