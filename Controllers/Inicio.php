<?php
    class Inicio extends Controladores {

        public function __construct(){
            parent::__construct();

            session_start();
            if(empty($_SESSION['login'])){  
                header('Location: '.base_url().'/Login');
            }
        }
        
        public function Inicio(){
            $data["pagina_id"]=7;
            $data["pagina_Tag"]="Panel Inicial";
            $data["pagina_titulo"]=$_SESSION['userData']['NombreDeServicio'];
            $data["pagina_nombre"]="Inicio";
            $data['pagina_funciones_js'] = "funcionInicio.js";
            
            $data['usuarios'] = $this->modelo->cantidadUsuarios();
            $data['servicios'] = $this->modelo->cantidadServicios();
            $data['tablaDeCamas'] = $this->modelo->tablaDeCamas($_SESSION['userData']['IDservicio']);
            $data['tablaDeSanitarios'] = $this->modelo->tablaDeSanitarios($_SESSION['userData']['IDservicio']);
            // depurar($_SESSION['userData']['IDservicio']); exit();
            $this->views->obtenerVista($this,"Inicio",$data);
        }   
    }

?>
