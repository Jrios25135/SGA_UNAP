<div id="listardocente">
    {if isset($docentes) && count($docentes)}
    <div class="table-responsive">
        <table class="table" style="  margin: 20px auto">
            <tr>
                <th style=" text-align: center">
                    {$lenguaje.label_n}
               <th style=" text-align: center">
                                Nombres / Apellido
                            </th>
                            <th style=" text-align: center">
                                Grado Academico
                            </th>
                            <th style=" text-align: center">
                                Condicion
                            </th>
                            <th style=" text-align: center">
                                Dedicacion
                            </th>
                            <th style=" text-align: center">
                                Categoria
                            </th>
                            <th style=" text-align: center">
                                Cargo
                            </th>
                            <th style=" text-align: center">
                                Escuela Profesional
                            </th>
                <th style=" text-align: center">
                    Estado
                </th>
                {if $_acl->permiso("editar_rol")}
                <th style=" text-align: center">
                    {$lenguaje.label_opciones}
                </th>
                {/if}
            </tr>
            {foreach item=rl from=$docentes}
            <tr {if $rl.Row_Estado==0}
                        {if $_acl-> permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                <td style=" text-align: center">
                    {$numeropagina++}
                </td>
                <td style=" text-align: center">
                                {$rl.Usu_Nombre}   {$rl.Usu_Apellidos}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_GradoAcademico}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_Condicion}
                            </td>
                             <td style=" text-align: center">
                                {$rl.Ded_Dedicacion}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_Categoria}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Ded_Cargo}
                            </td>
                            <td style=" text-align: center">
                                {$rl.Esc_Nombre}
                            </td>
                <td style=" text-align: center">
                    {if $rl.Ded_Estado==0}
                    <p class="glyphicon glyphicon-remove-sign" data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;">
                    </p>
                    {/if}
                     {if $rl.Ded_Estado==1}
                    <p class="glyphicon glyphicon-ok-sign" data-placement="bottom" data-toggle="tooltip" style="color: #088A08;">
                    </p>
                    {/if}
                </td>
                {if $_acl->permiso("editar_rol")}
             <td style=" text-align: center">
                                <a data-toggle="tooltip"  data-placement="bottom"  class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-docente"   title="cambiar estado " id_detalledocente="{$rl.Ded_IdDetalleDocente}" estado="{$rl.Ded_Estado}">
                                </a>
                                <a class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}usuarios/index/editardocente/{$rl.Ded_IdDetalleDocente}" title="editar">
                                </a>
                               <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="Seguro de Eliminar ?" href="{$_layoutParams.root}acl/index/permisos_role/{$rl.Rol_IdRol}"></a> 
                                <a {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-docente" title="Habilitar " 
                                        {else}
                                            data-book-id="{$rl.Ded_GradoAcademico}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-docente" title="Eliminar "
                                        {/if} 
                                        id_detalledocente="{$rl.Ded_IdDetalleDocente}" data-placement="bottom">
                                </a>
                 </td>
                {/if}
            </tr>
            {/foreach}
        </table>
    </div>
    {$paginacion|default:""}
                {else}
                    No hay Registros
                {/if}
</div>