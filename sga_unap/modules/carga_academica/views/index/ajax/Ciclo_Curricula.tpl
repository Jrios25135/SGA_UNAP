<option value="0">Seleccione</option>
{if isset($ciclo_curricula) && count($ciclo_curricula)}
{foreach item=r from=$ciclo_curricula}
<option value="{$r.Ciu_IdCicloCurricula|default:0}" >{$r.Cic_Nombre|default:"Seleccionar"}</option>
{/foreach} 
{/if}