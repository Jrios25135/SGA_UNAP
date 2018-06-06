<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">Administrar Cursos</h4>
    </div>
    <div id='editarcurso'>
        <div class="panel panel-default">
            <div class="panel-heading ">
                <h3 class="panel-title "><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>Editar Curso</strong></h3>
            <div id="editarcurso" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >
                    <input type="hidden" id="Cur_IdCurso" name="Cur_IdCurso" value="{$datos.Cur_IdCurso}" />

               <div class="form-group">
                        <label class="col-lg-2 control-label">Escuela : </label>
                        <div class="col-lg-8">
                            <div class="col-xs-10 col-sm-6" style="padding: 0px;">
                                <select class="form-control"  name="selEscuela" id="selEscuela" >
                                    <option value="0" >Seleccionar Escuela</option>
                                    {if isset($escuelas) && count($escuelas)}
                                    {foreach item=r from=$escuelas}
                                        <option value="{$r.Esc_IdEscuela}">{$r.Esc_Nombre}</option>
                                    {/foreach}
                                    {/if}
                                    <!--{if $r.Esc_IdEscuela == $datos.Esc_IdEscuela} selected="" {/if}-->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">                                 
                               <label class="col-lg-2 control-label">Curricula : </label>
                             <div class="col-lg-5"> 
                                 <select class="form-control" id="selCurricula" name="selCurricula" >
                                     <option value="">Seleccionar Escuela</option>
                                        {if isset($curricula) && count($curricula)}
                                        {foreach item=r from=$curricula }
                                    <option value="{$r.Cui_IdCurricula}">{$r.Cui_Resolucion}</option>  
                                        {/foreach}
                                        {/if}
                                        <!--{if $r.Cui_IdCurricula == $datos.Cui_IdCurricula} selected="" {/if}-->
                                 </select>
                             </div>   
                        </div>



                    <div class="form-group">
                        <label class="col-lg-2 control-label">Codigo del Curso: </label>
                        <div class="col-lg-2">
                            <input class="form-control"  value="{$datos.Cur_Codigo}" id="codigo_curso"  type="text" name="codigo_curso" placeholder="Codigo del Curso" required=""  maxlength="9"  />
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Nombre del Curso: </label>
                        <div class="col-lg-5">
                            <input class="form-control" value="{$datos.Cur_Nombre}"  id="nombre_curso"  type="text" name="nombre_curso" placeholder="Nombre Curso" required onKeypress="sololetras()"  onkeydown="chk_keys(document.forms[0].nombres);"  maxlength="60"/>
                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="col-lg-2 control-label"> Tipo de Curso: </label>
                        <div class="col-lg-5">
                        <select class="form-control" id="tipo_curso"  name="tipo_curso">
                            <option > Seleccione </option>
                            <option value="Obligatorio"> Obligatorio </option>
                            <option value="Electivo"> Electivo </option>
                        </select>
                        <!-- {$datos.Cur_Tipo}" {if $r.Cur_Tipo == $datos.Cur_Tipo} selected="" {/if}-->
                    </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-2 control-label">Creditos del Curso: </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="credito_curso"  value="{$datos.Cur_Creditos}"  type="text" name="credito_curso" placeholder="Creditos del Curso" required=""   required onkeypress="return justNumbers(event);" maxlength="2" onkeypress="return justNumbers(event);"/>
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label">Horas Teoria: </label>
                        <div class="col-lg-2">
                            <input type="text" id="hora_teoria" value="{$datos.Cur_HorasTeoria}"  name="hora_teoria" maxlength="2" required="" placeholder="Horas de Teoria">
                        </div>
                         <div class="col-lg-2">
                           <label class="col-lg-2 control-label">Horas</label>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-2 control-label">Horas Practica:</label>
                        <div class="col-lg-2">
                            <input type="text" id="hora_practica" value="{$datos.Cur_HorasPractica}"  name="hora_practica" maxlength="2" placeholder="Horas de Practica">
                        </div>
                         <div class="col-lg-2">
                           <label class="col-lg-2 control-label">Horas</label>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-2 control-label">Duracion del Curso:</label>
                        <div class="col-lg-2">
                            <input class="form-control" id="dura_curso" value="{$datos.Cur_Semanas}"  type="text" name="dura_curso" placeholder="Duracion del Curso" required=""/>
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
                            <option value="{$r.Ciu_IdCicloCurricula}">{$r.Cic_Nombre}</option>
                            {/foreach}
                            {/if}
                            <!--{if $r.Ciu_IdCicloCurricula == $datos.Ciu_IdCicloCurricula} selected="" {/if}-->
                            </select>
                        </div>
                    </div> 


                     
               <div class="form-group">
                        <label class="col-lg-2 control-label">Curso Pre-Requisito</label>
                        <div class="col-lg-5">
                        <select class="form-control js-example-basic-multiple"  id="cursor" name="cursor" multiple="multiple">
                            <option value="">Seleccione</option>
                            <!--{$cursor|@print_r}-->
                            {if isset($cursor) && count($cursor)}
                            {foreach item=r from=$cursor}
                            <option value="{$r.Cur_IdCurso|default:0}" >{$r.Cur_Codigo}  {$r.Cur_Nombre|default:"Seleccionar"}</option>
                            {/foreach} 
                            {/if}
                        </select>
                        </div>
                </div>




                    <div>
                         <div  class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" type="submit" id="bt_editarCurso" name="bt_editarCurso" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Editar Curso</button>
                        </div> 
                    </div> 
                      
                 
               
                <div>
                        <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                            <button class="btn btn-danger" type="submit" id="bt_cancelarEditarCurso" name="bt_cancelarEditarCurso" ><i class="glyphicon glyphicon-remove"> </i>&nbsp; {$lenguaje.button_cancel}</button>
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
</div>
