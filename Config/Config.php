<?php
    const BASE_URL = "http://localhost/levelCar";
    date_default_timezone_set('America/La_Paz'); 
    define('DB_HOST','localhost');
    define('DB_NAME','hospital');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_CHARSET','charset=utf8');

    // Datos envio de correo
    const NOMBRE_REMITENTE = "Nombre Remitente de correo";
    const EMAIL_REMITENTE = "no-reply@empresa.com";
	const NOMBRE_HOSPITAL= "SISTEMA HOSPITALARIO";

    // ID profesiones
    const IDprofesionDoctor = 1;
    const IDprofesionEnfermeria = 2;
    const IDprofesionCamillero = 3;
    const IDprofesionPerifoneo = 4;
?>