{if isset($escuelas) && count($escuelas)}
    <div class="table-responsive">
        <table class="table" style="  margin: 20px auto">
            <tr>
                <th style=" text-align: center">{$lenguaje.label_n}</th>
                <th >Nombre</th>
                <th >Direccion</th>
                <th >Teléfono</th>
                <th >Facultad</th>
                <th style=" text-align: center">{$lenguaje.label_estado}</th>
                {if $_acl->permiso("editar_rol")}
                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                {/if}
            </tr>
            {foreach item=rl from=$escuelas}
                <tr>
                    <td style=" text-align: center">{$numeropagina++}</td>
                    <td>{$rl.Esc_Nombre}</td>
                    <td>{$rl.Esc_Direccion}</td>
                    <td>{$rl.Esc_Telefono}</td>
                    <td>{$rl.Fac_Nombre}</td>
                    <td style=" text-align: center">
                        {if $rl.Esc_Estado==0}
                            <p class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                        {/if}                            
                        {if $rl.Esc_Estado==1}
                            <p class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                        {/if}
                    </td>
                    {if $_acl->permiso("editar_rol")}
                    <td style=" text-align: center">
                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-pencil" title="Editar Reino" href="{$_layoutParams.root}carga_academica/index/editarEscuela/{$rl.Esc_IdEscuela}"></a>
                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh" title="{$lenguaje.tabla_opcion_cambiar_est}" href="{$_layoutParams.root}carga_academica/index/_cambiarEstadoEscuela/{$rl.Esc_IdEscuela}/{$rl.Esc_Estado}"></a>
                       <!--  <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-trash" title="{$lenguaje.label_eliminar}" href="{$_layoutParams.root}carga_academica/index/_eliminarReino/{$rl.Esc_IdEscuela}"></a> -->
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