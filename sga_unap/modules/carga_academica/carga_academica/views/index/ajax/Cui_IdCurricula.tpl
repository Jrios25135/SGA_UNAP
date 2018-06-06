<option value="0">Seleccione</option>
{if isset($curricula) && count($curricula)}
{foreach item=r from=$curricula}
<option value="{$r.Cui_IdCurricula|default:0}" >{$r.Cui_Resolucion|default:"Seleccionar"}</option>
{/foreach} 
{/if}