<div class="container-fluid">
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">
            Administrar Ciclo
        </h4>
    </div>
    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" class="panel-title collapsed" data-toggle="collapse" href="#collapse3">
                <i class="fa fa-ellipsis-v" style="float:right">
                </i>
                <i class="fa fa-user-secret">
                </i>
                <strong>
                    EDITAR CICLO
                </strong>
            </h3>
        </div>
        <div aria-expanded="false" class="panel-collapse collapse" id="collapse3" style="height: 0px;">
            <div class="panel-body" id="editarciclo" style="width: 90%; margin: 0px auto">
                <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                    <input id="Cic_IdCiclo" name="Cic_IdCiclo" type="hidden" value="{$datos.Cic_IdCiclo}"/>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Nombre :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Nombre Ciclo" required="" type="text" value="{$datos.Cic_Nombre}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Número :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoNumero" name="nuevoNumero" placeholder="Numero de  Ciclo" required="" type="text" value="{$datos.Cic_Numero}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" id="bt_editarciclo" name="bt_editarciclo" type="submit">
                                <i class="glyphicon glyphicon-floppy-disk">
                                </i>
                                {$lenguaje.button_ok}
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-danger" id="bt_cancelareditarciclo" name="bt_cancelareditarciclo" type="submit">
                                <i class="glyphicon glyphicon-remove">
                                </i>
                                {$lenguaje.button_cancel}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {/if}
</div>