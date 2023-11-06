<?php
    class Permisos extends Controladores {

        public function __construct(){
            // verifica si se inicio sesion
            session_start();
            if(empty($_SESSION['login'])){  
                header('Location: '.base_url().'/Login');
            }
            parent::__construct();
        }

        public function getPermisosRol($parametro){
            $rolid = intval($parametro[0]);
            if($rolid > 0 ){
                $arrModulos = $this->modelo->selecModulos();
                $arrPermisosRol = $this->modelo->selecPermisosRol($rolid);
                // depurar($arrPermisosRol);
                $arrPermisos = array('r'=>0,'w'=>0,'u'=>0,'d'=>0);
                $arrPermisoRol = array('idrol'=>$rolid);
                if(empty($arrPermisosRol)){
                    for($i=0;$i<count($arrModulos);$i++){
                        $arrModulos[$i]['permisos']=$arrPermisos;
                    }
                }else{
                    for($i=0;$i<count($arrModulos);$i++){
                        $arrPermisos = array('r'=>0,'w'=>0,'u'=>0,'d'=>0);
                        if(isset($arrPermisosRol[$i])){
                        $arrPermisos = array('r'=>$arrPermisosRol[$i]['Leer'], 
                                             'w'=>$arrPermisosRol[$i]['Escribir'],
                                             'u'=>$arrPermisosRol[$i]['Actualizar'],
                                             'd'=>$arrPermisosRol[$i]['Eliminar']
                                            );
                        }
                        $arrModulos[$i]['permisos']=$arrPermisos;
                        
                    }
                }
                $arrPermisoRol['modulos'] = $arrModulos;
                $html = getModal("modalPermisos",$arrPermisoRol);
                // depurar($arrPermisoRol);                
            }
            die();
        } 
        
        public function setPermisos(){
            if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->modelo->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['IDmodulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->modelo->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
        }
    }

?>
