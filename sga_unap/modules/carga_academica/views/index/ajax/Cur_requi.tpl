<!---<select class="form-control js-example-basic-multiple" id="cursor" name="cursor" multiple="multiple">-->
<option value="">Seleccione</option>
{if isset($cursor) && count($cursor)}
{foreach item=r from=$cursor}
<option value="{$r.Cur_IdCurso|default:0}" >{$r.Cur_Codigo}  {$r.Cur_Nombre|default:"Seleccionar"}</option>
{/foreach} 
{/if}
<!--</select>-->

  
<!--<select class="form-control js-example-basic-multiple" id="cursor" name="cursor" multiple="multiple">
   <?php
   for ($i=0;$i<count($cursosr);$i++){
   $Cur_Idcurso = $cursor[$i]['Cur_Idcurso'];
   <option value='$cursosr[$i][$Cur_IdCurso'>".$cursosr[$i]['Cur_Codigo']." ".$cursor[$i]['Cur_Nombre'].</option>;
   }
  ?>
</select>-->