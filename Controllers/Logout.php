<?php
    class Logout extends Controladores {

        public function __construct(){
            session_start();
            session_unset();
            session_destroy();
            header('location: '.base_url().'/Login');
            // parent::__construct();
        }
        
        
        
        
    }

?>