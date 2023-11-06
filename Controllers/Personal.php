<?php
    class Personal extends Controladores {

        public function __construct(){
            parent::__construct();
        }

        public function contactosTurno($parametro){
                if(isset($parametro["IDprofesion"]) && isset($parametro["servicio"])){
                    $resp = $this->modelo->obtenerContactos($parametro);
                    // depurar($resp);
                    if(!$resp){
                        echo mensajeFallido("No hay personal asignado a este horario");
                        exit(); 
                    }
                    echo mensajeExito("Se hallaron datos",$resp);
                    
                }else
                echo mensajeFallido("verifique los datos enviados");   
        }    
    }

?>
