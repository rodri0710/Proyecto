<?php

    //Retorna la url base del proyecto
    function base_url() {
        return BASE_URL;
    }

    //Retorna la url base del proyecto
    function Assets() {
        return BASE_URL."/Assets";
    }

    //Llama a header
    function headerAdmin($data = "") {
        $viewHeader = "Views/Template/headerAdmin.php";
        require_once ($viewHeader); 
    }
    
    //Llama a footer
    function footerAdmin($data = "") {
        $viewHeader = "Views/Template/footerAdmin.php";
        require_once ($viewHeader); 
    }

    //Ayuda a depurar cidigo
    function depurar($data){
        $formato = print_r("<pre>");
        $formato .=print_r($data);
        $formato .= print_r("<pre>");
        return $formato;
    }

    function getModal($nombreModal,$data){
        require_once "Views/Template/Modals/{$nombreModal}.php";
    }

    // cdn firabase
    function firebase(){
        $rutafirebase = "Views/Template/firebase.php";
        require_once ($rutafirebase); 
    }
    // inicializa firabase
    function inifirebase(){
        $inifirebase = Assets()."/js/firebase/inicializacion.js";
        require_once ($inifirebase); 
    }

    //envia correos
    function sendEmail($data,$template){
        $asunto=$data["asunto"];
        $emailDestino=$data["email"];
        $hospital=NOMBRE_HOSPITAL;
        $remitente=EMAIL_REMITENTE;
        //envio de correo
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$hospital} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }

    //Elimina excesos de espacios entre palabras
    function limpiaCadena($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("in NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace('LIKE ´',"",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }
    //valida formato de correo electronico
    function validarEmail($email){
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        return preg_match($regex, $email);
    }
    
    //valida formato password
    function validarPassword($password){
        //$regex = "^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$";
        //$longitudPassword = strlen($password);
        return (strlen($password)>=8 && strlen($password)<=16) ? true : false;
    }

    //Genera una constrasenia de 10 caracteres
    function generarPassword($length=10){
        $pass = "";
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
    
        for($i = 1; $i < $length; $i++){
            $pos = rand(0,$longitudCadena-1);
            $pass .=substr($cadena,$pos,1);
        }
        return $pass;
    }
    
    // Genera token
    function token(){
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1 . $r2 . $r3 . $r4;
        return $token;
    }
    // retorna mensaje de consulta fallida sin datos
    function mensajeFallido($mesaje){
        $respuesta= array('estado' => 'fallido',
                    'mensaje' => $mesaje
                    );
        return json_encode($respuesta);
    }
    // retorna mensaje de exito con datos
    function mensajeExito($mensaje , $parametros = ""){
        $respuesta = array('estado' => 'exito',
                    'mensaje' => $mensaje,
                    'datos' => $parametros
                    );
        return json_encode($respuesta);   
    }
    // retorna datos en JSON
    function respJson($datos){
        $respuesta = array($datos);
        return json_encode($respuesta);
    }
    // retorna mensaje cantidad 
    function mensajeCantidadSSCS($mensaje , $datosServicio = "",$datosSala = "", $datosCama = ""){
        $respuesta = array('estado' => 'exito',
                    'mensaje' => $mensaje,
                    'datos' => array('datosServicio' =>$datosServicio,
                                     'datosSala' =>$datosSala,
                                     'datosCama' =>$datosCama,
                                    )
                    );
        return json_encode($respuesta);
    }

?>