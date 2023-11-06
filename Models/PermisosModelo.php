<?php
    class PermisosModelo extends Mysql{
        public function __construct(){
            parent::__construct();
           
        }

        public function selecModulos(){
            $sql = "SELECT * FROM modulo";
            $request = $this->seleccionarVarios($sql);
            return $request;
            
        }

        public function selecPermisosRol($idrol){
            $sql = "SELECT * FROM permisos WHERE IDrol = $idrol";
            $request = $this->seleccionarVarios($sql);
            return $request;

        }

        public function deletePermisos($idrol){
			$sql = "DELETE FROM permisos WHERE IDrol = $idrol";
			$request = $this->eliminar($sql);
			return $request;
		}

        public function insertPermisos($idrol,$idmodulo,$r,$w,$u,$d){
			$query_insert  = "INSERT INTO permisos(IDrol,IDmodulo,Leer,Escribir,Actualizar,Eliminar) VALUES(?,?,?,?,?,?)";
        	$arrData = array($idrol, $idmodulo, $r, $w, $u, $d);
        	$request_insert = $this->insertar($query_insert,$arrData);		
	        return $request_insert;
		}

		public function permisosModulo(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT p.rolid,
						   p.moduloid,
						   m.titulo as modulo,
						   p.r,
						   p.w,
						   p.u,
						   p.d 
					FROM permisos p 
					INNER JOIN modulo m
					ON p.moduloid = m.idmodulo
					WHERE p.rolid = $this->intRolid";
			$request = $this->seleccionarVarios($sql);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++) { 
				$arrPermisos[$request[$i]['moduloid']] = $request[$i];
			}
			return $arrPermisos;
		}

		public function getRol(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT * FROM rol WHERE idrol = $this->intRolid";
			$request = $this->seleccionar($sql);
			return $request;
		}
        
    }
?>