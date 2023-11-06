<?php
    class PersonalModelo extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function obtenerContactos($parametro){
            $horarioObj = new Horario();
            
            $IDprofesion=intval($parametro["IDprofesion"]);
            // se determina, a cual de los horarios corresponde la hora actual?
            $sql="SELECT idHorario, horaInicial, horaFinal FROM horarios WHERE IDprofesion=$IDprofesion";
            $horarios = $this->seleccionarVarios($sql);
            // print_r($horarios);
            if(count($horarios) > 0){
                $horaActual='19:20';
                // $horaActual = date('H:i:s', time());
                $idHorario=$horarioObj->encontrarHorario($horarios,$horaActual); // metodo que verifica horario
                // se asigna a varibles el rango de horario de hora actual.
                $idHorarioVerificado= $idHorario['idHorario'];
                // echo $idHorarioVerificado."\n";
    
                //------------------------------------Verificar a que grupo corresponde conforme al dia y hora----------------------------------------------------------
                        
                //------------------------------------Verificar personal corresponde conforme al dia y hora----------------------------------------------------------
                // Obtiene personal de turno dependiendo de SERVICIO Y PROFESION
                $sql1 = "SELECT * from fechainiciotrabajo WHERE IDprofesion = $IDprofesion";
                $resFecha = $this->seleccionarVarios($sql1);
                // depurar($resFecha);
                if(count($resFecha) > 0){
                    $fechaHoy=intval(strtotime(date('Y/m/d', time())));
                    // $fechaHoy=intval(strtotime(date('Y/m/d', time())."+ 1 days"));
                    $resultado = $horarioObj->encontrarIdFecha($resFecha,$fechaHoy);
                    // print_r($resultado);
                    if(count($resultado) > 0){
                        $servicio= intval($parametro['servicio']);
                            $sql2='SELECT P.IDpersonalDS, P.Nombres, P.ApellidoPaterno, P.ApellidoMaterno,P.token, 
                            P.Email, S.NombreDeServicio, G.NombreDeGrupo, G.IDHorario, G.IDprofesion, PF.NombreDeProfesion,FIT.IDfechaTrabajo 
                        FROM servicios S JOIN personal P on S.IDservicio = P.IDservicio JOIN grupos G on G.IDGrupo=P.IDGrupo JOIN fechainiciotrabajo FIT 
                        on FIT.IDfechaTrabajo = G.IDfechaTrabajo JOIN horarios H ON H.IDHorario = G.IDHorario JOIN profesion PF ON PF.IDprofesion = P.IDTprofesion WHERE S.IDservicio = '.$servicio.' AND G.IDprofesion = '.$IDprofesion.'
                        AND H.IDHorario = '.$idHorarioVerificado.' AND FIT.IDfechaTrabajo = '.$resultado["IDfechaTrabajo"];
                        $respDatosPersonal = $this->seleccionarVarios($sql2); 
                        // depurar($respNotificaciones);
                        
                        return $respDatosPersonal;
                    }
                    
                }   
            }
            return false;
            
        }
        
    }
?>
