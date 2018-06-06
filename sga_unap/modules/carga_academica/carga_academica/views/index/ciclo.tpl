<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
    <h3 style="width: 80%;  margin: 0px auto; text-align: center;">Administrar Ciclo</h3>
</div>
 {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>NUEVO CICLO</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_ciclo" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >    
                 <div class="form-group">
                        <label class="col-lg-2 control-label">ID del Ciclo </label>
                        <div class="col-lg-2">
                            <input class="form-control" id="idciclo"  type="text" name="idciclo" placeholder="Id del Ciclo" required=""  maxlength="10"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nombre: </label>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" id="nombreciclo"   name="nombreciclo" placeholder="Nombre del ciclo" required=""   />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Numero: </label>
                        <div class="col-lg-2">
                            <input class="form-control" type="text" id="numerociclo"   name="numerociclo" placeholder="Numero del ciclo" required=""   />
                        </div>
                    </div>






                	 <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-5">
                            <button class="btn btn-success" type="submit" id="bt_guardarciclo" name="bt_guardarciclo" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Guardar Ciclo</button>
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
            </i>&nbsp;&nbsp;<strong>LISTA DE CICLOS</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="Buscar curso" style="width: 150px; float: left; margin: 0px 10px;" name="palabraCiclo" id="palabraCiclo">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscar"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>Lista</b></h4>
            <div id="listarCiclo" >
                {if isset($ciclo) && count($ciclo)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                               <!-- <th style=" text-align: center"> ID </th>---->
                                <th style=" text-align: center">Nombre</th>
                                <th style=" text-align: center">Numero</th>                               
                                <th style=" text-align: center">Estado</th>
                               
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$ciclo}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                   <!-- <td style=" text-align: center">{$rl.Cic_IdCiclo}</td>-->
                                    <td style=" text-align: center">{$rl.Cic_Nombre}</td>
                                    <td style=" text-align: center">{$rl.Cic_Numero}</td>
                                    <td style=" text-align: center">
                                            {if $rl.Cic_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign" style="color: #DD4B39;"></p>
                                            {/if}
                                            {if $rl.Cic_Estado==1}
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
                    No hay Registros
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
                <!-- <input type='text' class='form-control' name='codigo' id='validate-number' placeholder='Codigo' required> --> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_rol">Eliminar</a>
            </div>
        </div>
    </div>
</div>