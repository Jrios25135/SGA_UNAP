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
                   Editar Docente
                </strong>
            </h3>
            <div id="editar_docente" class="panel-body"  style="width: 90%; margin: 0px auto">
                <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                    <input type="hidden" id="Ded_IdDetalleDocente" name="Ded_IdDetalleDocente" value="{$datos.Ded_IdDetalleDocente}"/>

                    <div class="form-group">
                       
                        <label class="col-lg-2 control-label">
                            Escuela :
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="selescuela" name="selescuela">
                                <option value="">
                                    Seleccionar Escuela
                                </option>
                                 {if isset($escue) && count($escue)}
                                {foreach item=r from=$escue }
                                <option value="{$r.Esc_IdEscuela}" {if $r.Esc_IdEscuela == $datos.Esc_IdEscuela} selected=" " {/if}>
                                    {$r.Esc_Nombre}
                                </option>
                                {/foreach}
                                {/if}
                            </select>
                        </div>        
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Docente :
                        </label>
                        <div class="col-lg-5">
                            <select class="form-control" id="seldocente" name="seldocente">
                                <option value="">
                                    Seleccionar Docente
                                </option>
                                {if isset($maestro) && count($maestro)}
                                {foreach item=r from=$maestro }
                                <option value="{$r.Usr_IdUsuarioRol}" {if $r.Usr_IdUsuarioRol == $datos.Usr_IdUsuarioRol} selected="" {/if}>
                                    {$r.Usu_Nombre}   {$r.Usu_Apellidos}
                                </option>
                                {/foreach}
                                {/if}
                            </select>
                        </div>  
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Grado Academico:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" value="{$datos.Ded_GradoAcademico}" id="gradoacademico"  name="gradoacademico" placeholder="Grado Academico" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Condicion:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" value="{$datos.Ded_Condicion}" id="condicion"  name="condicion" placeholder="Condicion" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Dedicacion:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" value="{$datos.Ded_Dedicacion}"  id="dedicacion" name="dedicacion" placeholder="Dedicacion" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Categoria:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" value="{$datos.Ded_Categoria}" id="categoria" name="categoria"  placeholder="Categoria" required="" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Cargo:
                        </label>
                        <div class="col-lg-2">
                            <input class="form-control" value="{$datos.Ded_Cargo}"  id="cargo" name="cargo" placeholder="Cargo" required="" type="text"/>
                        </div>
                    </div>

                   <div>
                         <div  class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" type="submit" id="bt_editardocente" name="bt_editardocente" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Editar Docente</button>
                        </div>
                    </div>

                      <div>
                            <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                            <button class="btn btn-danger" type="submit" id="bt_cancelardocente" name="bt_cancelardocente" ><i class="glyphicon glyphicon-remove"> </i> Cancelar </button>
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
</div>