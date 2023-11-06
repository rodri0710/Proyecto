
<?php headerAdmin($data);
     getModal("modalUsuarios",$data);
?>
    <div id="contentAjax"></div>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><?= $data["pagina_titulo"] ;?>
                <button class="btn btn-primary" id="nuevoUsuario" type="button"><i class="fa-regular fa-plus"></i> Nuevo</button>
                </h1>
            </div>  
        </div>
        <div class="row ">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableUsuarios">
                  <thead >
                    <tr>
                      <th>ID</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Servicio</th>
                      <th>Profesion</th>
                      <th>Grupo</th>
                      <th>Rol</th>
                      <th>Habilitado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <!-- ingresa datos de BBDD -->
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </main>
<?php footerAdmin($data);?>
  