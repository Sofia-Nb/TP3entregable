<?php
include_once 'Viaje.php';
include_once 'ResponsableV.php';
include_once 'PasajerosEspeciales.php';
include_once 'PasajeroVip.php';

/**
 * Implementar un script testViaje.php que cree una 
 * instancia de la clase Viaje y presente un menú 
 * que permita cargar la información del viaje, 
 * modificar y ver sus datos.
 */

$objResponsable = new ResponsableV (00000,000000, "Nombre", "Apellido");
$objViaje = new Viaje (00000, "Destino",[], 0000, 00000, 00000, $objResponsable);


 do{
    $opcion = cartel1();
    switch($opcion){

        case 1: 
            primerCaso($objViaje, $objResponsable);
            break;

        case 2:
            $op = cartel2();
            switch($op){

                case 1:
                    echo "Ingrese el nuevo código de viaje: \n";
                    $cod = trim(fgets(STDIN));
                    $objViaje->setCodigo($cod);
                    echo "-------------------------------------------------------------\n";
                    echo "Código cambiado con éxito!!\n";
                    echo "Su nuevo código es: ".$cod."\n";
                    echo "-------------------------------------------------------------\n";
                    break;

                case 2:
                    echo "Ingrese su nuevo destino: \n";
                    $dest = trim(fgets(STDIN));
                    $objViaje->setDestino($dest);
                    echo "-------------------------------------------------------------\n";
                    echo "Destino cambiado con éxito!!\n";
                    echo "Su nuevo destino es: ".$dest."\n";
                    echo "-------------------------------------------------------------\n";
                    break;

                case 3:
                    $pasajeros = $objViaje->getColPasajeros();
                    $count = count($pasajeros);
                    $indice = 0;
                    do{
                    echo "-------------------------------------------------------------\n";
                    echo "Ingrese la cantidad máxima de pasajeros: \n";
                    $cant = trim(fgets(STDIN));
                    if ($cant < $count){
                        echo "ATENCIÓN!! La nueva cantidad es menor a los pasajeros registrados.\n";
                        echo "¿Desea cambiar la cantidad de nuevo? (si/no) \n";
                        $respuesta = trim(fgets(STDIN));
                        $respuesta = strtolower($respuesta);
                        if ($respuesta == "no"){
                        echo "NO SE CAMBIARON DATOS.\n";
                        }
                    }else{
                        $respuesta = "";
                        $objViaje->setCantMaxPasajeros($cant);
                    }
                    echo "-------------------------------------------------------------\n";
                    }while($respuesta == "si");
                    break;

                case 4:
                    $pasajeros = $objViaje->getColPasajeros();
                    $count = count($pasajeros);
                    $count1 = count($pasajeros);
                    $cantMax = $objViaje->getCantMaxPasajeros();
                    echo "-------------------------------------------------------------\n";
                    echo "Ingrese la nueva cantidad de pasajeros: \n";
                    $nuvCant = trim(fgets(STDIN));
                    if ($nuvCant > $cantMax){
                        echo "ATENCIÓN!! La nueva cantidad de pasajeros sobrepasa la cantidad máxima permitida.\n";
                        echo "NO SE CAMBIARON DATOS.\n";
                        }
                    if($cantMax > $nuvCant){
                            $num = $nuvCant - $count;
                            echo "Debe registrar a los pasajeros faltantes: \n";
                            $i = 0;
                            while ($i < $num){
                                echo "Ingrese el nombre del Pasajero ".($count1+1).": \n";
                                $nombre = trim(fgets(STDIN));
                                do{
                                echo "Ingrese el número de asiento del Pasajero ".($count1+1).": \n";
                                $numPasaj = trim(fgets(STDIN));
                                $val = buscarAsiento($objViaje, $numPasaj);
                                if ($val == true){
                                    echo "Error! Asiento ocupado. Ingrese otro número de asiento. \n";
                                }
                                }while($val == true);
                                do{
                                echo "Ingrese el número de ticket del Pasajero ".($count1+1).": \n";
                                $numTick = trim(fgets(STDIN));
                                $val2 = buscarAsiento($objViaje, $numPasajero);
                                if ($val2 == true){
                                    echo "Error! , este número ya está en uso. Ingrese otro número de ticket. \n";
                                }
                                }while($val2 == true);
                                $coleccionServicios = [];
                                echo "¿Necesita servicios? (si/no) \n";
                                $res = trim(fgets(STDIN));
                                $res = strtolower($res);
                                if (($res == "si")){
                                    do{
                                    echo "1) Requiere Silla de ruedas \n";
                                    echo "2) Requiere Asistencia \n";
                                    echo "3) Requiere Comida Especial \n";
                                    $num = trim(fgets(STDIN));
                                    if ($num == 1){
                                        array_push($coleccionServicios, "Silla de ruedas");
                                    }elseif($num == 2){
                                        array_push($coleccionServicios, "Asistencia");
                                    }elseif($num == 3){
                                        array_push($coleccionServicios, "Comida Especial");
                                    }
                                    echo "¿Desea agregar otro servicio? (si/no)";
                                    $respuesta = trim(fgets(STDIN));
                                    $respuesta = strtolower($respuesta);
                                    }while($respuesta == "si");
                                    $objPasajeroEspecial = new PasajerosEspeciales($nombre, $numPasaj, $numTick, $coleccionServicios);
                                    array_push($pasajeros, $objPasajeroEspecial);
                                    $objViaje->setColPasajeros($pasajeros);
                                }
                                echo "¿Es VIP? (si/no) \n";
                                $res2 = trim(fgets(STDIN));
                                $res2 = strtolower($res2);
                                if (($res2 == "si")){
                                    echo "Ingrese Número de viajero frecuente: \n";
                                    $numViajFrecuente = trim(fgets(STDIN));
                                    echo "Ingrese la cantidad de millas: \n";
                                    $cantMillas = trim(fgets(STDIN));
                                    $objPasajeroVip = new PasajeroVip($nombre, $numPasaj, $numTicket, $numViajFrecuente, $cantMillas);
                                    array_push($pasajeros, $objPasajeroVip);
                                    $objViaje->setColPasajeros($pasajeros);
                                }
                            
                            }
                    }
                    echo "-------------------------------------------------------------\n";
                    break;
                    case 5:
                        echo responsable($objResponsable);
                        break;
            }
            break;

        case 3:
            if ($objViaje->getCantMaxPasajeros() == 000){
            echo "\n";
            echo "NO HAY DATOS.\n";
            echo "\n";
            echo "-------------------------------------------------------------\n";
            }else{
                echo $objViaje;
            }
            break;

        default:
        if (($opcion > 4) || ($opcion <= 0)){
        echo "Opción inválida, intentelo de nuevo.\n";
        }
        break;
    }
 }while($opcion != 4);
 if ($opcion == 4){
    echo "Hasta el próximo viaje!!\n";
 }



 function cartel1(){
    echo "\n";
    echo "MENÚ: \n";
    echo "1. Cargar información del viaje. \n";
    echo "2. Modificar Datos. \n"; 
    echo "3. Mostrar datos. \n";
    echo "4. Salir. \n";
    echo "-------------------------------------------------------------\n";
    echo "Escriba su opción: \n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
 }

 function cartel2(){
    echo "-------------------------------------------------------------\n";
    echo "1. Código de viaje.\n";
    echo "2. Destino.\n";
    echo "3. Cantidad máxima de pasajeros.\n";
    echo "4. Pasajeros del viaje. \n";
    echo "5. Responsable. \n";
    echo "-------------------------------------------------------------\n";
    echo "\n";
    echo "¿Que datos desea modificar?: \n";
    $dato = trim(fgets(STDIN));
    return $dato;
 }

 function primerCaso(Viaje $objViaje, ResponsableV $objResponsable){
            $datosPas = $objViaje->getColPasajeros();

            echo responsable($objResponsable);

            echo "-------------------------------------------------------------\n";
            echo "Ingrese el código de viaje: \n";
            $codigo = trim(fgets(STDIN));
            $objViaje->setCodigo($codigo);

            echo "Ingrese su destino: \n";
            $destino = trim(fgets(STDIN));
            $objViaje->setDestino($destino);

            echo "Ingrese la cantidad máxima de pasajeros: \n";
            $cantidad = trim(fgets(STDIN));
            $objViaje->setCantMaxPasajeros($cantidad);

            do{
            echo "Ingrese los pasajeros del viaje: \n";
            $pasajeros = trim(fgets(STDIN));
            if ($pasajeros > $cantidad){
                echo "Error, excede la cantidad máxima de Pasajeros.\n";
                echo "Intentelo de nuevo. \n";
            }else{
                $colPasajeros = [];
                echo "-------------------------------------------------------------\n";
            for ($i=0; $i < $pasajeros; $i++){
                echo "Ingrese el nombre del Pasajero ".($i+1).": \n";
                $nombre = trim(fgets(STDIN));
                do{
                echo "Ingrese el número de asiento del Pasajero ".($i+1).": \n";
                $numPasajero = trim(fgets(STDIN));
                $valor = buscarAsiento($objViaje, $numPasajero);
                if ($valor == true){
                    echo "Error! Asiento ocupado. Ingrese otro número de asiento. \n";
                }
                }while($valor == true);
                do{
                echo "Ingrese el número de ticket del Pasajero ".($i+1).": \n";
                $numTicket = trim(fgets(STDIN));
                $valor2 = buscarAsiento($objViaje, $numPasajero);
                if ($valor2 == true){
                    echo "Error! , este número ya está en uso. Ingrese otro número de ticket. \n";
                }
                }while($valor2 == true);
                $colServicios = [];
                                echo "¿Necesita servicios? (si/no) \n";
                                $res = trim(fgets(STDIN));
                                $res = strtolower($res);
                                if (($res == "si")){
                                    do{
                                    echo "1) Requiere Silla de ruedas \n";
                                    echo "2) Requiere Asistencia \n";
                                    echo "3) Requiere Comida Especial \n";
                                    $num = trim(fgets(STDIN));
                                    if ($num == 1){
                                        array_push($colServicios, "Silla de ruedas");
                                    }elseif($num == 2){
                                        array_push($colServicios, "Asistencia");
                                    }elseif($num == 3){
                                        array_push($colServicios, "Comida Especial");
                                    }
                                    echo "¿Desea agregar otro servicio? (si/no)";
                                    $respuesta = trim(fgets(STDIN));
                                    $respuesta = strtolower($respuesta);
                                    }while($respuesta == "si");

                                    $objPasajeroEspecial = new PasajerosEspeciales($nombre, $numPasajero, $numTicket, $colServicios);
                                    array_push($datosPas, $objPasajeroEspecial);
                                    $objViaje->setColPasajeros($datosPas);
                                }
                                echo "¿Es VIP? (si/no) \n";
                                $res2 = trim(fgets(STDIN));
                                $res2 = strtolower($res);
                                if (($res2 == "si")){
                                    echo "Ingrese Número de viajero frecuente: \n";
                                    $numViajFrecuente = trim(fgets(STDIN));
                                    echo "Ingrese la cantidad de millas: \n";
                                    $cantMillas = trim(fgets(STDIN));
                                    $objPasajeroVip = new PasajeroVip($nombre, $numPasajero, $numTicket, $numViajFrecuente, $cantMillas);
                                    array_push($datosPas, $objPasajeroVip);
                                    $objViaje->setColPasajeros($datosPas);
                                }
                                echo "-------------------------------------------------------------\n";
                echo "\n";
            }
            echo "Datos cargados!!\n";
            }
            }while($pasajeros > $cantidad);
 }

 function buscarAsiento(Viaje $objViaje, $numero){
    $coleccionPasajeros = $objViaje->getColPasajeros();
    $encontrado = false;
    foreach ($coleccionPasajeros as $objPasajero){
        $asiento = $objPasajero->getNumAsiento();
        if ($asiento == $numero){
            $encontrado = true;
        }
    }
    return $encontrado;
 }

 function buscarTicket(Viaje $objViaje, $numero){
    $coleccionPasajeros = $objViaje->getColPasajeros();
    $encontrado = false;
    foreach ($coleccionPasajeros as $objPasajero){
        $ticket = $objPasajero->getNumTicket();
        if ($ticket == $numero){
            $encontrado = true;
        }
    }
    return $encontrado;
 }

 
 function responsable (ResponsableV $objResponsable){
echo "-------------------------------------------------------------\n";
    echo "Ingrese el número de empleado: \n";
    $num = trim(fgets(STDIN));
    echo "Ingrese número de licencia: \n";
    $lic = trim(fgets(STDIN));
    echo "Nombre del responsable: \n";
    $nom = trim(fgets(STDIN));
    echo "Apellido del responsable: \n";
    $apell = trim(fgets(STDIN));
    echo "-------------------------------------------------------------\n";
    $objResponsable->setNumEmpleado($num);
    $objResponsable->setNumLicencia($lic);
    $objResponsable->setNombre($nom);
    $objResponsable->setApellido($apell);
 }