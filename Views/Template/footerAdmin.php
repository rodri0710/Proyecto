  
  <script>
    const base_url = '<?= base_url(); ?>';
  </script>
  <!-- Essential javascripts for application to work-->
  <script src="<?= Assets(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= Assets(); ?>/js/popper.min.js"></script>
    <script src="<?= Assets(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= Assets(); ?>/js/main.js"></script>
    <script src="<?= Assets(); ?>/js/fontawesome.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= Assets(); ?>/js/plugins/pace.min.js"></script>
     <!-- Data table plugin-->
     <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/bootstrap-select.min.js"></script>

    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    
    <!-- Page specific javascripts-->   
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?=Assets();?>/js/<?= $data['pagina_funciones_js']; ?>"></script>
    <script  src="<?= Assets(); ?>/js/bootstrap-clockpicker.js"></script>
    
    <!-- fullcalendar -->
    <script src="<?= Assets(); ?>/js/moment.min.js"></script>
    <script  src="<?= Assets(); ?>/js/fullcalendar.min.js"></script>
    <script  src="<?= Assets(); ?>/js/locale/es.js"></script>
    <!-- hora  -->
    
  
  </body>
  
</html>