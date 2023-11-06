<?php
    class Servicio extends Controladores {

        public function __construct(){
            // verifica si se inicio sesion
            session_start();
            if(empty($_SESSION['login'])){  
                header('Location: '.base_url().'/Login');
            }
            parent::__construct();

        }
        
        public function servicio(){
            $data["pagina_id"]=5;
            $data["pagina_Tag"]="Tienda virtual";
            $data["pagina_titulo"]="Configurar Servicios  ";
            $data["pagina_nombre"]="Servicio";
            $data["pagina_funciones_js"]="funcionServicio.js";
            $this->views->obtenerVista($this,"Servicio",$data);
        }
        // se obtiene ID y nombre de SERVICIO para mostrar en select 
        public function getSelectServicios(){
			$htmlOptions = "";
			$arrData = $this->modelo->selectServicios();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					$htmlOptions .= '<option value="'.$arrData[$i]['IDservicio'].'">'.$arrData[$i]['NombreDeServicio'].'</option>';
					
				}
			}
			echo $htmlOptions;
			die();		
		}

        // obtiene todos los roles de base de datos
        public function ObtenerServicios(){
            $arrData = $this->modelo->selectServicios();
            for($i=0;$i<count($arrData);$i++){
                    $arrData[$i]["Opciones"] = '<div class="text-center">
                    <button class="btn btn-info btn-sm btnVerServicio" onClick="fntViewServicio('.$arrData[$i]['IDservicio'].')" type="button"><i class="far fa-eye"></i></button>
                    <button class="btn btn-success btn-sm btnEditServicio" onClick="ftnEditServicio('.$arrData[$i]['IDservicio'].')" type="button"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-danger btn-sm btnDelServicio" onClick="fntDelServicio('.$arrData[$i]['IDservicio'].')" type="button"><i class="fa-solid fa-trash-can"></i></button>
                    </div>';
                }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        // guarda servicios en BBDD
        public function setServicios(){
            $cantidad = intval($_POST['cantServicios']);
            $this->modelo->deleteAllServicios();          
            $resp = $this->modelo->insertServicio($cantidad);
            $arrRosponse = array('status' => true,'msg' => 'Datos guardados correctamente.');
            echo json_encode($arrRosponse,JSON_UNESCAPED_UNICODE);
        }

        // obtiene datos de una Servicio de la BBDD
        public function getServicio($id){
            $intIDServicio = intval($id[0]);
            if($intIDServicio>0){
                $arrData = $this->modelo->selectServicio($intIDServicio);
                if(empty($arrData)){
                    $arrResponse= array("status"=>false, "msg"=>"Datos no encontrados");
                }else{
                    $arrResponse= array("status"=>true, "msg"=>$arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            } 
            die();
        } 


        public function setServicio(){
            $idServicio = intval($_POST['idServicioEdit']);
            $strServicio = limpiaCadena($_POST['txtNombreEdit']);
            $strDescripcion = limpiaCadena($_POST['txtDescripcionEdit']);
            $respServicio = $this->modelo->updateServicio($idServicio,$strServicio,$strDescripcion);            
            if($respServicio > 0 ){
                $arrRosponse = array('status' => true,'msg' => 'Datos actualizados correctamente.');
            }else{
                $arrRosponse = array('status' => false,'msg' => 'No es posible almacenar los datos');
            }
            echo json_encode($arrRosponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Elimina servicio de base de datos 
        public function delServicio(){
            if($_POST){
                $idPersonal = intval($_POST["idServicio"]);
                $requestDelete =$this->modelo->deleteServicio($idPersonal);
                if($requestDelete){
                    $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado Servicio");
                }else{
                    $arrResponse = array("status"=>false,"msg"=>"Error al eliminar servicio");
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }

?>
