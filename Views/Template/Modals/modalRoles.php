<!-- Modal -->
<div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formRol" name="formRol">
                            <input type="hidden" name="idRol" id="idRol" value="">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de rol" required=""></input>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Descripcion</label>
                                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripcion de Grupo" required=""></textarea>
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

