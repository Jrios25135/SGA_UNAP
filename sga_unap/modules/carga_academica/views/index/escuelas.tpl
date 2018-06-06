<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRAR ESCUELA</h4>
    </div>
    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right"class="fa fa-ellipsis-v"></i>&nbsp;&nbsp;<strong>NUEVA ESCUELA</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_rol" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >       
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nombre : </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoEscuela"  type="text" name="nuevoEscuela" placeholder="Nombre Escuela" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Descripción : </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoDescripcion"  type="text" name="nuevoDescripcion" placeholder="Descripción de Escuela" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Dirección : </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoDireccion"  type="text" name="nuevoDireccion" placeholder="Direccion Escuela" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Teléfono : </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoTelefono"  type="text" name="nuevoTelefono" placeholder="Teléfono Escuela" required="" />
                        </div>
                    </div>
                    <div class="form-group">     
                    {if  isset($facultades) && count($facultades)}                            
                        <label class="col-lg-2 control-label">Facultad : </label>
                        <div class="col-lg-10">
                            
                            <select class="form-control" id="selFacultad" name="selFacultad" required="" >
                                <option value="">Seleccionar Escuela</option>
                                {foreach from=$facultades item=r}
                                    <option value="{$r.Fac_IdFacultad}">{$r.Fac_Nombre}</option>    
                                {/foreach}
                            </select>
                            
                        </div>
                        {else} No hay datos de Genero para mostrar...!!!
                    {/if}
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit" id="bt_guardarEscuela" name="bt_guardarEscuela" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {/if}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BUSCAR ESCUELA</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="Buscar" style="width: 150px; float: left; margin: 0px 10px;" name="nombre" id="palabra">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscarEscuela"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}acl/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>LISTA DE ESCUELAS</b></h4>
            <div id="listarEscuelas" >
                {if isset($escuelas) && count($escuelas)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >Nombre</th>
                                <th >Direccion</th>
                                <th >Teléfono</th>
                                <th >Facultad</th>
                                <th style=" text-align: center">{$lenguaje.label_estado}</th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$escuelas}
                                <tr>
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rl.Esc_Nombre}</td>
                                    <td>{$rl.Esc_Direccion}</td>
                                    <td>{$rl.Esc_Telefono}</td>
                                    <td>{$rl.Fac_Nombre}</td>
                                    <td style=" text-align: center">
                                        {if $rl.Esc_Estado==0}
                                            <p class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                                        {/if}                            
                                        {if $rl.Esc_Estado==1}
                                            <p class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                                        {/if}
                                    </td>
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-pencil" title="Editar Reino" href="{$_layoutParams.root}carga_academica/index/editarEscuela/{$rl.Esc_IdEscuela}"></a>
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh" title="{$lenguaje.tabla_opcion_cambiar_est}" href="{$_layoutParams.root}carga_academica/index/_cambiarEstadoEscuela/{$rl.Esc_IdEscuela}/{$rl.Esc_Estado}"></a>
                                       <!--  <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-trash" title="{$lenguaje.label_eliminar}" href="{$_layoutParams.root}carga_academica/index/_eliminarReino/{$rl.Esc_IdEscuela}"></a> -->
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