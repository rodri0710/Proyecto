
<?php headerAdmin($data);?>
    <main class="app-content">
        <div class="app-title">
                <h1><i class="fa fa-dashboard"></i> <?= $data["pagina_titulo"];?></h1>             
        </div>
        
        <div class="row d-flex justify-content-around">
            <div class="col-md-10 col-lg-4 ">
                <a href="<?=base_url()?>/Usuarios" class="linkw">
                    <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                        <h4>Usuarios</h4>
                        <p><b><?=$data["usuarios"]?></b></p>
                        </div>
                    </div>  
                </a>
            </div>
            <div class="col-md-10 col-lg-4">
                <a href="<?=base_url()?>/Servicio" class="linkw">
                    <div class="widget-small info coloured-icon"><i class="icon fa fa-hospital fa-3x"></i>
                        <div class="info">
                        <h4>Servicios</h4>
                        <p><b><?=$data["servicios"]?></b></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Historial</h3>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Sala</th>
                    <th>Cama</th>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th>Estado</th>
                    <th>Atendido por </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(COUNT($data['tablaDeCamas'])>0){
                        foreach($data['tablaDeCamas'] as $registroCama ){?>
                    
                        <tr>
                        <td><?=$registroCama['IDregistroAlarma']?></td>
                        <td><?=$registroCama['Sala']?></td>
                        <td><?=$registroCama['Cama']?></td>
                        <td><?=$registroCama['inicioAlarma']?></td>
                        <td><?=$registroCama['finAlarma']?></td>
                        <td><?=$registroCama['Estado']?></td>
                        <td><?=$registroCama['nombres']?></td>
                        </tr>
    
                    <?php }
                    }?>
                </tbody>
                </table>
            </div>
            </div>
            <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title"></h3>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Sala</th>
                  <th>Sanitario</th>
                  <th>Inicio</th>
                  <th>Final</th>
                  <th>Estado</th>
                  <th>Atendido por</th>
                </tr>
              </thead>
              <tbody>
                <?php if(COUNT($data['tablaDeSanitarios'])>0){
                    foreach($data['tablaDeSanitarios'] as $registroSanitario ){?>
                   
                    <tr>
                    <td><?=$registroSanitario['IDregistroAlarma']?></td>
                    <td><?=$registroSanitario['Sala']?></td>
                    <td><?=$registroSanitario['Sanitario']?></td>
                    <td><?=$registroSanitario['inicioAlarma']?></td>
                    <td><?=$registroSanitario['finAlarma']?></td>
                    <td><?=$registroSanitario['Estado']?></td>
                    <td><?=$registroSanitario['nombres']?></td>
                    </tr>
   
                <?php }
                }?>
              </tbody>
            </table>
          </div>
        </div>
        </div>
        
    </main>
<?php footerAdmin($data);?>
  