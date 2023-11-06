<?php
    class Errors extends Controladores {

        public function __construct(){
            parent::__construct();
        }
        
        public function noEncontrado(){
            $this->views->obtenerVista($this,"Error");
        }
    }

    $errors = new Errors();
    $errors->noEncontrado();

?>
