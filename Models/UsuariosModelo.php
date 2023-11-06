<?php
    class UsuariosModelo extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function insertUsuario($strNombre,$strApellidoPaterno,$strApellidoMaterno,$strEmail,$intProfesionid,
        $intRolid,$intServicioid,$intGrupoid,$strHabilitado,$strContrasena){
            $return = 0;
            $sql = "SELECT * FROM personal WHERE Email = '{$strEmail}'";
            $request = $this->seleccionarVarios($sql);
            if(empty($request)){
                $query_insert = "INSERT INTO personal (IDTprofesion,Email,contrasena,IDrol,Habilitado,Nombres,IDservicio,
                ApellidoPaterno,ApellidoMaterno,IDGrupo) VALUES(?,?,?,?,?,?,?,?,?,?)";
                $arrData = array($intProfesionid,$strEmail,$strContrasena,$intRolid,$strHabilitado,$strNombre,$intServicioid,
                $strApellidoPaterno,$strApellidoMaterno,$intGrupoid);
                $requestInsert=$this->insertar($query_insert,$arrData);
                $return = $requestInsert;
            }else{
                $return = "exist";
            }
            return $return;
        }
        // obtiene todo el personal
        public function selectUsuarios(){
			// $sql = "SELECT P.IDpersonalDS, P.Nombres, P.ApellidoPaterno, P.ApellidoMaterno, P.Email, S.NombreDeServicio,
            //         PF.NombreDeProfesion,G.NombreDeGrupo, R.NombreRol, P.Habilitado FROM personal P JOIN servicios S ON 
            //         P.IDservicio= S.IDservicio JOIN rol R ON R.IDrol = P.IDrol JOIN profesion PF ON PF.IDprofesion = P.IDTprofesion 
            //         JOIN grupos G ON G.IDGrupo=P.IDGrupo";
            
            $sqlServicio = "SELECT NombreDeServicio FROM servicios WHERE IDservicio = ?";
            $sqlProfesion = "SELECT NombreDeProfesion FROM profesion WHERE IDprofesion = ?";
            $sqlGrupo = "SELECT NombreDeGrupo FROM grupos WHERE IDGrupo = ?";
            $sqlRol = "SELECT NombreRol FROM rol WHERE IDrol = ? ";

            $sql = "SELECT * FROM personal";
			$request = $this->seleccionarVarios($sql);
                    for($i=0;$i<count($request);$i++){
                        $arrValorServicio = array($request[$i]['IDservicio']);
                        $arrValorProfesion = array($request[$i]['IDTprofesion']);
                        $arrValorGrupo = array($request[$i]['IDGrupo']);
                        $arrValorRol = array($request[$i]['IDrol']);
                        $ser=$this->seleccionar($sqlServicio,$arrValorServicio);
                        $prof=$this->seleccionar($sqlProfesion,$arrValorProfesion);
                        $grup=$this->seleccionar($sqlGrupo,$arrValorGrupo);
                        $rol=$this->seleccionar($sqlRol,$arrValorRol); 
                        if(is_array($ser)){
                            $request[$i]['NombreDeServicio'] = $ser['NombreDeServicio'];
                        }else{
                            $request[$i]['NombreDeServicio'] = "No designado";
                        }
                        if(is_array($prof)){
                            $request[$i]['NombreDeProfesion'] = $prof['NombreDeProfesion'];
                        }else{
                            $request[$i]['NombreDeProfesion'] = "No designado";
                        }
                        if(is_array($grup)){
                            $request[$i]['NombreDeGrupo'] = $grup['NombreDeGrupo'];
                        }else{
                            $request[$i]['NombreDeGrupo'] = "No designado";
                        }
                        if(is_array($rol)){
                            $request[$i]['NombreRol'] =  $rol['NombreRol'];
                        }else{
                            $request[$i]['NombreRol'] = "No designado";
                        }
                        
                        // $request['NombreDeProfesion'] = $prof['NombreDeProfesion'];
                        // $request['NombreDeGrupo'] = $grup['NombreDeGrupo'];
                        // $request['NombreRol'] =  $rol['NombreRol'];
                    }
                    // depurar($request);
                    // die();
					return $request;
		}

        // Obtiene datos de un personal especifico
        public function selectUsuario($IDpersonal){
            $sql = "SELECT P.IDpersonalDS, P.Nombres, P.ApellidoPaterno, P.ApellidoMaterno, P.Email, S.NombreDeServicio,
            PF.NombreDeProfesion,G.NombreDeGrupo, R.NombreRol, P.Habilitado, P.IDTprofesion,P.IDrol, P.IDservicio, P.IDGrupo 
            FROM personal P JOIN servicios S ON P.IDservicio= S.IDservicio JOIN rol R ON R.IDrol = P.IDrol JOIN profesion PF 
            ON PF.IDprofesion = P.IDTprofesion JOIN grupos G ON G.IDGrupo=P.IDGrupo WHERE IDpersonalDS = $IDpersonal";
          
            $request = $this->seleccionar($sql);
            
            return $request;
        }

        //Actualiza datos de personal
        public function updateUsuario($intIDpersonal,$strNombre,$strApellidoPaterno,$strApellidoMaterno,$strEmail,$intProfesionid,
        $intRolid,$intServicioid,$intGrupoid,$strHabilitado,$strContrasena){

            $sql = "SELECT * FROM personal WHERE Email= '{$strEmail}' AND IDpersonalDs != $intIDpersonal";
            $request = $this->seleccionarVarios($sql);

            if(empty($request)){
                if($strContrasena != ""){
                    $sql = "UPDATE personal SET IDTprofesion=?, Email=?,contrasena=?,IDrol=?,Habilitado=?,Nombres=?,IDservicio=?,
                    ApellidoPaterno=?,ApellidoMaterno=?,IDGrupo=? WHERE IDpersonalDS =$intIDpersonal";
                    $arrData = array($intProfesionid,$strEmail,$strContrasena,$intRolid,$strHabilitado,$strNombre,$intServicioid,
                    $strApellidoPaterno,$strApellidoMaterno,$intGrupoid);

                }else{
                    $sql = "UPDATE personal SET IDTprofesion=?, Email=?,IDrol=?,Habilitado=?,Nombres=?,IDservicio=?,
                    ApellidoPaterno=?,ApellidoMaterno=?,IDGrupo=? WHERE IDpersonalDS =$intIDpersonal";
                    $arrData = array($intProfesionid,$strEmail,$intRolid,$strHabilitado,$strNombre,$intServicioid,
                    $strApellidoPaterno,$strApellidoMaterno,$intGrupoid);
                }
                $request = $this->actualizar($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;
        }

        public function deleteUsuario($IDpersonal){
            $sql ="DELETE FROM personal WHERE IDpersonalDS = $IDpersonal";
            $request=$this->eliminar($sql);
            return $request;
        }
        
        
    }
?>