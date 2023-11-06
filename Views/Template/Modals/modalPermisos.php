<!-- Extra large modal -->

<div class="modal fade modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4"> Permisos Roles de usuario </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <?php depurar($data);?> -->
                <div class="col-md-12">
                    <div class="tile">
                        <form action="" id="formPermisos" name="formPermisos" >
                            <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol'] ?>" required="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Modulo</th>
                                            <th>Ver</th>
                                            <th>Crear</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            $modulos = $data['modulos'];
                                            for($i=0;$i<count($modulos);$i++){
                                                $permisos = $modulos[$i]['permisos'];
                                                $rCheck = $permisos['r']==1? " checked ": "";
                                                $wCheck = $permisos['w']==1? " checked ": "";
                                                $uCheck = $permisos['u']==1? " checked ": "";
                                                $dCheck = $permisos['d']==1? " checked ": "";

                                                $idmod = $modulos[$i]['IDmodulo'];
                                            
                                        ?>
                                        <tr>
                                            <td>
                                                <?=$no;?>
                                                <input type="hidden" name="modulos[<?= $i; ?>][IDmodulo]" value="<?= $idmod; ?>" required ></input>
                                            </td>
                                            <td>
                                                <?= $modulos[$i]['NombreModulo'];?>
                                            </td>
                                            <td>
                                                <div class="toggle lg">
                                                    <label>
                                                        <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck?> ><span class="button-indecator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="toggle lg">
                                                    <label>
                                                        <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck?>><span class="button-indecator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="toggle lg">
                                                    <label>
                                                        <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck?> ><span class="button-indecator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="toggle lg">
                                                    <label>
                                                        <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck?> ><span class="button-indecator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-circle-check"></i> Guardar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa-solid fa-right-from-bracket"></i> Salir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>