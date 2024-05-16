<?php
class Pasajero{
    private $nombre;
    private $numeroAsiento;
    private $numeroTicket;

    public function __construct($nom, $numAsiento, $numTicket){
        $this->nombre = $nom;
        $this->numeroAsiento = $numAsiento;
        $this->numeroTicket = $numTicket;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getNumAsiento(){
        return $this->numeroAsiento;
    }

    public function getNumTicket(){
        return $this->numeroTicket;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setNumAsiento($numAsiento){
        $this->numeroAsiento = $numAsiento;
    }

    public function setNumTicket($numTicket){
        return $this->numeroTicket = $numTicket;
    }

    public function darPorcentajeIncremento(){
        $incremento = 10;
        return $incremento;
    }

    public function __toString(){
        $cartel1 = "---------------------------------------------\n";
        $cartel1 .= "Nombre: ".$this->getNombre()."\n";
        $cartel1 .= "Número de asiento: ".$this->getNumAsiento()."\n";
        $cartel1 .= "Número de ticket: ".$this->getNumTicket()."\n";
        return $cartel1;
    }
}