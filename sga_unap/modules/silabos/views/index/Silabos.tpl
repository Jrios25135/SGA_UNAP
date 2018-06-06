<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRACIÓN DE SILABOS</h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BUSCAR SILABOS</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="{$lenguaje.text_buscar_rol}" style="width: 150px; float: left; margin: 0px 10px;" name="palabraBusqueda" id="palabraBusqueda">
                    <button class="btn btn-success" style=" float: left" type="button" id="btnBuscarRegistros"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}carga_academica/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>LISTA DE SILABOS</b></h4>
            <input type="hidden" name="formulario" id="formulario" value="{$formulario}">
            <div id="listar{$formulario}" >
                {if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >Curso </th>
                                <th >Docente </th>
                                <th style=" text-align: center">Grupo</th>
                                <th style=" text-align: center">{$lenguaje.label_estado}</th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
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
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rl.Cur_Nombre}</td>
                                    <td>{$rl.Usu_Nombre}</td>
                                    <td>{$rl.Caa_Grupo}</td>
                                    {if $rl.Usu_IdUsuario==$usuario}
                                    <td style=" text-align: center">
                                        {if $rl.Sil_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                                        {/if}                            
                                        {if $rl.Sil_Estado==1}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                                        {/if}
                                    </td>
                                    {else}
                                    <td>
                                    </td>
                                    {/if}
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">

                                        {if $rl.Usu_IdUsuario==$usuario}
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-registro" title="{$lenguaje.tabla_opcion_cambiar_est}" id_registro="{$rl.Sil_IdSilabo}" estado="{$rl.Sil_Estado}"> </a>
                                        
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" {if $rl.Sil_IdSilabo==null} class="btn btn-default btn-sm glyphicon glyphicon-edit"  title="Registrar Silabo" href="{$_layoutParams.root}silabos/index/registrarSilabo/{$rl.Caa_IdCargaAcademica}"
                                        {else}class="btn btn-default btn-sm glyphicon glyphicon-pencil" title="Editar Silabo" href="{$_layoutParams.root}silabos/index/editarSilabo/{$rl.Sil_IdSilabo}"
                                        {/if}
                                        ></a>

                                       <!--  <a   
                                        {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-registro" title="{$lenguaje.label_habilitar}" 
                                        {else}
                                            data-book-id="{$rl.Cur_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-registro" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_registro="{$rl.Sil_IdSilabo}" data-placement="bottom" > </a> -->

                                        {/if}
                                        {if $rl.Sil_Estado==1}
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-eye-open"  title="Ver Silabo" href="{$_layoutParams.root}silabos/index/verSilabo/{$rl.Sil_IdSilabo}"></a>
                                        {/if}
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
        </div>
    </div>
</div>

<div class="modal " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminación</h4>
            </div>
            <div class="modal-body">
                <p>Estás a punto de borrar un item, este procedimiento es irreversible</p>
                <p>¿Deseas Continuar?</p>
                <p>Eliminar: <strong  class="nombre-es">Silabo del curso</strong></p>
                <label id="texto_" name='texto_'></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_registro">Eliminar</a>
            </div>
        </div>
    </div>
</div>