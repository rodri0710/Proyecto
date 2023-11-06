<?php
    class Login extends Controladores {

        public function __construct(){
            
            session_start();
            if(isset($_SESSION['login'])){  
                header('Location: '.base_url().'/Inicio');
            }
            parent::__construct();
        }
        
        public function login(){
            $data["pagina_Tag"]="Login";
            $data["pagina_titulo"]="Tienda virtual";
            $data["pagina_nombre"]="Login";
            $data["pagina_funciones_js"]="funcionLogin.js";
            $this->views->obtenerVista($this,"Login",$data);
        }

        public function loginUser(){
            
            if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
                $arrResponse = array('status' => false, 'msg' => 'Error de datos');
            }else{
                $strUsuario = strtolower(limpiaCadena($_POST['txtEmail']));
                $requestUser = $this->modelo->loginUser($strUsuario);
                
                if(empty($requestUser) || !password_verify($_POST['txtPassword'],$requestUser[0]['contrasena'])){
                    $arrResponse = array('status'=>false, 'msg'=>'El usuario o contraseña es incorrecto');
                }else{
                    if(!strcasecmp($requestUser[0]['Habilitado'], "si")){
                        $_SESSION['idUser']=$requestUser[0]['IDpersonalDS'];
                        $_SESSION['login']=true;

                        $arrData = $this->modelo->sessionLogin($requestUser[0]['IDpersonalDS']);
                        $_SESSION['userData']=$arrData;
                        // depurar($_SESSION);
                        // exit();

                        $arrResponse = array('status'=>true, 'msg'=>'ok');
                    }else{
                        $arrResponse = array('status'=>false, 'msg'=>'El usuario no esta habilitado para iniciar sesion');
                    }
                    
                }
            
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }

        // Iniciamos proceso de resetear el password y envia email al correo
        public function resetPass(){
            if($_POST){
                if(empty($_POST["txtEmailReset"])){
                    $arrResponse = array('status'=>false, 'msg'=>'Error de datos');
                }else {
                    $token = token();
                    $strEmail = strtolower(limpiaCadena($_POST["txtEmailReset"]));
                    $arrData = $this->modelo->getUserEmail($strEmail);

                    if(empty($arrData)){
                        $arrResponse = array('status'=>false, 'msg'=>'Usuario no existe');
                    }else{
                        $idpersona = $arrData['IDpersonalDS'];
                        $nombreUsuario = $arrData['Nombres'].' '.$arrData['ApellidoPaterno'].' '.$arrData['ApellidoMaterno'];
                        $url_recovery = base_url().'/Login/confirmUser/'.$strEmail.'/'.$token;
                        $requestUpdate=$this->modelo->setTokenUser($idpersona,$token);
                        
                        $dataUsuario = array('nombreUsuario'=>$nombreUsuario,
                                                'email'=>$strEmail,
                                                'asunto'=>'Recuperar cuenta',
                                                'url_recovery'=>$url_recovery);
                        
                                                
                        if($requestUpdate){
                            $sendEmail = sendEmail($dataUsuario,'email_cambioPassword');
                            if($sendEmail){
                                $arrResponse = array('status'=>true,'msg'=>'Se ha enviado un email a tu correo electronico para cambiar la contraseña');
                            }else{
                                $arrResponse = array('status'=>false,'msg'=>'No es posible realizar el proceso, intente mas tarde');
                            }
                        }else{
                            $arrResponse = array('status'=>false,'msg'=>'No es posible realizar el proceso, intente mas tarde');
                        }
                    
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        // Muestra la pantalla de cambio de contraseña en el navegador con el link enviado a email

        public function confirmUser($params){
            if(empty($params)){
                header('Location:'.base_url());
            }else{
                $strEmail=limpiaCadena($params[0]);
                $strToken=limpiaCadena($params[1]);
                $arrResponse = $this->modelo->getUsuario($strEmail,$strToken);
                if(empty($arrResponse)){
                    header('Location:'.base_url());
                }else{
                    $data["pagina_Tag"]="Cambiar contraseña";
                    $data["pagina_titulo"]="Tienda virtual";
                    $data["pagina_nombre"]="Cambiar contraseña";
                    $data["pagina_funciones_js"]="funcionLogin.js";

                    $data["idpersona"]=$arrResponse['IDpersonalDS'];
                    // $data["idpersona"]=256;
                    $data["email"]=$strEmail;
                    $data["token"]=$strToken;
                    $this->views->obtenerVista($this,"Cambiar_password",$data);
                }
            }
            die();
        }

        // Guarda la nueva contrasena en la base de datos
        public function setPassword(){
            // depurar($_POST);
            // die();
            if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || 
                empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){
                $arrResponse = array('status'=>false, 'msg'=>'Error de datos');
            }else{
                $intIdPersonal = intval($_POST['idUsuario']);
                $strPassword = $_POST['txtPassword'];
                $strPasswordConfirm = $_POST['txtPasswordConfirm'];
                $strEmail =limpiaCadena($_POST['txtEmail']);
                $strToken =limpiaCadena($_POST['txtToken']);

                
                if($strPassword != $strPasswordConfirm){
                    $arrResponse = array('status'=>false, 'msg'=>'Las contraseñas no son iguales');
                }else{
                    $arrResponseUser = $this->modelo->getUsuario($strEmail,$strToken);
                    if(empty($arrResponseUser)){
                        $arrResponse = array('status'=>false, 'msg'=>'Error de datos');   
                    }else{
                        $strPassword = password_hash($strPassword,PASSWORD_DEFAULT);
                        $requestPass= $this->modelo->insertCambioPassword($intIdPersonal,$strPassword);
                        
                        if($requestPass){
                            $arrResponse = array('status'=>true,'msg'=>'La contaseña se actualizo correctamente');
                        }else{
                            $arrResponse = array('status'=>false,'msg'=>'No es posible realizar el cambio de contraseña, vuelva a intentarlo');
                        }
                    }
                }

            }

            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }

?>
