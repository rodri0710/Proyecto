<?php
    class Usuarios extends Controladores {

        public function __construct(){
            parent::__construct();
            // verifica si se inicio sesion
            session_start();
            if(empty($_SESSION['login'])){  
                header('Location: '.base_url().'/Login');
            }
        }
        
        public function usuarios(){
            $data["pagina_id"]=4;
            $data["pagina_Tag"]="Usuario";
            $data["pagina_titulo"]="Usuarios";
            $data["pagina_nombre"]="Usuarios";
            $data["pagina_funciones_js"]="funcionUsuarios.js";
            $this->views->obtenerVista($this,"Usuarios",$data);
        }

        // INtroduce datos de personal a base de datos
        public function setUsuario(){
            if($_POST){
                if(empty($_POST['txtNombres']) || empty($_POST['txtApellidoPaterno'])
                || empty($_POST['txtApellidoMaterno']) || empty($_POST['txtEmail']) || empty($_POST['listProfesionid']) 
                || empty($_POST['listRolid']) || empty($_POST['listServicioid'])
                || empty($_POST['listGrupoid'])){
                    $arrResponse = array("status"=>false, "msg"=>"Datos incorrectos");
                }else{
                    
                    $intIDpersonal = intval(limpiaCadena($_POST['idUsuario'])); 
                    $strNombre = ucwords(limpiaCadena($_POST['txtNombres'])); 
                    $strApellidoPaterno = ucwords(limpiaCadena($_POST['txtApellidoPaterno'])); 
                    $strApellidoMaterno = ucwords(limpiaCadena($_POST['txtApellidoMaterno'])); 
                    $strEmail = limpiaCadena($_POST['txtEmail']); 
                    $intProfesionid = intval(limpiaCadena($_POST['listProfesionid'])); 
                    $intRolid = intval(limpiaCadena($_POST['listRolid'])); 
                    $intServicioid = intval(limpiaCadena($_POST['listServicioid'])); 
                    $intGrupoid = limpiaCadena($_POST['listGrupoid']); 

                    $strHabilitado = empty($_POST['txtHabilitado'])? "NO":$_POST['txtHabilitado'];
                    
                   
                    // verificamos si actualiza registro o crea nuevo registro registro
                    if($intIDpersonal ==0) {
                        $Opcion = 1;
                        $strContrasena = empty($_POST['txtContrasena'])? 
                        password_hash(generarPassword(),PASSWORD_DEFAULT) : password_hash($_POST['txtContrasena'],PASSWORD_DEFAULT);
                        
                        $requestUser = $this->modelo->insertUsuario($strNombre,$strApellidoPaterno,$strApellidoMaterno,$strEmail,$intProfesionid,
                        $intRolid,$intServicioid,$intGrupoid,$strHabilitado,$strContrasena);

                    }else{
                        $Opcion = 2;
                        $strContrasena = empty($_POST['txtContrasena'])? 
                        " ": password_hash($_POST['txtContrasena'],PASSWORD_DEFAULT);
                        
                        $requestUser = $this->modelo->updateUsuario($intIDpersonal,$strNombre,$strApellidoPaterno,$strApellidoMaterno,$strEmail,$intProfesionid,
                        $intRolid,$intServicioid,$intGrupoid,$strHabilitado,$strContrasena);
                    }

                    // depurar($requestUser);
                      if($requestUser === 'exist'){
                        $arrResponse = array("status"=>false, "msg"=>"El email ya existe, ingrese otro email");
                    }else{
                        if($Opcion == 1){
                            $arrResponse = array("status"=>true, "msg"=>"Datos guardados correctamente");
                        }else{
                            $arrResponse = array("status"=>true, "msg"=>"Datos Actualizados correctamente");
                        }
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        
        // Obtiene datos de personal
         public function getUsuarios(){
            $arrData = $this->modelo->selectUsuarios();
            for ($i = 0; $i < count($arrData); $i++) {
                if(strcasecmp ($arrData[$i]['Habilitado'],'SI') === 0){
                    $arrData[$i]['Habilitado'] = '<div class="row justify-content-center"><button class="btn btn-success" type="button" disabled ="">SI</button></div>';
                }else{
                    $arrData[$i]['Habilitado'] = '<div class="row justify-content-center"><button class="btn btn-warning" type="button" disabled ="">NO</button></div>';
                }
                $arrData[$i]["Opciones"] = '<div class="row justify-content-center">
                    <button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario(' . $arrData[$i]['IDpersonalDS'] . ')" type="button"><i class="far fa-eye"></i></button>
                    <button class="btn btn-success btn-sm btnEditUsuario" onClick="fntEditUsuario(' . $arrData[$i]['IDpersonalDS'] . ')" type="button"><i class="fa-solid fa-pencil"></i></button>
                    <button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario(' . $arrData[$i]['IDpersonalDS'] . ')" type="button"><i class="fa-solid fa-trash-can"></i></button>
                    </div>';
                
                $arrData[$i]['Apellidos'] = $arrData[$i]['ApellidoPaterno']." ".$arrData[$i]['ApellidoMaterno'];
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
         }

        // obtiene datos de una persona de la BBDD
        public function getUsuario($id){
            $intIDpersoanl = intval($id[0]);
            if($intIDpersoanl>0){
                $arrData = $this->modelo->selectUsuario($intIDpersoanl);
                if(empty($arrData)){
                    $arrResponse= array("status"=>false, "msg"=>"Datos no encontrados");
                }else{
                    $arrResponse= array("status"=>true, "msg"=>$arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            } 
            die();
        } 

        //Elimina personal de base de datos 
        public function delUsuario(){
            if($_POST){
                $idPersonal = intval($_POST["idUsuario"]);
                $requestDelete =$this->modelo->deleteUsuario($idPersonal);
                if($requestDelete){
                    $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado a usuario");
                }else{
                    $arrResponse = array("status"=>false,"msg"=>"Error al eliminar a usuario");
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }

?>
