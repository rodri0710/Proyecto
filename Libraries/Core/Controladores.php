<?php
    Class Controladores{
        public function __construct(){
            $this->views = new Views();
            $this->CargarModelo(); 
        }

        public function CargarModelo(){
            //HomeModel.php
            $modelo = get_class($this)."Modelo";
            // echo $modelo."<br>";
            $rutaClase = "Models/".$modelo.".php";
            // echo $rutaClase."<br>";
            if(file_exists($rutaClase)){
                require_once ($rutaClase);
                $this->modelo = new $modelo();
            }
            //else echo "No existe ruta ".$rutaClase ; 
        }

    }


?>


