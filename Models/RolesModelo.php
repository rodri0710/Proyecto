<?php
    class RolesModelo extends Mysql{
        public function __construct(){
            parent::__construct();
            //  echo "Mensaje desde el modelo Roles<br>";
        }

            // obtines roles de base de datos
            public function selectRoles(){
                // print_r($parametros) ;
                $sql = "SELECT * FROM rol";
                $resp = $this->seleccionarVarios($sql);
                return $resp;
                
            }

        public function selectRol($idrol) {
            $sql = "SELECT * FROM rol WHERE IDrol = $idrol";
            $request = $this-> seleccionar($sql);
            return $request;
        }

        // inserta roles en base de datos para
        public function insertRol($strRol,$strDescripcion){
            $return = "";
            $sql = "SELECT * FROM rol WHERE NombreRol = '{$strRol}'";
            $resp = $this->seleccionarVarios($sql);
            if(empty($resp)){
                $query_insert = "INSERT INTO `rol`(`NombreRol`, `Descripcion`) VALUES (?,?)";
                $arrVal = array($strRol,$strDescripcion);
                $resp_insert = $this->insertar($query_insert,$arrVal);
                $return = $resp_insert; 
            }else{
                $return = "existe";
            }
            return $return;
        }

        public function updateRol($idrol,$rol,$Descripcion){
            // echo $idrol." " .$rol." " .$Descripcion;
            $sql = "SELECT * FROM rol WHERE NombreRol = '{$rol}' AND IDrol != '{$idrol}'";
            $request = $this->seleccionarVarios($sql);
            if(empty($request)){
                
                $sql = "UPDATE rol SET NombreRol=?,Descripcion=? WHERE IDrol = '{$idrol}'";

                $arrData = array($rol,$Descripcion);
                $request = $this->actualizar($sql,$arrData);
            }else{
                $request = "existe";
            }
            return $request;
        }

        public function deleteRol($idrol){
            $sql = "SELECT * FROM personal WHERE IDrol = $idrol";
            $request = $this->seleccionarVarios($sql);
            if(empty($request)){
                $sql = "DELETE FROM rol WHERE IDrol = $idrol";
                $request = $this->eliminar($sql);
                if($request){
                    $request ='ok';
                }else{
                    $request = 'error';
                }
            }else{
                $request = 'existe';
            }
            return $request;
        }
        
    }
?>