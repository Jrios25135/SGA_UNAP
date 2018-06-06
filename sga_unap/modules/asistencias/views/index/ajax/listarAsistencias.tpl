{if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >Curso </th>
                                <th style=" text-align: center">Grupo</th>
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
                                    {if $rl.Usu_IdUsuario==$usuario}
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rl.Cur_Nombre}</td>
                                    <td>{$rl.Caa_Grupo}</td> 
                                    
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">                                     
                                        
                                        <a data-toggle="tooltip" data-placement="bottom"  class="btn btn-default btn-sm glyphicon glyphicon-edit"  title="Registrar Asistencia" href="{$_layoutParams.root}asistencias/index/registrarAsistencia/{$rl.Caa_IdCargaAcademica}"></a>

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

                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-eye-open"  title="Ver Asistencias" href="{$_layoutParams.root}asistencias/index/verAsistencia/{$rl.Caa_IdCargaAcademica}"></a>
                                    </td>
                                    {/if}
                                    {/if}
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}
                {else}
                    {$lenguaje.no_registros}
                {/if}       