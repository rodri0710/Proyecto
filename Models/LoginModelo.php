<?php
    class LoginModelo extends Mysql{
        public function __construct(){
            parent::__construct();
            //  echo "Mensaje desde el modelo Home<br>";
        }

        //obtine datos de usuario
        public function loginUser($strUsuario){
        
            $sql="SELECT * FROM personal WHERE Email = '{$strUsuario}'";
            $dato = $this->seleccionarVarios($sql);
            return $dato;
        }

        //obtiene datos de usuario logueado
        public function sessionLogin($idUser){
            $sql = "SELECT P.IDpersonalDS, P.Nombres, P.ApellidoPaterno, P.ApellidoMaterno, P.Email,P.IDservicio, S.NombreDeServicio,P.IDTprofesion,
                    PF.NombreDeProfesion,P.IDGrupo,G.NombreDeGrupo,P.IDrol, R.NombreRol, P.Habilitado FROM personal P JOIN servicios S ON 
                    P.IDservicio= S.IDservicio JOIN rol R ON R.IDrol = P.IDrol JOIN profesion PF ON PF.IDprofesion = P.IDTprofesion 
                    JOIN grupos G ON G.IDGrupo=P.IDGrupo WHERE P.IDpersonalDS = '{$idUser}'" ;
            $request=$this->seleccionar($sql);
            // depurar($request);
            // exit();
            return $request;
        }

        //obtiene datos de Email
        public function getUserEmail(string $strEmail){
            $sql="SELECT IDpersonalDS, Nombres, ApellidoPaterno, ApellidoMaterno FROM personal WHERE Email='{$strEmail}'";
            $request = $this->seleccionar($sql);
            return $request;
        }

        //guarda token generado para recuperar contrasena
        public function setTokenUser(int $idpersona, string $token){
            $sql = "UPDATE personal SET tokenEmail = ? WHERE IDpersonalDS = '{$idpersona}'";
            $arrData = array($token);
            $request = $this->actualizar($sql,$arrData);
            return $request;
        }

        // obtiene IDpersonaDS de BBDD con email y token
        public function getUsuario(string $email, string $token){
            $sql="SELECT IDpersonalDS FROM personal WHERE Email='{$email}' AND tokenEmail='{$token}'";
            $request = $this->seleccionar($sql);
            return $request;
        }

        // Registra la nueva contrasenia en BBDD
        public function insertCambioPassword(int $idPersonal, string $password){
            $sql="UPDATE personal SET contrasena =?, tokenEmail = ? WHERE IDpersonalDS = $idPersonal";
            $arrData = array($password,"");
            $request = $this->actualizar($sql,$arrData);
            return $request;
        }
        
    }
?>