<option>Seleccione</option> 
{if isset($docentes_escuela) && count($docentes_escuela)}
{foreach item=doc from=$docentes_escuela}
<option value="{$doc.Usr_IdUsuarioRol|default:0}">{$doc.Usu_Nombre}</option>
{/foreach}
{/if}   