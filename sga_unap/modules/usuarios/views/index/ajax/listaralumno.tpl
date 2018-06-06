   <div id="listaralumno" >
                {if isset($estudiantes) && count($estudiantes)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th style=" text-align: center">Nombres / Apellidos </th>
                                <th style=" text-align: center">Codigo Universitario</th>         
                                <th style=" text-align: center">Curricula / Resolucion</th>
                                <th style=" text-align: center">
                                Estado
                                </th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">
                                {$lenguaje.label_opciones}
                                </th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$estudiantes}
                            <tr {if $rl.Row_Estado==0}
                                            {if $_acl-> permiso("ver_eliminados")}
                                            class="btn-danger"
                                            {else}
                                            hidden {$numeropagina=$numeropagina-1}
                                            {/if}
                                            {/if}>
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td style=" text-align: center">{$rl.Usu_Nombre}  {$rl.Usu_Apellidos} </td> 
                                    <td style=" text-align: center">{$rl.Dea_CodigoUniversitario}</td>
                                    <td style=" text-align: center">{$rl.Cui_Nombre} - {$rl.Cui_Resolucion}</td> 
                                <td style=" text-align: center">
                                {if $rl.Dea_Estado==0}
                                <p class="glyphicon glyphicon-remove-sign" data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;">
                                </p>
                                {/if}
                                {if $rl.Dea_Estado==1}
                                <p class="glyphicon glyphicon-ok-sign" data-placement="bottom" data-toggle="tooltip" style="color: #088A08;">
                                </p>
                                {/if}
                            </td> 
                            {if $_acl->permiso("editar_rol")}
                            <td style=" text-align: center">
                                <a class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-alumno" data-placement="bottom" data-toggle="tooltip" estado="{$rl.Dea_Estado}" id_detallealumno="{$rl.Dea_IdDetalleAlumno}" title="cambiar estado">
                                </a>
                                <a class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}usuarios/index/editaralumno/{$rl.Dea_IdDetalleAlumno}" title="editar">
                                </a>

                                <a {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-alumno" title="Habilitar  " 
                                        {else}
                                            data-book-id="{$rl.Dea_CodigoUniversitario}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-alumno" title=" eliminar "
                                        {/if} 
                                        id_detallealumno="{$rl.Dea_IdDetalleAlumno}" data-placement="bottom">
                                </a>
                            </td>
                            {/if} 
                            </tr>
                           {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}
                   {else}            
                {/if}  
            </div>