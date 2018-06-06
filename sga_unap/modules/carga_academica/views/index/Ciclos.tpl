<div class="container-fluid">
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">
            ADMINISTRACIÓN DE CICLOS
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
                    NUEVA CICLO
                </strong>
            </h3>
        </div>
        <div aria-expanded="false" class="panel-collapse collapse" id="collapse3" style="height: 0px;">
            <div class="panel-body" id="nuevo_rol" style="width: 90%; margin: 0px auto">
                <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Nombre :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Nombre Ciclo" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Número :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoNumero" name="nuevoNumero" placeholder="Numero de  Ciclo" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Escuela :
                        </label>
                        <div class="col-lg-10">
                            {if  isset($escuelas) && count($escuelas)}
                            <select class="form-control" id="nuevoSelEscuela" name="nuevoSelEscuela" required="">
                                <option value="">
                                    Seleccionar Escuela
                                </option>
                                {foreach from=$escuelas item=r}
                                <option value="{$r.Esc_IdEscuela}">
                                    {$r.Esc_Nombre}
                                </option>
                                {/foreach}
                            </select>
                            {else} No hay datos para mostrar...!!!
                            {/if}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" id="bt_guardarNuevo" name="bt_guardarNuevo" type="submit">
                                <i class="glyphicon glyphicon-floppy-disk">
                                </i>
                                {$lenguaje.button_ok}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {/if}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="glyphicon glyphicon-list-alt">
                </i>
                <strong>
                    BUSCAR CICLO
                </strong>
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" id="palabraBusqueda" name="palabraBusqueda" placeholder="Buscar" style="width: 150px; float: left; margin: 0px 10px;">
                        <button class="btn btn-success" id="btnBuscarRegistros" style=" float: left" type="button">
                            <i class="glyphicon glyphicon-search">
                            </i>
                        </button>
                    </input>
                </div>
                <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}carga_academica/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title">
                <b>
                    LISTA DE CICLOS
                </b>
            </h4>
            <input id="formulario" name="formulario" type="hidden" value="{$formulario}">
                <div id="listar{$formulario}">
                    {if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">
                                    {$lenguaje.label_n}
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Número
                                </th>
                                <th style=" text-align: center">
                                    {$lenguaje.label_estado}
                                </th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">
                                    {$lenguaje.label_opciones}
                                </th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$listaDatos}
                            <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                <td style=" text-align: center">
                                    {$numeropagina++}
                                </td>
                                <td>
                                    {$rl.Cic_Nombre|default:" - "}
                                </td>
                                <td>
                                    {$rl.Cic_Numero|default:" - "}
                                </td>
                                <td style=" text-align: center">
                                    {if $rl.Cic_Estado==0}
                                    <p class="glyphicon glyphicon-remove-sign " data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;" title="{$lenguaje.label_denegado}">
                                    </p>
                                    {/if}                            
                                        {if $rl.Cic_Estado==1}
                                    <p class="glyphicon glyphicon-ok-sign " data-placement="bottom" data-toggle="tooltip" style="color: #088A08;" title="{$lenguaje.label_habilitado}">
                                    </p>
                                    {/if}
                                </td>
                                {if $_acl->permiso("editar_rol")}
                                <td style=" text-align: center">
                                    <a class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-registro" data-placement="bottom" data-toggle="tooltip" estado="{$rl.Cic_Estado}" id_registro="{$rl.Cic_IdCiclo}" title="{$lenguaje.tabla_opcion_cambiar_est}">
                                    </a>
                                    <a class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}carga_academica/index/editarciclo/{$rl.Cic_IdCiclo}" title="Editar Registro">
                                    </a>
                                    <a {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-rol" title="{$lenguaje.label_habilitar}  " 
                                        {else}
                                            data-book-id="{$rl.Cur_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_rol="{$rl.Cur_IdCurso}" data-placement="bottom">
                                    </a>
                                </td>
                                {/if}
                            </tr>
                            {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}
                {else}
                    {$lenguaje.no_registros}
                {/if}
                </div>
            </input>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal " id="confirm-delete" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Confirmación de Eliminación
                </h4>
            </div>
            <div class="modal-body">
                <p>
                    Estás a punto de borrar un item, este procedimiento es irreversible
                </p>
                <p>
                    ¿Deseas Continuar?
                </p>
                <p>
                    Eliminar:
                    <strong class="nombre-es">
                        Registro
                    </strong>
                </p>
                <label id="texto_" name="texto_">
                </label>
                <!-- <input type='text' class='form-control' name='codigo' id='validate-number' placeholder='Codigo' required> -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    Cancelar
                </button>
                <a class="btn btn-danger danger eliminar_registro" data-dismiss="modal" style="cursor:pointer">
                    Eliminar
                </a>
            </div>
        </div>
    </div>
</div>
