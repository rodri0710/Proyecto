<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Monitorea camas y sanitario de un hospital.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Last-Modified” content=”0″>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Limber Titirico C.">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?=Assets();?>/imagenes/upload/icono.ico">
    <title> Sistema de monitoreo</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/fullcalendar.css">
    <!-- fechas -->
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/daterangepicker.css">
    <!-- horas -->
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/bootstrap-clockpicker.css">
    
    </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
      <!-- <a class="app-header__logo" href="<?=base_url();?>/Inicio">Ecall</a> -->
      <div class="app-header__logo">
        <img src="<?=Assets();?>/imagenes/upload/logo_circle.png" alt="logo" class="imagenLogo">
      </div>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?=base_url();?>/Opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="<?=base_url();?>/Perfil"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="<?=base_url();?>/Logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <?php require_once ("navAdmin.php");?>