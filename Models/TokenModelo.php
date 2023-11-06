<?php
    
    class TokenModelo extends Mysql{
        public function __construct(){
            parent::__construct();
            //  echo "Mensaje desde el modelo Token<br>";
        }

        public function actualizarToken($parametro){
            $sql = "UPDATE personal SET token = ? WHERE IDpersonalDS = ?";
            $arrValores = array($parametro["token"], intval($parametro["IDpersonal"]));
            $dato = $this->actualizar($sql,$arrValores);
            // depurar($dato);
            return $dato;

        }
        
    }
    
?>