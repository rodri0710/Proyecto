<!-- Modal -->
<div class="modal fade" id="modalFormServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formServicio" name="formServicio">
                            <input type="hidden" name="idServicio" id="idServicio" value="">
                            <div class="form-group">
                                <label class="control-label">Cantidad de Servicios</label>
                                <input class="form-control" id="cantServicios" name="cantServicios" type="text" placeholder="Cantidad de Servicio" required=""></input>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                    <p  class="text-primary mt-4">*Al GUARDAR se eliminaran todos los datos de la infraestructura.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal para ver datos de servicio -->
<div class="modal fade" id="modalViewServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><span>ID servicio</span> </td>
                                <td id="celIdentificacion">25</td>
                            </tr>
                            <tr>
                                <td><span></span> Nombre </td>
                                <td id="celNombre"></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td id="celDescripcion"></td>
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
<div class="modal fade" id="modalFormEditServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <form id="formServicioEdit" name="formServicioEdit">
                            <input type="hidden" name="idServicioEdit" id="idServicioEdit" value="">
                            
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" id="txtNombreEdit" name="txtNombreEdit" type="text" placeholder="Nombre de Servicio" required=""></input>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripcion</label>
                                <textarea class="form-control" id="txtDescripcionEdit" name="txtDescripcionEdit" rows="2" placeholder="Descripcion de Servicio" required=""></textarea>
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