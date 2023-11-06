<?php
    class Codigo extends Controladores {

        public function __construct(){
            parent::__construct();
        }

        public function cama($parametro){

            if(!empty($_POST["servicio"]) && !empty($_POST["sala"])){
                $resps = $this->modelo->getCodigo($parametro);
                foreach($resps as $resp){
                    echo $resp.",";
                }
             
            }else{
                echo  mensajeFallido(" ERROR: verificar datos introducidos");
            }
        } 
        
        public function getIDalarmaCama($parametro){
            $resps = $this->modelo->getIDcama($parametro);
            echo $resps[0]["IDalarma"];
        }
    }

?>
