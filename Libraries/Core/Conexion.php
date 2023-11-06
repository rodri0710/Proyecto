<?php

    class Conexion {
            
        protected $connect;

        public function __construct(){
        

            $connectString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";DB_CHARSET.";

            try{
                $this->connect = new PDO($connectString,DB_USER,DB_PASS);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "conexion successfully";
            }catch(PDOException $e){
                echo "conexion fallida ". $e->getMessage();
                die();
            }
            
        }
        public function connect(){
            return $this->connect;
        }
        

    }
?>