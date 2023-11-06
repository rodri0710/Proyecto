<?php
    class SesionModelo extends Mysql{
        public function __construct(){
            parent::__construct();
            // echo "Mensaje desde el modelo Sesion<br>";
        }

        public function select($email, $password){
            $sql = "SELECT * FROM personal WHERE Email = ?";
            $arrValores = array($email);
            $dato = $this->seleccionar($sql,$arrValores);
            // depurar($dato);
            if(empty($dato['Email'])){
                return false;
            }
            if(empty($dato['contrasena'])){
                return false;
            }
            if(!password_verify($password,$dato['contrasena'])){
                return false;
            }else   return $dato;
        }
        
    }