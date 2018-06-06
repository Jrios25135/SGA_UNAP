<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">Administrar ficha de evaluación académica</h4>
    </div>

    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>NUEVO CRITERIO DE EVALUACION ACADEMICA</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_criterio" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >  
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Criterio : </label>
                            <div class="col-lg-10">
                                <input class="form-control" id="nuevo_critero"  type="text" name="nuevo_criterio" placeholder="Cumple con el desarrollo del Silabus en su totalidad" required="" />
                             </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success" type="submit" id="bt_guardar_criterio" name="bt_guardar_criterio" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Guardar</button>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select class="form-control" name="tipos_criterio_evaluacion" id="tipos_criterio_evaluacion">
                                <option value="null">--Seleccione--</option>
                                {if isset($tipos_criterio_evaluacion) && count($tipos_criterio_evaluacion)}
                                {foreach item=tip from=$tipos_criterio_evaluacion}
                             <option value="{$tip.Tce_IdTipoCriterioEvaluacionAcademica|default:0}">{$tip.Tce_Nombre}</option>
                                {/foreach}
                                {/if}
                            </select>
                        </div>                        
                    </div>                        
                </form>
            </div>
        </div>
    </div>
    {/if}

    <div class="panel panel-default">                             
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BUSCAR ITEM DE FICHA</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="Buscar item" style="width: 150px; float: left; margin: 0px 10px;" name="palabra_criterio" id="palabra_criterio">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscar_criterio_evaluacion_academica_administracion"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>            
            </div>
            <h4 class="panel-title"> <b>LISTA DE CRITERIOS</b></h4>
                            
            <div id="listar_criterios_evaluacion_academica_administracion" >
                {if isset($criterios_evaluacion_academica_administracion) && count($criterios_evaluacion_academica_administracion)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">N°</th>
                                <th>Criterio</th>                         
                                <th>Tipo</th>           
                                <th>Estado</th>                       
                                <th>Opciones</th>                       
                            </tr>
                            {$contador=1}
                            {foreach item=cri from=$criterios_evaluacion_academica_administracion}
                                <tr {if $cri.Row_Estado==0}
                                        
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$cri.Cea_Nombre}</td>                  
                                    <td>{$cri.Tce_Nombre}</td>                                                     <td style=" text-align: center">
                                        {if $cri.Cea_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign " title="Denegado" style="color: #DD4B39;"></p>
                                        {/if}                            
                                        {if $cri.Cea_Estado==1}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign " title="Habilitado" style="color: #088A08;"></p>
                                        {/if}
                                    </td>    
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-criterio-evaluacion-academica" title="Cambiar estado" id_criterio="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}" estado="{$cri.Cea_Estado}"> </a>
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="Editar criterio" href="{$_layoutParams.root}evaluacion/index/editarCriterioEvaluacionAcademica/{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}"></a>

                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="{$lenguaje.tabla_opcion_editar_permisos}" href="{$_layoutParams.root}acl/index/permisos_role/{$cri.Rol_IdRol}"></a>

                                        <a   
                                        {if $cri.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-criterio-evaluacion-academica" title="Habilitar" 
                                        {else}
                                            data-book-id="{$cri.Cea_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-criterio-evaluacion-academica" title="Eliminar"
                                        {/if} 
                                        id_criterio="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}" data-placement="bottom" > </a>

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
    </form>         

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
                <p>Eliminar: <strong  class="nombre-es">Criterio</strong></p>
                <label id="texto_" name='texto_'></label>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_criterio_evaluacion_academica">Eliminar</a>
            </div>
        </div>
    </div>
</div>