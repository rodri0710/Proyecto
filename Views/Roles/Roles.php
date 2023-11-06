
<?php headerAdmin($data);
     getModal("modalRoles",$data);
?>
    <div id="contentAjax"></div>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><?= $data["pagina_titulo"] ;?>
                <button class="btn btn-primary" id="nuevoRol" type="button"><i class="fa-regular fa-plus"></i> Nuevo</button>
                </h1>
            </div>  
        </div>
        <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="tableRoles">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
        
    </main>
<?php footerAdmin($data);?>
  