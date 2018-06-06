<option value="">Seleccionar Curso</option>
{if  isset($cursos) && count($cursos)} 
    {foreach from=$cursos item=r}
        <option value="{$r.Cur_IdCurso}">{$r.Cur_Nombre}</option>    
    {/foreach}
{/if}