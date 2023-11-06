<!-- Modal -->
<div class="modal fade" id="modalFormSanitario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevas Camas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formSanitario" name="formSanitario">
                            <input type="hidden" name="idSanitario" id="idSanitario" value="">
                            <P class="text-primary">Primero debes seleccionar servicio</P>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listServicioid">Servicio</label>
                                    <select class="form-control" data-live-search="true" id="listServicioid" name="listServicioid" required=""></select>
                                    
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="listHabitacionid">Habitación</label>
                                    <select class="form-control" data-live-search="true" id="listHabitacionid" name="listHabitacionid" required=""></select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for ="cantSanitarios"class="control-label">Cantidad de Sanitario</label>
                                <input class="form-control" id="cantSanitarios" name="cantSanitarios" type="text" placeholder="Cantidad de Sanitarios" required=""></input>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal para ver datos de Hbitacion -->
<div class="modal fade" id="modalViewSanitario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de Sanitario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><span>ID</span> </td>
                                <td id="celIdentificacion"></td>
                            </tr>
                            <tr>
                                <td><span></span> Nombre </td>
                                <td id="celNombre"></td>
                            </tr>
                            <tr>
                                <td><span></span> Habitacion </td>
                                <td id="celHabitacion"></td>
                            </tr>
                            <tr>
                                <td><span></span> Servicio </td>
                                <td id="celServicio"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar servicio -->
<div class="modal fade" id="modalFormEditSanitario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Actualizar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formSanitarioEdit" name="formSanitarioEdit">
                            <input type="hidden" name="idSanitarioEdit" id="idSanitarioEdit" value="">
                            <div class="form-group">
                                <label class="control-label">ID</label>
                                <input class="form-control" id="txtIdEdit" name="txtIdEdit" type="text" disabled="" required=""></input>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" id="txtNombreEdit" name="txtNombreEdit" type="text" placeholder="Nombre de cuarto" required=""></input>
                            </div>

                    </div>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Actualizar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>