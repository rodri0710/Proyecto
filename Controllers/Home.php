<?php
    class Home extends Controladores {

        public function __construct(){
            parent::__construct();
        }
        
        public function home(){
            $data["pagina_id"]=1;
            $data["pagina_Tag"]="Tienda virtual";
            $data["pagina_titulo"]="Tienda virtual";
            $data["pagina_nombre"]="Home";
            $this->views->obtenerVista($this,"Home",$data);
        }

        public function seleccionar($parametro){
            
            $resp = $this->modelo->select($parametro);
            echo "<pre>";
            print_r($resp);
            echo "</pre>";
        }    
    }

?>
