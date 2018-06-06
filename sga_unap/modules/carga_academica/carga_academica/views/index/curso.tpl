<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h3 style="width: 80%;  margin: 0px auto; text-align: center;">Administrar Cursos</h3>
    </div>
    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>NUEVO CURSO</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_curso" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >    

             <div class="form-group">  
                    {if isset($escuelas) && count($escuelas)}                       
                               <label class="col-lg-2 control-label">Escuela : </label>
                             <div class="col-lg-5">
                                    <select class="form-control" id="selEscuela" name="selEscuela" >
                                        <option value="">Seleccionar Escuela</option>
                                        {foreach item=r from=$escuelas }
                                        <option value="{$r.Esc_IdEscuela|default:0}" >{$r.Esc_Nombre|default:"Seleccionar"}</option>
                                        {/foreach}
                                     </select>
                             </div>   
                             {else} No hay datos para mostrar  
                             {/if}
              </div>
           

                       <div class="form-group">                                 
                               <label class="col-lg-2 control-label">Curricula : </label>
                             <div class="col-lg-5">
                                 <select class="form-control" id="selCurricula" name="selCurricula" >
                                     <option value="">Seleccionar Escuela</option>
                                        {if isset($curricula) && count($curricula)}
                                        {foreach item=r from=$curricula }
                                    <option value="{$r.Cui_IdCurricula|default:0}">{$r.Cui_Resolucion|default:"Seleccionar"}</option>  
                                        {/foreach}
                                        {/if}
                                 </select>
                             </div>   
                        </div>



                    <div class="form-group">
                        <label class="col-lg-2 control-label">Codigo del Curso: </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="codigo_curso"  type="text" name="codigo_curso" placeholder="Codigo del Curso" required=""  maxlength="9"  />
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Nombre del Curso: </label>
                        <div class="col-lg-5">
                            <input class="form-control" id="nombre_curso"  type="text" name="nombre_curso" placeholder="Nombre Curso" maxlength="60"/>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-lg-2 control-label"> Tipo de Curso: </label>
                        <div class="col-lg-5">
                        <select class="form-control" id="tipo_curso" name="tipo_curso">
                            <option > Seleccione </option>
                            <option value="Obligatorio"> Obligatorio </option>
                            <option value="Electivo"> Electivo </option>
                        </select>
                    </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-2 control-label">Creditos del Curso: </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="credito_curso"  type="text" name="credito_curso" placeholder="Creditos del Curso" required=""   required onkeypress="return justNumbers(event);" maxlength="2" onkeypress="return justNumbers(event);"/>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Horas Teoria: </label>
                        <div class="col-lg-2">
                            <input type="text" id="hora_teoria" name="hora_teoria" maxlength="2" required="" placeholder="Horas de Teoria">
                        </div>
                         <div class="col-lg-2">
                           <label class="col-lg-2 control-label">Horas</label>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Horas Practica:</label>
                        <div class="col-lg-2">
                            <input type="text" id="hora_practica" name="hora_practica" maxlength="2" placeholder="Horas de Practica">
                        </div>
                         <div class="col-lg-2">
                           <label class="col-lg-2 control-label">Horas</label>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-2 control-label">Duracion del Curso:</label>
                        <div class="col-lg-2">
                            <input class="form-control" id="dura_curso"  type="text" name="dura_curso" placeholder="Duracion del Curso" required=""/>
                        </div >
                        <div class="col-lg-2">
                           <label class="col-lg-2 control-label">Semanas</label>
                        </div >
                    </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Ciclo: </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="selciclo_curricula" name="selciclo_curricula">
                            <option value="">Seleccionar Curricula</option>
                            {if isset($ciclo_curricula) && count($ciclo_curricula)}
                            {foreach item=r from=ciclo_curricula}
                            <option value="{$r.Ciu_IdCicloCurricula|default:0}">{$r.Cic_Nombre|default:"Seleccionar"}</option>
                            {/foreach}
                            {/if}
                            </select>
                        </div>
                    </div>                    
 
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Curso Pre-Requisito</label>
                        <div class="col-lg-5">
                        <select class="form-control js-example-basic-multiple"  id="cursor" name="cursor[]" multiple="multiple">
                            <option value="">Seleccione</option>
                            <!--{$cursor|@print_r}-->
                            {if isset($cursor) && count($cursor)}
                            {foreach item=r from=$cursor}
                            <option value="{$r.Cur_IdCurso|default:0}" >{$r.Cur_Codigo}  {$r.Cur_Nombre|default:"Seleccionar"}</option>
                            {/foreach} 
                            {/if}
                        </select>
                           
                          <!--  <select class="form-control js-example-basic-multiple" id="cursor" name="cursor" multiple="multiple">
                                <?php
                                for ($i=0;$i<count($cursosr);$i++){
                                    $Cur_Idcurso = $cursor[$i]['Cur_Idcurso'];
                                    echo "<option value='$cursosr[$i][$Cur_IdCurso'>".$cursosr[$i]['Cur_Codigo']." ".$cursor[$i]['Cur_Nombre']."</option>";
                                }
                                ?>
                            </select>--->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button class="btn btn-success" type="submit" id="bt_guardarCurso" name="bt_guardarCurso" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Guardar Curso</button>
                        </div>
                    </div>
                </form>
         <script>
            function justNumbers(e) {
                var keynum = window.event ? window.event.keyCode : e.which;
                if ((keynum == 8) || (keynum == 46))
                    return true;
                return /\d/.test(String.fromCharCode(keynum));
            };
            function sololetras(){
                if (event.keyCode >45 && event.keyCode  <57) event.returnValue = false;
            }
            function chk_keys(forma){
                if(event.keyCode==17){
                    alert('**Esta desactivada la opción Ctrl**');
                    forma.focus();
                }
            }
        </script>  
            </div>
        </div>
    </div>
    {/if}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt">
            </i>&nbsp;&nbsp;<strong>BUSCAR CURSO</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="Buscar curso" style="width: 150px; float: left; margin: 0px 10px;" name="palabraCurso" id="palabraCurso">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscar"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>Lista de Cursos</b></h4>
            <div id="listarCurso" >
                {if isset($curso) && count($curso)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th > Codigo / Nombre de curso </th>
                              
                                <th style=" text-align: center">Creditos</th>
                                <th style=" text-align: center">Horas Teoria</th>
                                <th style=" text-align: center">Horas Practica</th>
                                <th style=" text-align: center">Duracion del Curso/Semanas </th>
                                <th style=" text-align: center">Ciclo</th>
                                <th style=" text-align: center">Tipo de Curso</th>
                                <th style=" text-align: center">Escuela Profesional</th>
                                <th style=" text-align: center">Plan de Estudios</th>
                                <th style=" text-align: center">Estado</th>
                               
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$curso}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td >{$rl.Cur_Codigo} - {$rl.Cur_Nombre}</td>
                                   
                                    <td style=" text-align: center">{$rl.Cur_Creditos}</td>
                                    <td style=" text-align: center">{$rl.Cur_HorasTeoria}</td>
                                    <td style=" text-align: center">{$rl.Cur_HorasPractica}</td>
                                    <td style=" text-align: center">{$rl.Cur_Semanas}</td>
                                    <td style=" text-align: center">{$rl.Cic_Nombre}</td>
                                    <td style=" text-align: center">{$rl.Cur_Tipo}</td>
                                    <td style=" text-align: center">{$rl.Esc_Nombre}</td> 
                                    <th style=" text-align: center">{$rl.Cui_Resolucion}</th> 
                                    <td style=" text-align: center">
                                            {if $rl.Cur_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" style="color: #DD4B39;"></p>
                                            {/if}
                                            {if $rl.Cur_Estado==1}
                                             <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign" style="color: #088A08;"></p>
                                             {/if}
                                        </td>
                                   
                                    
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-rol" title="{$lenguaje.tabla_opcion_cambiar_est}" id_rol="{$rl.Cur_IdCurso}" estado="{$rl.Cur_Estado}"
                                        ></a>
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-edit" title="editar" href="{$_layoutParams.root}carga_academica/index/editarCurso/{$rl.Cur_IdCurso}"></a>

                                      <!--   <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-list" title="{$lenguaje.tabla_opcion_editar_permisos}" href="{$_layoutParams.root}acl/index/permisos_role/{$rl.Rol_IdRol}"></a> -->

                                        <a   
                                        {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-rol" title="{$lenguaje.label_habilitar}  " 
                                        {else}
                                            data-book-id="{$rl.Cur_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_rol="{$rl.Cur_IdCurso}" data-placement="bottom" > </a>

                                    </td>
                                    {/if}
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}
                {else}
                    {$lenguaje.no_registros}
                {/if}                
            </div>
        </div>
    </div>
</div>

<div class="modal " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminación</h4>
            </div>
            <div class="modal-body">
                <p>Estás a punto de borrar un item, este procedimiento es irreversible</p>
                <p>¿Deseas Continuar?</p>
                <p>Eliminar: <strong  class="nombre-es">Rol</strong></p>
                <label id="texto_" name='texto_'></label>
                <!-- <input type='text' class='form-control' name='codigo' id='validate-number' placeholder='Codigo' required> --> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_rol">Eliminar</a>
            </div>
        </div>
    </div>
</div>