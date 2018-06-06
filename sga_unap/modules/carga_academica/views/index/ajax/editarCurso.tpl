<div class="container-fluid">
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">
            Administrar Cursos
        </h4>
    </div>
    <div id="editarcurso">
        <!-- {$datos|@var_dump} -->
        <div class="panel panel-default">
            <div class="panel-heading ">
                <h3 class="panel-title ">
                    <i class="fa fa-ellipsis-v" style="float:right">
                    </i>
                    <i class="fa fa-user-secret">
                    </i>
                    <strong>
                        Editar Curso
                    </strong>
                </h3>
                <div class="panel-body" id="editarcurso" style="width: 90%; margin: 0px auto">
                    <form action="" class="form-horizontal" data-toggle="validator" id="form3" method="post" name="form1" role="form">
                        <input id="Cur_IdCurso" name="Cur_IdCurso" type="hidden" value="{$datos.Cur_IdCurso}"/>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Escuela :
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control" id="selEscuela" name="selEscuela">
                                    <option>
                                        Seleccionar Escuela
                                    </option>
                                    {if isset($escuelas) && count($escuelas)}
                                    {foreach item=r from=$escuelas}
                                    <option value="{$r.Esc_IdEscuela}" {if $r.Esc_IdEscuela == $datos.Esc_IdEscuela} selected {/if}>
                                        {$r.Esc_Nombre}
                                    </option>
                                    {/foreach}
                                    {/if}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Curricula :
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control" id="selCurricula" name="selCurricula">
                                    <option value="">
                                        Seleccionar Escuela
                                    </option>
                                    {if isset($curricula) && count($curricula)}
                                        {foreach item=r from=$curricula }
                                    <value="{$r.Cui_IdCurricula}" {if $r.Cui_IdCurricula == $datos.Cui_IdCurricula} selected='' {/if}>{$r.Cui_Resolucion}
                                    </option>
                                    {/foreach}
                                        {/if}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Codigo del Curso:
                            </label>
                            <div class="col-lg-2">
                                <input class="form-control" id="codigo_curso" maxlength="9" name="codigo_curso" placeholder="Codigo del Curso" required="" type="text" value="{$datos.Cur_Codigo}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Nombre del Curso:
                            </label>
                            <div class="col-lg-5">
                                <input class="form-control" id="nombre_curso" maxlength="60" name="nombre_curso" onkeydown="chk_keys(document.forms[0].nombres);" onkeypress="sololetras()" placeholder="Nombre Curso" required="" type="text" value="{$datos.Cur_Nombre}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Tipo de Curso:
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control" id="tipo_curso" name="tipo_curso">
                                  <option > Seleccione </option>
                            <option value="Obligatorio" {if $datos.Cur_Tipo == 'Obligatorio'} selected {/if}> Obligatorio </option>
                            <option value="Electivo" {if $datos.Cur_Tipo == 'Electivo'} selected {/if}> Electivo </option>
                                </select>
                                <!-- {$datos.Cur_Tipo}" {if $r.Cur_Tipo == $datos.Cur_Tipo} selected="" {/if}-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Creditos del Curso:
                            </label>
                            <div class="col-lg-2">
                                <input class="form-control" id="credito_curso" maxlength="2" name="credito_curso" onkeypress="return justNumbers(event);" placeholder="Creditos del Curso" required="" type="text" value="{$datos.Cur_Creditos}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Horas Teoria:
                            </label>
                            <div class="col-lg-2">
                                <input class="form-control" id="hora_teoria" maxlength="2" name="hora_teoria" placeholder="Horas de Teoria" required="" type="text" value="{$datos.Cur_HorasTeoria}">
                                </input>
                            </div>
                            <div class="col-lg-2">
                                <label class="col-lg-2 control-label">
                                    Horas
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Horas Practica:
                            </label>
                            <div class="col-lg-2">
                                <input class="form-control" id="hora_practica" maxlength="2" name="hora_practica" placeholder="Horas de Practica" type="text" value="{$datos.Cur_HorasPractica}">
                                </input>
                            </div>
                            <div class="col-lg-2">
                                <label class="col-lg-2 control-label">
                                    Horas
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Duracion del Curso:
                            </label>
                            <div class="col-lg-2">
                                <input class="form-control" id="dura_curso" name="dura_curso" placeholder="Duracion del Curso" required="" type="text" value="{$datos.Cur_Semanas}"/>
                            </div>
                            <div class="col-lg-2">
                                <label class="col-lg-2 control-label">
                                    Semanas
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Ciclo:
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control" id="selciclo_curricula" name="selciclo_curricula">
                                    <option value="">
                                        Seleccionar Curricula
                                    </option>
                                    {if isset($ciclo_curricula) && count($ciclo_curricula)}
                            {foreach item=r from=$ciclo_curricula}
                                    <option value="{$r.Ciu_IdCicloCurricula}" {if $r.Ciu_IdCicloCurricula == $datos.Ciu_IdCicloCurricula} selected {/if}>{$r.Cic_Nombre}
                                    </option>
                                    {/foreach}
                            {/if}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                Curso Pre-Requisito
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control js-example-basic-multiple" id="cursor" name="cursor" multiple="" name="cursor">
                                    <option value="">
                                        Seleccione
                                    </option>
                                    {if isset($cursor) && count($cursor)}
                            {foreach item=r from=$cursor}
                                    <option value="{$r.Cur_IdCurso|default:0}" {if $r.Cur_IdCurso == $datos.id_curso_requisito} selected='' {/if}>{$r.Cur_Codigo} {$r.Cur_Nombre|default:"Seleccionar"}
                                    </option>
                                    {/foreach}
                            {/if}
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                                <button class="btn btn-success" id="bt_editarCurso" name="bt_editarCurso" type="submit">
                                    <i class="glyphicon glyphicon-floppy-disk">
                                    </i>
                                    Editar Curso
                                </button>
                            </div>
                        </div>
                        <div>
                            <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                                <button class="btn btn-danger" id="bt_cancelarEditarCurso" name="bt_cancelarEditarCurso" type="submit">
                                    <i class="glyphicon glyphicon-remove">
                                    </i>
                                    {$lenguaje.button_cancel}
                                </button>
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