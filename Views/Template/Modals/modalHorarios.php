<!-- Modal para editar -->
<div class="modal fade" id="modalFormEditHorarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalEditLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <!-- <div class="tile"> -->
                    <div class="tile-body">
                        <form id="formHorariosEdit" name="formHorariosEdit">
                            <input type="hidden" name="idHoraTrabajoEdit" id="idHoraTrabajoEdit" value="">
                            <input type="hidden" name="idPersonalEdit" id="idPersonalEdit" value="">
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listEditServicioid">Servicio</label>
                                    <select class="form-control servicioId" data-live-search="true" id="listEditServicioid" name="listEditServicioid" required=""></select>

                                </div>
          
                                <div class="form-group col-md-6">
                                    <label for="listEditProfesionid">Profesion</label>
                                    <select class="form-control profesionId" data-live-search="true" id="listEditProfesionid" name="listEditProfesionid" required=""></select>
                                    
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listEditNombreid">Nombre</label>
                                    <select class="form-control" data-live-search="true" id="listEditNombreid" name="listEditNombreid" required=""></select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for ="FechaInicialModalEdit"class="control-label">Fecha inicial</label>
                                    <input class="form-control FechaUnica" id="FechaInicialModalEdit" name="FechaInicialModalEdit" type="text" placeholder="Fecha" required=""></input>
                                </div>
                                <div class="form-group col-md-6 px-3">
                                    <label for ="HoraInicialModalEdit"class="control-label">Hora Inicial</label>
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input class="form-control" id="HoraInicialModalEdit" name="HoraInicialModalEdit" type="text" placeholder="hora" required=""></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group ">
                                    <label for ="FechaFinModalEdit"class="control-label">Fecha final</label>
                                    <input class="form-control FechaUnica" id="FechaFinModalEdit" name="FechaFinModalEdit" type="text" placeholder="Fecha" required=""></input>
                                </div>
                                <div class="form-group px-3">
                                    <label for ="HoraFinalModalEdit "class="control-label">Hora final</label>
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input class="form-control" id="HoraFinalModalEdit" name="HoraFinalModalEdit" type="text" placeholder="hora" required=""></input>
                                    </div>    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for ="ColorModalEdit"class="control-label">Color</label>
                                <input class="form-control" id="ColorModalEdit" name="ColorModalEdit" type="color" placeholder="Cantidad de Camas" value="#44ffff" required=""></input>
                            </div>
                            <div class="form-group">
                                <label for ="ObservacionesModalEdit"class="control-label">Observaciones</label>
                                <input class="form-control" id="ObservacionesModalEdit" name="ObservacionesModalEdit" type="text" placeholder="Observaciones" required=""></input>
                            </div>
                            
                    </div>
                    </form>
                </div>
            <!-- </div> -->
      <div class="modal-footer">
          
          <button type="button" class="btn btn-success" id="btnModificarModal">Modificar</button>
          <button type="button" class="btn btn-danger" id="btnBorrarModal">Borrar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para agregar -->
<div class="modal fade" id="modalFormAgregarHorarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalAgregarLabel">Agregar turno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <!-- <div class="tile"> -->
                    <div class="tile-body">
                        <form id="formHorariosAgregar" name="formHorariosAgregar">
                          <p class="text-primary">Todos los campos son obligatorios</p>
<!--                             
                            <input type="hidden" name="idPersonalAgregar" id="idPersonalAgregar" value=""> -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listAgregarServicioid">Servicio</label>
                                    <select class="form-control servicioId" data-live-search="true" id="listAgregarServicioid" name="listAgregarServicioid" required=""></select>

                                </div>
          
                                <div class="form-group col-md-6">
                                    <label for="listAgregarProfesionid">Profesion</label>
                                    <select class="form-control profesionId" data-live-search="true" id="listAgregarProfesionid" name="listAgregarProfesionid" required=""></select>
                                    
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listAgregarNombreid">Nombre</label>
                                    <select class="form-control" data-live-search="true" id="listAgregarNombreid" name="listAgregarNombreid" required="">
                                    <option value='0' disable>-- seleccionar nombre --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row ">
                                <div class="form-group col-md-6">
                                    <label for ="FechaInicialModalAgregar"class="control-label">Fecha incial</label>
                                    <input class="form-control FechaUnica" id="FechaInicialModalAgregar" name="FechaInicialModalAgregar" type="text" placeholder="Fecha" required=""></input>
                                </div>
                                <div class="form-group col-md-6 px-3">
                                    <label for ="HoraInicialModalAgregar"class="control-label">Hora inicial</label>
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input class="form-control UnicaHora" id="HoraInicialModalAgregar" name="HoraInicialModalAgregar" type="text" placeholder="Hora" required=""></input>
                                    </div>                                        
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for ="FechaFinModalAgregar"class="control-label">Fecha final</label>
                                    <input class="form-control FechaUnica" id="FechaFinModalAgregar" name="FechaFinModalAgregar" type="text" placeholder="Fecha" required=""></input>
                                </div>
                                <div class="form-group col-md-6 px-3">
                                    <label for ="HoraFianlModalAgregar"class="control-label">Hora final</label>
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input class="form-control UnicaHora" id="HoraFianlModalAgregar" name="HoraFianlModalAgregar" type="text" placeholder="Hora" required=""></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for ="ColorModalAgregar"class="control-label">Color</label>
                                <input class="form-control" id="ColorModalAgregar" name="ColorModalAgregar" type="color" placeholder="Cantidad de Camas" value="#44ffff" required=""></input>
                            </div>
                            <div class="form-group">
                                <label for ="ObservacionesModalAgregar"class="control-label">Observaciones</label>
                                <input class="form-control" id="ObservacionesModalAgregar" name="ObservacionesModalAgregar" type="text" placeholder="Observaciones" required=""></input>
                            </div>
                            
                    </div>
                    </form>
                </div>
            <!-- </div> -->
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnAgregarModal">Agregar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Generar horarios en un rango de FECHAS -->
<div class="modal fade" id="modalFormGeneerarHorarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalLabel">Generar horarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <!-- <div class="tile"> -->
                    <div class="tile-body">
                        <form id="formHorariosGenerar" name="formHorariosGenerar">
                            <!-- <input type="hidden" name="idHorario" id="idCama" value=""> -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listServicioGenHorId">Servicio</label>
                                    <select class="form-control servicioId" data-live-search="true" id="listServicioGenHorId" name="listServicioGenHorId" required=""></select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="listProfesionGenHorid">Profesion</label>
                                    <select class="form-control profesionId" data-live-search="true" id="listProfesionGenHorid" name="listProfesionGenHorid" required=""></select>
                                    
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listNombreGenHorid">Nombre</label>
                                    <select class="form-control" data-live-search="true" id="listNombreGenHorid" name="listNombreGenHorid" required="">
                                        <option value='0' disable>-- seleccionar nombre --</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listRangoDiasGenHorid">Considerar los dias de la semana: </label>
                                    <select class="form-control" data-live-search="true" id="listRangoDiasGenHorid" name="listRangoDiasGenHorid" required="">
                                        <option value="1">Sabado y domingo</option>
                                        <option value="2">Lunes a viernes</option>
                                        <option value="3">Todos los dias</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6" style="display: none" id="divIntervaloAgregar">
                                    <label for="listIntervaloDiasGenHorid">Dia libre </label>
                                    <select class="form-control" data-live-search="true" id="listIntervaloDiasGenHorid" name="listIntervaloDiasGenHorid" required="">
                                        <option value="1">0</option>
                                        <option value="2">1</option>
                                        <option value="3">2</option>
                                        <option value="4">3</option>    
                                        <option value="5">4</option>    
                                        <option value="6">5</option>    
                                        <option value="7">6</option>    
                                    </select>
                                </div>  
                            </div>
                            <div class="form-row ">
                                <div class="form-group col-md-6">
                                    <label for ="FechaRangoModalGenHor"class="control-label">Rango de fechas</label>
                                    <input class="form-control" id="FechaRangoModalGenHor" name="FechaRangoModalGenHor" type="text" placeholder="Fecha" required=""></input>
                                </div>
                            </div>
                            
                            <div class="form-row ">  
                                <div class="form-group col-md-6">
                                    <label for ="HoraInicioGenerarid"class="control-label">Hora inicial</label>
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input class="form-control UnicaHora" id="HoraInicioGenerarid" name="HoraInicioGenerarid" type="text" placeholder="Hora" required="" value="08:00"></input>
                                    </div>                                        
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label for ="HoraFinGenerarid"class="control-label">Hora final</label>
                                    <div class="input-group clockpicker" data-autoclose="true">
                                        <input class="form-control UnicaHora" id="HoraFinGenerarid" name="HoraFinGenerarid" type="text" placeholder="Hora" required="" value="08:05"></input>
                                    </div>
                                </div>
                            </div>
                           
                            
                            <div class="form-group">
                                <label for ="ColorModalAgregar"class="control-label">Color</label>
                                <input class="form-control" id="ColorModalAgregar" name="ColorModalAgregar" type="color" placeholder="Cantidad de Camas" value="#44ffff" required=""></input>
                            </div>
                            <div class="form-group">
                                <label for ="ObservacionesModalAgregar"class="control-label">Observaciones</label>
                                <input class="form-control" id="ObservacionesModalAgregar" name="ObservacionesModalAgregar" type="text" placeholder="Observaciones" required=""></input>
                            </div>
                            
                    </div>
                    </form>
                </div>
            <!-- </div> -->
      <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnGenerar">Generar</button>
      </div>
    </div>
  </div>
</div>