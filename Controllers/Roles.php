<?php
    class Roles extends Controladores {

        public function __construct(){
            // verifica si se inicio sesion
            session_start();
            if(empty($_SESSION['login'])){  
                header('Location: '.base_url().'/Login');
            }
            parent::__construct();
        }
        
        public function Roles(){
            $data["pagina_id"]=3;
            $data["pagina_titulo"]="Roles personal";
            $data["pagina_nombre"]="Roles personal";
            $data["pagina_funciones_js"]="funcionRoles.js";
            $this->views->obtenerVista($this,"Roles",$data);
        } 

        // obtiene todos los roles de base de datos
        public function ObtenerRoles(){
            $arrData = $this->modelo->selectRoles();
            for($i=0;$i<count($arrData);$i++){
                    $arrData[$i]["Opciones"] = '<div class="row justify-content-center">
                    <button class="btn btn-info btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['IDrol'].')" type="button"><i class="fa-sharp fa-solid fa-key"></i></button>
                    <button class="btn btn-success btn-sm btnEditRol" onClick="ftnEditRol('.$arrData[$i]['IDrol'].')" type="button"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['IDrol'].')" type="button"><i class="fa-solid fa-trash-can"></i></button>
                    </div>';
                }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function getRol($idRol){ 
                $intIdrol = intval(limpiaCadena($idRol[0]));
                if($intIdrol>0){
                    $arrData = $this->modelo->selectRol($intIdrol);
                    if(empty($arrData)){
                        $arrResponse = array('status' => false,'msg' =>'Datos no encontrados');
                    }else{
                        $arrResponse = array('status' => true,'data' =>$arrData);
                    }
                    // depurar($arrResponse);
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            
        }

        public function getSelectRoles(){
			$htmlOptions = "";
			$arrData = $this->modelo->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					$htmlOptions .= '<option value="'.$arrData[$i]['IDrol'].'">'.$arrData[$i]['NombreRol'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();		
		}

        public function setRol(){
            $intIdrol = intval($_POST['idRol']);
            $strRol = limpiaCadena($_POST['txtNombre']);
            $strDescripcion = limpiaCadena($_POST['txtDescripcion']);
            // verifica si creara nuevo rol o actualizara rol
            if($intIdrol == 0){
                $respRol = $this->modelo->insertRol($strRol,$strDescripcion);
                $option =1;
            }else{
                $respRol = $this->modelo->updateRol($intIdrol,$strRol,$strDescripcion);
                $option =2;
            }
            
            if($respRol > 0 ){
                if($option ==1){
                    $arrRosponse = array('status' => true,'msg' => 'Datos guardados correctamente.');
                }else{
                    $arrRosponse = array('status' => true,'msg' => 'Datos actualizados correctamente.');
                }
            }else if($respRol == 'existe'){
                $arrRosponse = array('status' => false,'msg' => 'El rol ya existe');
            }else{
                $arrRosponse = array('status' => false,'msg' => 'No es posible almacenar los datos');
            }
            echo json_encode($arrRosponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delRol(){
            if($_POST){
                $intIdrol = intval($_POST['idrol']);
                $requestDelete = $this->modelo->deleteRol($intIdrol);
                if($requestDelete == "ok"){
                    $arrResponse = array('status'=>true,'msg'=>'Se elimino el rol');
                }else if($requestDelete == 'existe'){
                    $arrResponse = array('status'=>false,'msg'=>'No es posible eliminar un Rol asociado a personal');
                }else{
                    $arrResponse = array('status'=>false,'msg'=>'Error al eliminar el rol');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

            
    }


?>
