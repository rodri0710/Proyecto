<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" name="#formUsuario" class="form-horizontal">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="">
                    <p class="text-primary">Todos los campos son obligatorios.</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="txtIdentificacion">Identificacion</label>
                            <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" disabled="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="txtNombres">Nombres</label>
                            <input type="text" class="form-control" id="txtNombres" name="txtNombres" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="txtApellidoPaterno">Apellido Paterno</label>
                            <input type="text" class="form-control" id="txtApellidoPaterno" name="txtApellidoPaterno" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="txtApellidoMaterno">Apellido materno</label>
                            <input type="text" class="form-control" id="txtApellidoMaterno" name="txtApellidoMaterno" required="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="txtEmail">Email</label>
                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txtContrasena">Contraseña</label>
                            <input type="password" class="form-control" id="txtContrasena" name="txtContrasena">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listProfesionid">Profesion</label>
                            <select class="form-control" data-live-search="true" id="listProfesionid" name="listProfesionid" required=""></select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listRolid">Rol</label>
                            <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required=""></select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listServicioid">Servicio</label>
                            <select class="form-control" data-live-search="true" id="listServicioid" name="listServicioid" required=""></select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listGrupoid">Grupo</label>
                            <select class="form-control" data-live-search="true" id="listGrupoid" name="listGrupoid" required=""></select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6 animated-checkbox">

                            <div class="toggle lg">
                                <label for="txtHabilitado"> Habilitar
                                    <input type="checkbox" id="txtHabilitado" name="txtHabilitado" value="si"><span class="button-indecator"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                Guardar</span></button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i><span id="btnText">
                                Cerrar</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal ver datos de usuario -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos del personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><span>ID personal</span> </td>
                                <td id="celIdentificacion">25</td>
                            </tr>
                            <tr>
                                <td><span></span> Nombres</td>
                                <td id="celNombres">25</td>
                            </tr>
                            <tr>
                                <td>Apellido Paterno</td>
                                <td id="celApellidoPaterno">25</td>
                            </tr>
                            <tr>
                                <td>Apellido Materno</td>
                                <td id="celApellidoMaterno">25</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td id="celEmail">25</td>
                            </tr>
                            <tr>
                                <td>Servicio</td>
                                <td id="celServicio">25</td>
                            </tr>
                            <tr>
                                <td>Grupo</td>
                                <td id="celGrupo">25</td>
                            </tr>
                            <tr>
                                <td>Rol</td>
                                <td id="celRol">25</td>
                            </tr>
                            <tr>
                                <td>Habilitado</td>
                                <td id="celHabilitado">25</td>
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