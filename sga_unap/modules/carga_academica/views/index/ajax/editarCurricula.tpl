<div class="container-fluid">
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">
            ADMINISTRAR CURRICULA
        </h4>
    </div>
    <div id="gestion_idiomas_rol">
        {if  isset($idiomas) && count($idiomas)}
        <ul class="nav nav-tabs ">
            {foreach from=$idiomas item=idi}
            <li class="{if $datos.Idi_IdIdioma==$idi.Idi_IdIdioma} active {/if}" role="presentation">
                <a class="idioma_s" href="#" id="idioma_{$idi.Idi_IdIdioma}">
                    {$idi.Idi_Idioma}
                </a>
                <input id="hd_idioma_{$idi.Idi_IdIdioma}" type="hidden" value="{$idi.Idi_IdIdioma}"/>
                <input id="idiomaTradu" type="hidden" value="{$datos.Idi_IdIdioma}"/>
            </li>
            {/foreach}
        </ul>
        {/if}
        <div class="panel panel-default">
            <div class="panel-heading ">
                <h3 class="panel-title ">
                    <i class="fa fa-ellipsis-v" style="float:right">
                    </i>
                    <i class="fa fa-user-secret">
                    </i>
                    <strong>
                        EDITAR CURRICULA
                    </strong>
                </h3>
            </div>
            <div class="panel-body" id="Fac__rol" style="width: 90%; margin: 0px auto">
                <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                    <input id="Cui_IdCurricula" name="Cui_IdCurricula" type="hidden" value="{$datos.Cui_IdCurricula}"/>
                    <!-- <input type="hidden" id="idIdiomaSeleccionado" name="idIdiomaSeleccionado" value="{$datos.Idi_IdIdioma}" /> -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Nombre :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="editarCurricula" name="editarCurricula" placeholder="Nombre Curricula" required="" type="text" value="{$datos.Cui_Nombre|default:' - '}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Descripción :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="editarDescripcion" name="editarDescripcion" placeholder="Descripción Curricula" required="" type="text" value="{$datos.Cui_Descripcion|default:' - '}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Código :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="editarCodigo" name="editarCodigo" placeholder="Código Curricula" required="" type="text" value="{$datos.Cui_Codigo|default:' - '}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Resolución :
                        </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="editarResolucion" name="editarResolucion" placeholder="Resolución Curricula" required="" type="text" value="{$datos.Cui_Resolucion|default:' - '}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">
                            Escuela :
                        </label>
                        <div class="col-lg-10">
                            {if  isset($escuelas) && count($escuelas)}
                            <select class="form-control" id="editarSelEscuela" name="editarSelEscuela" required="">
                                <option value="">
                                    Seleccionar Escuela
                                </option>
                                {foreach from=$escuelas item=r}
                                <option $r.esc_idescuela="$datos.Esc_IdEscuela}" if}="" selected="" value="{$r.Esc_IdEscuela}" {="" {if="">
                                    {$r.Esc_Nombre}
                                </option>
                                {/foreach}
                            </select>
                            {else} No hay datos para mostrar...!!!
                            {/if}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" id="bt_editarCurricula" name="bt_editarCurricula" type="submit">
                                <i class="glyphicon glyphicon-floppy-disk">
                                </i>
                                {$lenguaje.button_ok}
                            </button>
                        </div>
                        <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                            <button class="btn btn-danger" id="bt_cancelarEditarCurricula" name="bt_cancelarEditarCurricula" type="submit">
                                <i class="glyphicon glyphicon-remove">
                                </i>
                                {$lenguaje.button_cancel}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
