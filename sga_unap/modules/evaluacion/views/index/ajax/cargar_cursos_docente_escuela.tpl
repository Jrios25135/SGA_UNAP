<option>Seleccione</option> 
{if isset($cursos_docente_escuela) && count($cursos_docente_escuela)}
{foreach item=cur from=$cursos_docente_escuela}
<option value="{$cur.Cur_IdCurso|default:0}">{$cur.Cur_Nombre}</option>
{/foreach}
{/if}   