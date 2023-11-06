<?php
    class HomeModelo extends Mysql{
        public function __construct(){
            parent::__construct();
            //  echo "Mensaje desde el modelo Home<br>";
        }

        public function getCarrito($parametros){
            // print_r($parametros) ;
            return $parametros;
            
        }

        public function select($parametro){
            echo $parametro[0];
            $sql="SELECT * FROM personal WHERE IDpersonalDS = $parametro[0]";
            $dato = $this->seleccionarVarios($sql);
            echo "*2";
            return $dato;

        }
        
    }
?>