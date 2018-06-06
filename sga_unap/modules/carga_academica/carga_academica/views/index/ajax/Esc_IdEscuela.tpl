<option value="">Seleccione </option>
{if isset($escuelas) && count($escuelas)}
{foreach item=r from=$escuelas }
<option value="{$r.Esc_IdEscuela|default:0}">{$r.Esc_Nombre|default:"Seleccionar"}</option>  
{/foreach}
{/if}