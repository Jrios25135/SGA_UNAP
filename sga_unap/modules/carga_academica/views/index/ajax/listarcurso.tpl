             <div id="listarCurso" >
                {if isset($curso) && count($curso)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                              <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th > Codigo / Nombre de curso </th>
                                <th style=" text-align: center">Creditos</th>
                                <th style=" text-align: center">Horas Teoria</th>
                                <th style=" text-align: center">Horas Practica</th>
                                <th style=" text-align: center">Duracion del Curso/Semanas </th>
                                <th style=" text-align: center">Ciclo</th>
                                <th style=" text-align: center">Tipo de Curso</th>
                                <th style=" text-align: center">Escuela Profesional</th>
                                <th style=" text-align: center">Plan de Estudios</th>
                                <th style=" text-align: center">Estado</th>
                               
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$curso}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td >{$rl.Cur_Codigo} - {$rl.Cur_Nombre}</td>
                                    <td style=" text-align: center">{$rl.Cur_Creditos}</td>
                                    <td style=" text-align: center">{$rl.Cur_HorasTeoria}</td>
                                    <td style=" text-align: center">{$rl.Cur_HorasPractica}</td>
                                    <td style=" text-align: center">{$rl.Cur_Semanas}</td>
                                    <td style=" text-align: center">{$rl.Cic_Nombre}</td>
                                    <td style=" text-align: center">{$rl.Cur_Tipo}</td>
                                    <td style=" text-align: center">{$rl.Esc_Nombre}</td> 
                                    <th style=" text-align: center">{$rl.Cui_Resolucion}</th> 
                                    <td style=" text-align: center">
                                            {if $rl.Cur_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" style="color: #DD4B39;"></p>
                                            {/if}
                                            {if $rl.Cur_Estado==1}
                                             <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" style="color: #088A08;"></p>
                                             {/if}
                                        </td>
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-rol" title="{$lenguaje.tabla_opcion_cambiar_est}" id_rol="{$rl.Cur_IdCurso}" estado="{$rl.Cur_Estado}"
                                        ></a>
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="editar" href="{$_layoutParams.root}carga_academica/index/editarCurso/{$rl.Cur_IdCurso}"></a>

                                      <!--   <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="{$lenguaje.tabla_opcion_editar_permisos}" href="{$_layoutParams.root}acl/index/permisos_role/{$rl.Rol_IdRol}"></a> -->

                                        <a   
                                        {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-rol" title="{$lenguaje.label_habilitar}  " 
                                        {else}
                                            data-book-id="{$rl.Cur_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_rol="{$rl.Cur_IdCurso}" data-placement="bottom" > </a>

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
                <script type="text/javascript">
                    mensaje({$_mensaje_json});
                </script>