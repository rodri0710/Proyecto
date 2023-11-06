<?php
    class VerificarDatos {
                
        function __construct(){
            
        }

        

        public function VerificarEnBDCama($ID, $resultadosC){

            foreach ($resultadosC as $resultadoC){
                if(intval($resultadoC['IDcama']) == intval($ID)){
                    return true;
                    break;
                }
            }
            return false;
        }
        public function VerificarEnBDSanitario($ID, $resultadosS){

            foreach ($resultadosS as $resultadoS){
                if(intval($resultadoS['IDsanitario']) == intval($ID)){
                    return true;
                    break;
                }
            }
            return false;
        }

        
    }

?>