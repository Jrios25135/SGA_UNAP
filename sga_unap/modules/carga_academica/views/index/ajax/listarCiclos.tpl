{if isset($listaDatos) && count($listaDatos)}
<div class="table-responsive">
    <table class="table" style="  margin: 20px auto">
        <tr>
            <th style=" text-align: center">
                {$lenguaje.label_n}
            </th>
            <th>
                Nombre
            </th>
            <th>
                Número
            </th>
            <th style=" text-align: center">
                {$lenguaje.label_estado}
            </th>
            {if $_acl->permiso("editar_rol")}
            <th style=" text-align: center">
                {$lenguaje.label_opciones}
            </th>
            {/if}
        </tr>
        {foreach item=rl from=$listaDatos}
        <tr $_acl-="" $rl.row_estado="0}" {if="">
            permiso("ver_eliminados")}
                            class="btn-danger"
                        {else}
                            hidden {$numeropagina = $numeropagina-1}
                        {/if}
                    {/if} >
            <td style=" text-align: center">
                {$numeropagina++}
            </td>
            <td>
                {$rl.Cic_Nombre|default:" - "}
            </td>
            <td>
                {$rl.Cic_Numero|default:" - "}
            </td>
            <td style=" text-align: center">
                {if $rl.Cic_Estado==0}
                <p class="glyphicon glyphicon-remove-sign " data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;" title="{$lenguaje.label_denegado}">
                </p>
                {/if}                            
                        {if $rl.Cic_Estado==1}
                <p class="glyphicon glyphicon-ok-sign " data-placement="bottom" data-toggle="tooltip" style="color: #088A08;" title="{$lenguaje.label_habilitado}">
                </p>
                {/if}
            </td>
            {if $_acl->permiso("editar_rol")}
            <td style=" text-align: center">
                <a class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-registro" data-placement="bottom" data-toggle="tooltip" estado="{$rl.Cic_Estado}" id_registro="{$rl.Cic_IdCiclo}" title="{$lenguaje.tabla_opcion_cambiar_est}">
                </a>
                <a "="" class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}carga_academica/index/editarciclo/{$rl.Cic_IdCiclo}" title="Editar Registro">
                </a>
                <a $rl.row_estado="0}" class="btn btn-default btn-sm glyphicon glyphicon-trash confirmar-eliminar-registro" data-book-id="{$rl.Cic_Nombre}" data-placement="bottom" data-target="#confirm-delete" data-toggle="modal" id_registro="{$rl.Cic_IdCiclo}" if}="" title="{$lenguaje.label_eliminar}" {="" {else}="" {if="">
                </a>
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