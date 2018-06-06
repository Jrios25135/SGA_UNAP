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