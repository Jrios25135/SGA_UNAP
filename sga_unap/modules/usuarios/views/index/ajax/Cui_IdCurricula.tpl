<option value="0">Seleccione</option>
{if isset($curri) && count($curri)}
{foreach item=r from=$curri}
<option value="{$r.Cui_IdCurricula|default:0}" >{$r.Cui_Resolucion|default:"Seleccionar"}</option>
{/foreach} 
{/if}