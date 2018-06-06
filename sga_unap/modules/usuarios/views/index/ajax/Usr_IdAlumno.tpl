 <option value="">Seleccionar Alumno</option>
 {if isset($estudiante) && count($estudiante)}
 {foreach item=r from=$estudiante}
 <option value="{$r.Usr_IdUsuarioRol|default:0}" >{$r.Usu_Nombre}  {$r.Usu_Apellidos|default:"Seleccionar"}</option>
 {/foreach}
 {/if}