<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
    <h3 style="width: 80%;  margin: 0px auto; text-align: center;">Administrar Estudiante</h3>
</div>
 {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>Resgistrar Estudiante</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_docente" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >  

                             <div class="form-group">
                    {if isset($estudiante) && count($estudiante)}
                               <label class="col-lg-2 control-label">Alumno : </label>
                             <div class="col-lg-5">
                                    <select class="form-control" id="selestudiante" name="selestudiante" >
                                        <option value="">Seleccionar Alumno</option>
                                        {foreach item=r from=$estudiante }
                                        <option value="{$r.Usr_IdUsuarioRol|default:0}">{$r.Usu_Nombre}   {$r.Usu_Apellidos|default:"Seleccionar"} </option>
                                        {/foreach}
                                     </select>
                             </div>
                             {else} No hay datos para mostrar
                             {/if}
                         </div>


                             <div class="form-group">
                               <label class="col-lg-2 control-label">Escuela : </label>
                             <div class="col-lg-5">
                                    <select class="form-control" id="selescuela" name="selescuela" >
                                        <option value="">Seleccionar Escuela</option>
                                        {if isset($escue) && count($escue)}
                                        {foreach item=r from=$escue }
                                        <option value="{$r.Esc_IdEscuela|default:0}" >{$r.Esc_Nombre|default:"Seleccionar"} </option>
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
                                    <option value="{$r.Cui_IdCurricula|default:0}">{$r.Cui_Resolucion|default:"Seleccionar"}</option>
                                        {/foreach}
                                        {/if}
                                 </select>
                             </div>
                        </div>

                 <div class="form-group">
                        <label class="col-lg-2 control-label">Codigo Universitario: </label>
                        <div class="col-lg-5">
                            <input class="form-control" id="codigouniveristario"  type="text" name="codigouniveristario" placeholder="codigouniveristario" required=""  maxlength="10"  />
                        </div>
                    </div>

                   


                	 <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button class="btn btn-success" type="submit" id="bt_guardarestudiante" name="bt_guardarestudiante" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Guardar Estudiante</button>
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
            </i>&nbsp;&nbsp;<strong>LISTA DE ESTUDIANTES</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="Buscar Estudiante" style="width: 150px; float: left; margin: 0px 10px;" name="palabra" id="palabra">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscarAlumno" name="buscarAlumno"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>Lista</b></h4>
            <div id="listaralumno" >
                {if isset($estudiantes) && count($estudiantes)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th style=" text-align: center">Nombres / Apellidos </th>
                                <th style=" text-align: center">Codigo Universitario</th>         
                                <th style=" text-align: center">Curricula / Resolucion</th>
                                <th style=" text-align: center">
                                Estado
                                </th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">
                                {$lenguaje.label_opciones}
                                </th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$estudiantes}
                            <tr {if $rl.Row_Estado==0}
                                            {if $_acl-> permiso("ver_eliminados")}
                                            class="btn-danger"
                                            {else}
                                            hidden {$numeropagina=$numeropagina-1}
                                            {/if}
                                            {/if}>
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td style=" text-align: center">{$rl.Usu_Nombre}  {$rl.Usu_Apellidos} </td> 
                                    <td style=" text-align: center">{$rl.Dea_CodigoUniversitario}</td>
                                    <td style=" text-align: center">{$rl.Cui_Nombre} - {$rl.Cui_Resolucion}</td> 
                                <td style=" text-align: center">
                                {if $rl.Dea_Estado==0}
                                <p class="glyphicon glyphicon-remove-sign" data-placement="bottom" data-toggle="tooltip" style="color: #DD4B39;">
                                </p>
                                {/if}
                                {if $rl.Dea_Estado==1}
                                <p class="glyphicon glyphicon-ok-sign" data-placement="bottom" data-toggle="tooltip" style="color: #088A08;">
                                </p>
                                {/if}
                            </td> 
                            {if $_acl->permiso("editar_rol")}
                            <td style=" text-align: center">
                                <a data-toggle="tooltip"  data-placement="bottom"  class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-alumno"   title="cambiar estado " id_detallealumno="{$rl.Dea_IdDetalleAlumno}" estado="{$rl.Dea_Estado}">
                                </a>
                                <a class="btn btn-default btn-sm glyphicon glyphicon-edit" data-placement="bottom" data-toggle="tooltip" href="{$_layoutParams.root}usuarios/index/editaralumno/{$rl.Dea_IdDetalleAlumno}" title="editar">
                                </a>
      
                                <a {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-alumno" title="Hablitar  " 
                                        {else}
                                            data-book-id="{$rl.Dea_CodigoUniversitario}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-alumno" title=" eliminar "
                                        {/if} 
                                        id_detallealumno="{$rl.Dea_IdDetalleAlumno}" data-placement="bottom">
                                </a>
                            </td>
                            {/if} 
                            </tr>
                           {/foreach}
                        </table>
                    </div>
                    {$paginacion|default:""}
                   {else}            
                {/if}  
            </div>
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
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_alumno">Eliminar</a>
            </div>
        </div>
    </div>
</div>