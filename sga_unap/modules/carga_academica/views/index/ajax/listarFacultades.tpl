{if isset($listaDatos) && count($listaDatos)}
    <div class="table-responsive">
        <table class="table" style="  margin: 20px auto">
            <tr>
                <th style=" text-align: center">{$lenguaje.label_n}</th>
                <th >Nombre </th>
                <th >Dirección </th>
                <th style=" text-align: center">Teléfono</th>
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
                    <td>{$rl.Fac_Nombre}</td>
                    <td>{$rl.Fac_Direccion|default:" - "}</td>
                    <td>{$rl.Fac_Telefono|default:" - "}</td>
                    <td style=" text-align: center">
                        {if $rl.Fac_Estado==0}
                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                        {/if}                            
                        {if $rl.Fac_Estado==1}
                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                        {/if}
                    </td>
                    {if $_acl->permiso("editar_rol")}
                    <td style=" text-align: center">
                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-registro" title="{$lenguaje.tabla_opcion_cambiar_est}" id_registro="{$rl.Fac_IdFacultad}" estado="{$rl.Fac_Estado}"> </a>
                        
                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="{$lenguaje.tabla_opcion_editar_rol}" href="{$_layoutParams.root}{$_layoutParams.modulo}/{$_layoutParams.controlador}/editar{$formulario}/{$rl.Fac_IdFacultad}"></a>

                        <a   
                        {if $rl.Row_Estado==0}
                            data-toggle="tooltip" 
                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-registro" title="{$lenguaje.label_habilitar}" 
                        {else}
                            data-book-id="{$rl.Fac_Nombre}"
                            data-toggle="modal"  data-target="#confirm-delete"
                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-registro" title="{$lenguaje.label_eliminar}"
                        {/if} 
                        id_registro="{$rl.Fac_IdFacultad}" data-placement="bottom" > </a>

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


<script type="text/javascript">
    mensaje({$_mensaje_json});
</script>