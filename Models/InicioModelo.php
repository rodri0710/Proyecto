<?php
    class InicioModelo extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        // obtiene el numero de usuarios registrados en sistema
        public function cantidadUsuarios(){
            $sql="SELECT COUNT(*) AS total FROM personal ";
            $request = $this->seleccionar($sql);
            return $request['total'];
        }

        // obtiene el numero de servicios de hospital registrados en sistema
        public function cantidadServicios(){
            $sql="SELECT COUNT(*) AS total FROM servicios";
            $request = $this->seleccionar($sql);
            return $request['total'];
        }
        
        //obtiene detalle de registro de alarmas hechas por las camas
        public function tablaDeCamas($idServicio){
            $sql="SELECT RA.IDregistroAlarma, RA.Sala, RA.Cama, RA.inicioAlarma,RA.finAlarma,RA.Estado, CONCAT(P.Nombres,' ',
            P.ApellidoPaterno) as nombres FROM registroalarma RA LEFT JOIN personal P 
            ON RA.IDpersonalDS=P.IDpersonalDS WHERE RA.Servicio = '$idServicio' AND RA.Cama IS NOT NULL ORDER BY RA.IDregistroAlarma DESC LIMIT 10";
            // echo $sql; exit();
            $request = $this->seleccionarVarios($sql);
            return $request;
        }

        //obtiene detalle de registro de alarmas hechas en los sanitarios
        public function tablaDeSanitarios($idServicio){
            $sql="SELECT RA.IDregistroAlarma, RA.Sala, RA.Sanitario, RA.inicioAlarma,RA.finAlarma,RA.Estado, CONCAT(P.Nombres,' ',
            P.ApellidoPaterno) as nombres FROM registroalarma RA LEFT JOIN personal P 
            ON RA.IDpersonalDS=P.IDpersonalDS WHERE RA.Servicio = '$idServicio' AND RA.Sanitario IS NOT NULL ORDER BY RA.IDregistroAlarma DESC LIMIT 10";
            $request = $this->seleccionarVarios($sql);
            return $request;
        }
        
    }
?>