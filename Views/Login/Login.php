<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
    <meta name="description" content="Monitorea camas y sanitario de un hospital.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=”Last-Modified” content=”0″>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Limber Titirico C.">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?=Assets();?>/imagenes/upload/icono.ico">
    <title> LEVEL CAR </title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=Assets();?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/style.css">
</head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1 class="title">LEVEL CAR </h1>
      </div>
      <div class="login-box">
        <div id="divLoading">
          <div>
          <img src="<?=Assets();?>/imagenes/upload/loading.svg" alt="cargando">
          </div>
        </div>
        <form class="login-form" id="formLogin" name="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Contraseña</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <div class="utility">
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button  type="submit" class="btn btn-primary btn-block">INICIAR SESIÓN</button>
          </div>
        </form>
        <form id="formRecetPass" name="formRecetPass"class="forget-form" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>RESTABLECER CONTRASEÑA</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Volver atras</a></p>
          </div>
        </form>

        

      </div>
    </section>

   <script>
    const base_url = '<?= base_url(); ?>';
  </script>

    <!-- Essential javascripts for application to work-->
    <script src="<?=Assets();?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?=Assets();?>/js/popper.min.js"></script>
    <script src="<?=Assets();?>/js/bootstrap.min.js"></script>
    <script src="<?=Assets();?>/js/fontawesome.js"></script>
    <script src="<?=Assets();?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=Assets();?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?=Assets();?>/js/<?= $data['pagina_funciones_js']; ?>"></script>
  </body>
</html>
  