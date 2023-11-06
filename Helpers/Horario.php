<?php

    class Horario{
        function __construct(){
        }

        public function encontrarHorario($horarios, $horaActual){
            foreach($horarios as $horario){
                
                if(intval($horario['horaFinal']) - intval($horario['horaInicial']) >= 0){ // si horario es en el dia (horario no pasa por media noche)
                    if($horario['horaInicial'] <= $horaActual && $horaActual< $horario['horaFinal']){ // verifica a que horario pertenece la hora actual (alarma de cama)
                    // print_r($horario);
                        break;
                    }
                }
                else{  
                    // print_r($horario);
                    // si media noche corresponde a horario
                    break;
                } 
            }
            
            // print_r($horario);
            return $horario;
        }
        
        //Encuentra la fecha de hoy en el horario establecido (encuentra IDfechaContrato)
        public function encontrarIdFecha($resFecha,$fechaHoy){
            foreach($resFecha as $resultado){
                // print_r($resultado);
                $fechaInicioSeg = $resultado["FechaInicio"];
                $IDfechaTrabajo = $resultado["IDfechaTrabajo"];
                $fechaLimite = $resultado["fechaFin"];
                for($i=$fechaInicioSeg;$i<=$fechaLimite;$i=$i+$resultado["FrecuenciaDeDias"]*86400){
                    //  echo "dia de iniciao en seg:".$resultado["FechaInicio"]."</br>".$i."\n";
                    // echo $i."--".$fechaHoy."\n";
                    if($i==$fechaHoy){                             //si el contador $i es igual a marca de tiempo de HOY en seg 
                        // echo "Registro de Fecha encontrada: ".$resultado["IDfechaTrabajo"]." ".$resultado["FechaInicio"]." ".$resultado["FrecuenciaDeDias"]."\n"; 
                        return $resultado;
                    }
                }
                
            }
        }
    }

?>