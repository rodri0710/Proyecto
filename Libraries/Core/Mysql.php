<?php

     class Mysql extends Conexion{
        private $conexion;
        private $query;
        private $arrValores;
        
        function __construct(){
            // echo "Desde MYSQL class\n";
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->connect();
        }
         public function prueba(){
            echo "desde el metodo prueba de mysql"; 
        }
        // Insetar un registro de la BBDD
        public function insertar($query, $arrValores){
            $this->query = $query;
            $this->arrValores = $arrValores;
            $insertar = $this->conexion->prepare($this->query);
            $respInsert = $insertar->execute($this->arrValores);
            if($respInsert){
                 $ultimoId = $this->conexion->lastInsertId();
            }else{
                $ultimoId = 0;
            }
            return $ultimoId;
        }

           // Insetar un registros de la BBDD
           public function insertarVarios($query){
            $this->query = $query;
            $insertar = $this->conexion->prepare($this->query);
            $respInsert = $insertar->execute();
            if($respInsert){
                 $ultimoId = $this->conexion->lastInsertId();
            }else{
                $ultimoId = 0;
            }
            return $ultimoId;
        }

        // Buscar un registro
        public function seleccionar($query,$arrValores=null){
            // echo "------------";
            $this->query = $query;
            $seleccinar = $this->conexion->prepare($this->query);
            $seleccinar->execute($arrValores);
            $dato = $seleccinar->fetch(PDO::FETCH_ASSOC);
            // print_r($dato);
            return $dato;
        }

        // Buscar varios registros
        public function seleccionarVarios($query){
            $this->query = $query;
            $seleccinar = $this->conexion->prepare($this->query);
            $seleccinar->execute();
            $dato = $seleccinar->fetchAll(PDO::FETCH_ASSOC);
            return $dato;
        }

        public function selectRegistroMultiples($query){
            $arrayData = array();
            $selectDatos = $this->conexion->prepare($query);
            $selectDatos->execute();
            $respSelectDatos = $selectDatos->fetchAll(PDO::FETCH_ASSOC);
                foreach($respSelectDatos  as $value){
                    //echo $value["ID"]." tiene ".$value["cant"]."<br>";
                    $arrayData[$value["ID"]]=$value["cant"];
                }
            return $arrayData;
        }

        // Actualizar registro
        public function actualizar($query,$arrValores){
            $this->query = $query;
            $this->arrValores = $arrValores;
            $actualizar = $this->conexion->prepare($this->query);
            $respActualizar = $actualizar->execute($this->arrValores);
            return $respActualizar;
        }

        //Eliminar registros
        public function eliminar($query){
            $this->query = $query;
            $eliminar = $this->conexion->prepare($this->query);
            $respEliminar = $eliminar->execute();
            return $respEliminar;
        }
    }

?>