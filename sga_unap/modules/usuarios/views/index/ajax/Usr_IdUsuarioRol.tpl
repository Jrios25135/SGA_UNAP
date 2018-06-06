 <option value="">Seleccionar Docente</option>
 {if isset($maestro) && count($maestro)}
 {foreach item=r from=$maestro}
 <option value="{$r.Usr_IdUsuarioRol|default:0}" >{$r.Usu_Nombre} {$r.Usu_Apellidos|default:"Seleccionar"}</option>
 {/foreach}
 {/if}