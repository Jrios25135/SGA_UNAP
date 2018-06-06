<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">Reporte Ficha de Evaluación de desempeño</h4>
    </div>    
    <div class="panel panel-default">        
        <div class="panel-body" style=" margin: 5px">                        
            <div id="listarReportesEvaluaciones" >
                {if isset($reportes_evaluaciones) && count($reportes_evaluaciones)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">N°</th>
                                <th >Semestre</th>                                
                                <th >Docente</th>                                
                                <th >Curso</th>                               
                                <th >Ptj. Inicio</th>                                 
                                <th >Ptj. Desarrollo</th>                                 
                                <th >Ptj. Fin</th>                                 
                                <th >Ptj. Total</th>            
                                <th >Explorar</th>                                                                                                                  
                            </tr>
                            {foreach item=rep from=$reportes_evaluaciones}
                                <tr {if $rep.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rep.Sem_Numero}</td>                                    
                                    <td>{$rep.Per_Nombre}</td>                                    
                                    <td>{$rep.Cur_Nombre}</td>                                    
                                    <td style=" text-align: center">
                                        {if $rep.Evd_Estado==0}
                                            <p data-toggle="tooltip" data-repcement="bottom" class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                                        {/if}                            
                                        {if $rep.Evd_Estado==1}
                                            <p data-toggle="tooltip" data-repcement="bottom" class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                                        {/if}
                                    </td>
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <a data-toggle="tooltip" data-repcement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-rol" title="{$lenguaje.tabla_opcion_cambiar_est}" id_rol="{$rep.Psa_IdPlanificacionSesionAprendizaje}" estado="{$rep.Psa_Estado}"> </a>
                                        
                                        <a data-toggle="tooltip" data-repcement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="Editar repnificación" href="{$_layoutParams.root}evaluacion/index/editarPlanificacion/{$rep.Psa_IdPlanificacionSesionAprendizaje}"></a>

                                        <a data-toggle="tooltip" data-repcement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="Editar permisos" href="{$_layoutParams.root}acl/index/permisos_role/{$rep.Psa_IdPlanificacionSesionAprendizaje}"></a>

                                        <a   
                                        {if $rep.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-rol" title="{$lenguaje.label_habilitar}" 
                                        {else}
                                            data-book-id="{$rep.Psa_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="Eliminar"
                                        {/if} 
                                        id_rol="{$rep.Psa_IdPlanificacionSesionAprendizaje}" data-repcement="bottom" > </a>

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
                <p>Eliminar: <strong  class="nombre-es">Rol</strong></p>
                <label id="texto_" name='texto_'></label>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_rol">Eliminar</a>
            </div>
        </div>
    </div>
</div>