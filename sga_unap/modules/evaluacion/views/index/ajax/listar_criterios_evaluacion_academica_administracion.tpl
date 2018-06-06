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