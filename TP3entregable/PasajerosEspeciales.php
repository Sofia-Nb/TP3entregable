<?php
include_once 'Pasajero.php';
class PasajerosEspeciales extends Pasajero{
    private $coleccionServicios;

    public function __construct($vNombre, $vNumAsiento, $vNumTicket, $colServicios){
        parent::__construct($vNombre, $vNumAsiento, $vNumTicket);
        $this->coleccionServicios = [];
    }

    public function getColServicios(){
        return $this->coleccionServicios;
    }

    public function setColServicios($colServicios){
        $this->coleccionServicios = $colServicios;
    }

    public function __toString(){
        $coleccion = $this->getColServicios();
        $cartel3 = parent::__toString();
        $cartel3 .= "Servicios: \n";
        $cartel3 .= $this->mostrarColeccion($coleccion);
        $cartel3 .= "---------------------------------------------\n";
        return $cartel3;
    }

    public function darPorcentajeIncremento(){
        $incremento = 0;
        $colServicios = $this->getColServicios();
        $count = count($colServicios);
        if ($count == 3){
            $incremento = 30;
        }else{
            $incremento = 15;
        }
        return $incremento;
    }

    public function mostrarColeccion($coleccion){
        $rta = "\n";
        foreach ($coleccion as $indice){
            if ($indice == "Silla de ruedas"){
            $rta .= "Silla de ruedas. \n"; 
            }elseif($indice == "Asistencia"){
                $rta .= "Asistencia. \n"; 
            }elseif($indice == "Comida Especial"){
                $rta .= "Comida Especial. \n";
            }
        }
        return $rta;
    }
}