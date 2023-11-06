<?php
    $ArchivoControlador = "Controllers/".$controlador.".php";
    if(file_exists("$ArchivoControlador")){
        require_once("$ArchivoControlador");
        $controlador = new $controlador();
        if(method_exists($controlador,$metodo)){
            $controlador->{$metodo}($parametros);
        }else{
            require_once("Controllers/Error.php");
        }
    }else{
        require_once("Controllers/Error.php");
    }
?>