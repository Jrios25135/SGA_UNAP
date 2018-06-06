<div  class="container-fluid" 
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRAR ESCUELA</h4>
    </div>    
    <div id="gestion_idiomas_permisos">
        {if  isset($idiomas) && count($idiomas)}
            <ul class="nav nav-tabs ">
            {foreach from=$idiomas item=idi}
                <li role="presentation" class="{if $datos.Idi_IdIdioma==$idi.Idi_IdIdioma} active {/if}">
                    <a class="idioma_s" id="idioma_{$idi.Idi_IdIdioma}" href="#">{$idi.Idi_Idioma}</a>
                    <input type="hidden" id="hd_idioma_{$idi.Idi_IdIdioma}" value="{$idi.Idi_IdIdioma}" />
                    <input type="hidden" id="idiomaTradu" value="{$datos.Idi_IdIdioma}"/>
                </li>    
            {/foreach}
            </ul>
        {/if}
        <div class="panel panel-default">
            <div class="panel-heading ">
                <h3 class="panel-title "><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>EDITAR ESCUELA</strong></h3>
            </div>

            <div id="nuevo_rol" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal"  data-toggle="validator" id="form4" role="form" name="form4" action="" method="post">                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nombre : </label>
                        <div class="col-lg-10">
                            <input  class="form-control" value="{$datos.Esc_Nombre|default:''}" type="text" name="editarNombre" id="editarNombre" placeholder="Nombre de Escuela" required=""  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Descripción : </label>
                        <div class="col-lg-10">
                            <input  class="form-control" value="{$datos.Esc_Descripcion|default:''}" type="text" name="editarDescripcion" id="editarDescripcion" placeholder="Descripción" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Dirección : </label>
                        <div class="col-lg-10">
                            <input  class="form-control" value="{$datos.Esc_Direccion|default:''}" type="text" name="editarDireccion" id="editarDireccion" placeholder="Dirección" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Teléfono : </label>
                        <div class="col-lg-10">
                            <input  class="form-control" value="{$datos.Esc_Telefono|default:''}" type="text" name="editarTelefono" id="editarTelefono" placeholder="Teléfono" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Facultad : </label>
                        <div class="col-lg-8">
                            <div class="col-xs-10 col-sm-6" style="padding: 0px;">
                                <select class="form-control" name="selFacultad" id="selFacultad" required="">
                                    <option value="0" >Seleccionar Facultad</option>
                                    {if isset($facultades) && count($facultades)}
                                    {foreach item=m from=$facultades}
                                        <option value="{$m.Fac_IdFacultad}" {if $m.Fac_IdFacultad == $datos.Fac_IdFacultad} selected="" {/if} >{$m.Fac_Nombre}</option>
                                    {/foreach}
                                    {/if}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" type="submit" id="bt_editarEscuela" name="bt_editarEscuela" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                        </div>
                        <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                            <button class="btn btn-danger" type="submit" id="bt_cancelarEditarEscuela" name="bt_cancelarEditarEscuela" ><i class="glyphicon glyphicon-remove"> </i>&nbsp; {$lenguaje.button_cancel}</button>
                        </div>
                    </div><!--                    <button class="btn btn-primary" type="button" id="btGuardarPermiso"  ><i class="glyphicon glyphicon-ok"> </i>  Guardar</button>-->
                </form> 
            </div>    
        </div>                    
    </div>
</div>
