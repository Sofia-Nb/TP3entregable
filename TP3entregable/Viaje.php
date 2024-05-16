<?php
include 'ResponsableV.php';
include_once 'PasajeroVip.php';
include_once 'PasajerosEspeciales.php';

/**
 * La clase Viaje debe hacer referencia al responsable 
 * de realizar el viaje.
 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los 
 * atributos nombre, apellido, numero de documento y teléfono.
 */

 class Viaje{
    private $codigo;
    private $destino;
    private $coleccionPasajeros;
    private $costo;
    private $sumCostoAbonado;
    private $cantMaxPasajeros;
    private ResponsableV $objResponsableV;

    public function __construct($cod, $dest,$colPas , $sumCostos, $costo, $cantMaxPas, ResponsableV $objResponsableV){
        $this->codigo = $cod;
        $this->destino = $dest;
        $this->coleccionPasajeros = $colPas;
        $this->costo = $costo;
        $this->sumCostoAbonado = $sumCostos;
        $this->cantMaxPasajeros = $cantMaxPas;
        $this->objResponsableV =  $objResponsableV;
    }

    
    public function getCodigo(){
        return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }

    public function getColPasajeros(){
        return $this->coleccionPasajeros;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function getSumaCostos(){
        return $this->sumCostoAbonado;
    }

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function getObjResponsable(){
        return $this->objResponsableV;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function setColPasajeros($coleccionPasajeros){
        $this->coleccionPasajeros = $coleccionPasajeros;
    }

    public function setCosto($costo){
        $this->costo = $costo;
    }

    public function setSumaCostos($sumaCostos){
        $this->sumCostoAbonado = $sumaCostos;
    }

    public function setCantMaxPasajeros($cantidad){
        $this->cantMaxPasajeros = $cantidad;
    }

    public function setObjResponsable($objResponsable){
        return $this->objResponsableV = $objResponsable;
    }

    public function hayPasajesDisponibles(){
        $disponible = false;
        $colPasajeros = $this->getColPasajeros();
        $cantPasajeros = count($colPasajeros);
        $cantMaxima = $this->getCantMaxPasajeros();
        if ($cantPasajeros < $cantMaxima){
            $disponible = true;
        }

        return $disponible;
    }

    public function venderPasaje($objPasajero){
        $disponible = $this->hayPasajesDisponibles();
        $coleccionPasajeros = $this->getColPasajeros();
        $sumCostos = $this->getSumaCostos();
        if($disponible){
            array_push($coleccionPasajeros, $objPasajero);
            $this->setColPasajeros($coleccionPasajeros);
            if ($objPasajero->getColServicios() != null){
                $porcentajeIn = $objPasajero->darPorcentajeIncremento();
                $costoTotal = $this->sacarPrecioFinal($porcentajeIn);
                $sumCostos = $sumCostos + $costoTotal;
                $this->setSumaCostos($sumCostos);
            }
            elseif ($objPasajero->getNumViajero() != null){
                $porcentajeIn = $objPasajero->darPorcentajeIncremento();
                $costoTotal = $this->sacarPrecioFinal($porcentajeIn);
                $sumCostos = $sumCostos + $costoTotal;
                $this->setSumaCostos($sumCostos);
            }else{
                $porcentajeIn = $objPasajero->darPorcentajeIncremento();
                $costoTotal = $this->sacarPrecioFinal($porcentajeIn);
                $sumCostos = $sumCostos + $costoTotal;
                $this->setSumaCostos($sumCostos);
            }
        }else{
            $costoTotal = null;
        }
        return $costoTotal;
    }

    public function sacarPrecioFinal($porcentaje){
        $costoViaje = $this->getCosto();
        $precioIncremento = ($costoViaje * $porcentaje)/100;
        $costoFinal = $costoViaje + $precioIncremento;
        return $costoFinal;
    } 

    public function mostrarColeccion($coleccion){
        $rta = "\n";
        foreach ($coleccion as $indice){
            $rta .= $indice."\n"; 
        }
        return $rta;
    }

    public function __toString(){
        $coleccionPasajeros = $this->getColPasajeros();
        $respuesta = "Código del viaje: ".$this->getCodigo()."\n";
        $respuesta .= "Destino: ".$this->getDestino()."\n";
        $respuesta .= "Pasajeros del viaje: ".$this->mostrarColeccion($coleccionPasajeros)."\n";
        $respuesta .= "Costo del viaje: ".$this->getCosto()."\n";
        $respuesta .= "Costo total de todos los pasajeros: ".$this->getSumaCostos()."\n";
        $respuesta .= "Cantidad máxima de pasajeros: ".$this->getCantMaxPasajeros()."\n";
        $respuesta .= "---------------------------------------------\n";
        $respuesta .= "Datos del responsable del viaje: \n";
        $respuesta .= $this->getObjResponsable();
        $respuesta .= "---------------------------------------------\n";
        return $respuesta;
    }
 }