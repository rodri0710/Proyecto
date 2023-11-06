
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= Assets(); ?>/imagenes/upload/avatar.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['Nombres']?> <?=$_SESSION['userData']['ApellidoPaterno'] ?> </p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['NombreDeProfesion'] ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <!-- <?php if (!empty($_SESSION['permisos'][1]['r'])){?> -->
        <!-- <?php } ?>-->
        <li><a class="app-menu__item" href="<?= base_url();?>/Inicio"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa-solid fa-users"></i><span class="app-menu__label m-1"> Personal</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url();?>/Usuarios">Usuarios</a></li>
            <li><a class="treeview-item" href="<?= base_url();?>/Roles">Roles</a></li>
          </ul>
        </li>
        
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa-solid fa-hospital"></i><span class="app-menu__label m-1"> Infraestructura</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url();?>/Servicio">Servicios</a></li>
            <li><a class="treeview-item" href="<?= base_url();?>/Habitacion">Habitaciones</a></li>
            <li><a class="treeview-item" href="<?= base_url();?>/Cama"> Camas</a></li>
            <li><a class="treeview-item" href="<?= base_url();?>/Sanitario"> Sanitarios</a></li>
          </ul>
        </li>
        
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa-regular fa-calendar-days"></i><span class="app-menu__label m-1"> Horarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url();?>/Horarios">Horarios</a></li>
          </ul>
        </li>
        
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa-regular fa-calendar-days"></i><span class="app-menu__label m-1"> Monitoreo</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url();?>/Monitoreo">Monitoreo</a></li>
          </ul>
        </li>

        
      </ul>
    </aside>