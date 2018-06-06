<div class="container-fluid">
 
 <div id='editar_docente'>
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" class="panel-title collapsed" data-toggle="collapse" href="#collapse3">
                <i class="fa fa-ellipsis-v" style="float:right">
                </i>
                <i class="fa fa-user-secret">
                </i>
                <strong>
                   Editar Alumno
                </strong>
            </h3>

            <div id="editar_alumno" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >  
                     <input type="hidden" id="Dea_IdDetalleAlumno" name="Dea_IdDetalleAlumno" value="{$datos.Dea_IdDetalleAlumno}"/>

                             <div class="form-group">
                    
                               <label class="col-lg-2 control-label">Alumno : </label>
                             <div class="col-lg-5">
                                    <select class="form-control" id="selestudi" name="selestudi" >
                                        <option value="">Seleccionar Alumno</option>
                                        {if isset($estudiante) && count($estudiante)}
                                        {foreach item=r from=$estudiante }
                                        <option value="{$r.Usr_IdUsuarioRol}" {if $r.Usr_IdUsuarioRol == $datos.Usr_IdUsuarioRol} selected=" " {/if}>
                                        {$r.Usu_Nombre}   {$r.Usu_Apellidos} </option>
                                        {/foreach}
                                        {/if}
                                     </select>
                             </div>
                             
                         </div>


                             <div class="form-group">
                               <label class="col-lg-2 control-label">Escuela : </label>
                             <div class="col-lg-5">
                                    <select class="form-control" id="selescuela" name="selescuela" >
                                        <option value="">Seleccionar Escuela</option>
                                        {if isset($escue) && count($escue)}
                                        {foreach item=r from=$escue }
                                        <option value="{$r.Esc_IdEscuela}"  {if $r.Esc_IdEscuela == $datos.Esc_IdEscuela} selected=" " {/if}>{$r.Esc_Nombre} </option>
                                        {/foreach}
                                          {/if}
                                     </select>
                             </div>
                         </div>


                              <div class="form-group">
                               <label class="col-lg-2 control-label">Curricula : </label>
                             <div class="col-lg-5">
                                 <select class="form-control" id="selcurri" name="selcurri" >
                                     <option value="">Seleccionar Escuela</option>
                                        {if isset($curri) && count($curri)}
                                        {foreach item=r from=$curri }
                                    <option value="{$r.Cui_IdCurricula}" {if $r.Cui_IdCurricula == $datos.Cui_IdCurricula} selected=" " {/if}>{$r.Cui_Resolucion}</option>
                                        {/foreach}
                                        {/if}
                                 </select>
                             </div>
                        </div>

                 <div class="form-group">
                        <label class="col-lg-2 control-label">Codigo Universitario: </label>
                        <div class="col-lg-5">
                            <input class="form-control" id="codigouniveristario" value="{$datos.Dea_CodigoUniversitario}" type="text" name="codigouniveristario" placeholder="codigouniveristario" required=""  maxlength="10"  />
                        </div>
                    </div>

                   

                	 <div>
                        <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" type="submit" id="bt_editarestudiante" name="bt_editarestudiante" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Editar Estudiante</button>
                        </div>
                    </div>
                  
                        <div>
                            <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                              <button class="btn btn-danger" type="submit" id="bt_cancelarestudiante" name="bt_cancelarestudiante" ><i class="glyphicon glyphicon-remove"> </i> Cancelar </button>
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