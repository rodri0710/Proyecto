<?php
    require_once ("Config/Config.php");
    require_once ("Helpers/Helpers.php");
    require_once ("Libraries/Core/VerificarDatos.php");
    require_once ("Helpers/Horario.php");
    
    $url = !empty($_GET['url']) ? $_GET['url'] : 'Login/Login';
    $arrUrl = explode("/", $url);
    $controlador = $arrUrl[0];
    $metodo = $arrUrl[0];
    $parametros = array();
    // si existe metodo en URL
    if(!empty($arrUrl[1])){
        if($arrUrl[1] != ""){
            $metodo = $arrUrl[1];
        }
    }
    // si existe parametros en URL
    
        //si es GET envia valor
        if(!empty($arrUrl[2])){
            if($arrUrl[2] != ""){
                for($i=2; $i<count($arrUrl);$i++){
                    $parametros[$i-2]= $arrUrl[$i];
                }
                
                //$parametros = trim($parametros,",");
            }
            //print_r ($parametros);
        }
        
    //Si hay una envio por POST entonces $parametros son sus argumentos de POST
    if(!empty($_POST)){
        //si es POST envia array
        $parametros = $_POST;
    }
        
    //Verifica archivo .php en direccion
    require_once "Libraries/Core/Autoload.php";

    //Load
    //Verifica existencia de controlador y metodo en CONTROLLERS
    require_once "Libraries/Core/Load.php";
    

?>



