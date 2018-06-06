<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRAR CARGA ACADÉMICA</h4>
    </div>
    <!-- Editar Carga Academica -->
    <div id='gestion_idiomas_rol'>
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
                <h3 aria-expanded="false" data-toggle="collapse" href="#collapse1" class="panel-title collapsed"><i style="float:right" class="glyphicon glyphicon-option-vertical"></i><i class="glyphicon glyphicon-oil"></i>&nbsp;&nbsp;<strong>EDITAR CARGA ACADÉMICA</strong></h3>
            </div>
            <div style="height: 0px;" aria-expanded="false" id="collapse1" class="panel-collapse collapse">
                <div id="editarCarga" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >
                    <input type="hidden" id="Cui_IdCurricula" name="Cui_IdCurricula" value="{$datos.Cui_IdCurricula}" />
                    <!-- <input type="hidden" id="idIdiomaSeleccionado" name="idIdiomaSeleccionado" value="{$datos.Idi_IdIdioma}" /> -->
                    

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Escuela : </label>
                        <div class="col-lg-10">
                            <input type="hidden" name="Esc_IdEscuela" id="Esc_IdEscuela" value="{$escuela.Esc_IdEscuela}">
                            <input class="form-control"  type="text" placeholder="{$escuela.Esc_Nombre|default:' - '}" value = "{$escuela.Esc_Nombre|default:' - '}" disabled="" />
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Curricula : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="Cui_IdCurricula" name="Cui_IdCurricula" required="" >
                                <option value="">Seleccionar Curricula</option>
                                {if  isset($curriculas) && count($curriculas)} 
                                    {foreach from=$curriculas item=r}
                                        <option value="{$r.Cui_IdCurricula}" {if $r.Cui_IdCurricula == $datos.Cui_IdCurricula} selected="" {/if} >{$r.Cui_Nombre} - {$r.Cui_Codigo}</option>    
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Nombre Curso : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="Cur_IdCurso" name="Cur_IdCurso" required="" >
                                <option value="">Seleccionar Curso</option>
                                {if  isset($cursos) && count($cursos)} 
                                    {foreach from=$cursos item=r}
                                        <option value="{$r.Cur_IdCurso}" {if $r.Cur_IdCurso == $datos.Cur_IdCurso} selected="" {/if} >{$r.Cur_Nombre}</option>    
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Docente Curso : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="Usr_IdUsuarioRol" name="Usr_IdUsuarioRol" required="" >
                                <option value="">Seleccionar Docente</option>
                                    {if  isset($docentes) && count($docentes)} 
                                        {foreach from=$docentes item=r}
                                            <option value="{$r.Usr_IdUsuarioRol}" {if $r.Usr_IdUsuarioRol == $datos.Usr_IdUsuarioRol}  selected="" {/if} >{$r.Usu_Nombre} {$r.Usu_Apellidos}</option>    
                                        {/foreach}
                                    {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Semestre Curso : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="Sem_IdSemestre" name="Sem_IdSemestre" required="" >
                                <option value="">Seleccionar Semestre</option>
                                    {if  isset($semestres) && count($semestres)} 
                                        {foreach from=$semestres item=r}
                                            <option value="{$r.Sem_IdSemestre}" {if $r.Sem_IdSemestre == $datos.Sem_IdSemestre}  selected="" {/if} >{$r.Sem_Ano} - {$r.Sem_Numero}</option>    
                                        {/foreach}
                                    {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Grupo Curso : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="editarSelGrupo" name="editarSelGrupo" required="" >
                                <option value="">Seleccionar Grupo</option>
                                <option value="1" {if $datos.Caa_Grupo == 1} selected="" {/if} >1</option>
                                <option value="2" {if $datos.Caa_Grupo == 2} selected="" {/if} >2</option>
                                <option value="3" {if $datos.Caa_Grupo == 3} selected="" {/if} >3</option>
                                <option value="4" {if $datos.Caa_Grupo == 4} selected="" {/if} >4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Tipo Carga Académica : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="editarSelTipoCargaAcademica" name="editarSelTipoCargaAcademica" required="" >
                                <option value="">Seleccionar Tipo Carga Académica</option>
                                <option value="1" {if $datos.Caa_Tipo == 1} selected="" {/if} >ÚNICO</option>
                                <option value="2" {if $datos.Caa_Tipo == 2} selected="" {/if} >COMPARTIDO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Vacantes : </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="editarVacantes" min="1" max="40"  type="number" name="editarVacantes" placeholder="Cantidad de Alumnos Permitidos" value="{$datos.Caa_Vacantes}" required="" />
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" type="submit" id="bt_editarHorarioCarga" name="bt_editarHorarioCarga" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                        </div>
                        <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                            <button class="btn btn-danger" type="submit" id="bt_cancelarEditarHorarioCarga" name="bt_cancelarEditarHorarioCarga" ><i class="glyphicon glyphicon-remove"> </i>&nbsp; {$lenguaje.button_cancel}</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>  
    </div>

    <!-- Agregar Horario -->
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title "><i style="float:right" class="glyphicon glyphicon-option-vertical"></i><i class="glyphicon glyphicon-time"></i>&nbsp;&nbsp;<strong>AGREGAR HORARIO</strong></h3>
        </div>
        <div class="panel-body" style="width: 90%; margin: 0px auto">
            <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form3" action="" method="post" >
                <!-- <input type="hidden" id="Fac_IdFacultad" name="Fac_IdFacultad" value="{$datos.Fac_IdFacultad}" /> -->
                <!-- <input type="hidden" id="idIdiomaSeleccionado" name="idIdiomaSeleccionado" value="{$datos.Idi_IdIdioma}" /> -->
                
                <div class="form-group">    
                    <label class="col-lg-2 control-label">Día : </label> 
                    <div class="col-lg-10">
                        <select class="form-control" id="Hor_Dia" name="Hor_Dia" required="" >
                            <option value="">Seleccionar Día</option>
                            <option value="1" >Lunes</option>
                            <option value="2" >Martes</option>
                            <option value="3" >Miércoles</option>
                            <option value="4" >Jueves</option>
                            <option value="5" >Viernes</option>
                            <option value="6" >Sábado</option>
                            <option value="7" >Domingo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">    
                    <label class="col-lg-2 control-label">Tipo de Horario : </label> 
                    <div class="col-lg-10">
                        <select class="form-control" id="Hor_Tipo" name="Hor_Tipo" required="" >
                            <option value="">Seleccionar de Tipo Horario</option>
                            <option value="1" >Teorico</option>
                            <option value="2" >Práctico</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">    
                    <label class="col-lg-2 control-label">Lugar de Clases : </label> 
                    <div class="col-lg-10">
                        <select class="form-control" id="Amb_IdAmbiente" name="Amb_IdAmbiente" required="" >
                            <option value="">Seleccionar Lugar de clases</option>
                                {if  isset($ambientes) && count($ambientes)} 
                                    {foreach from=$ambientes item=r}
                                        <option value="{$r.Amb_IdAmbiente}" >{$r.Amb_Nombre} ({$r.Amb_Direccion})</option>    
                                    {/foreach}
                                {/if}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Hora Inicio : </label>
                    <div class="col-lg-10">
                        <input class="form-control" id="Hor_Inicio" type="time" name="Hor_Inicio" placeholder="Cantidad de Alumnos Permitidos" required="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Hora Fin : </label>
                    <div class="col-lg-10">
                        <input class="form-control" id="Hor_Fin" type="time" name="Hor_Fin" placeholder="Cantidad de Alumnos Permitidos" required="" />
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                        <button class="btn btn-success" type="submit" id="bt_guardarHorario" name="bt_guardarHorario" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                    </div>
                    <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                        <button class="btn btn-danger" type="submit" id="bt_cancelarHorario" name="bt_cancelarHorario" ><i class="glyphicon glyphicon-remove"> </i>&nbsp; {$lenguaje.button_cancel}</button>
                    </div>
                </div>
            </form>
        </div>    
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>LISTA DE HORARIOS ACADÉMICOS</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="{$lenguaje.text_buscar_rol}" style="width: 150px; float: left; margin: 0px 10px;" name="palabraBusqueda" id="palabraBusqueda">
                    <button class="btn btn-success" style=" float: left" type="button" id="btnBuscarRegistros"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>
            <!-- <p style="direction: rtl"><a class="btn btn-primary" href="{$_layoutParams.root}carga_academica/index/nuevo_role"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a> </p> -->
            </div>
            <h4 class="panel-title"> <b>LISTA DE HORARIOS </b></h4>
            <input type="hidden" name="formulario" id="formulario" value="{$formulario}">
            <div id="listar{$formulario}" >
                {if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >Día </th>
                                <th >Tipo Horario </th>
                                <th style=" text-align: center">Lugar</th>
                                <th style=" text-align: center">Horas Inicio</th>
                                <th style=" text-align: center">Horas Fin</th>
                                <th style=" text-align: center">{$lenguaje.label_estado}</th>
                                {if $_acl->permiso("editar_rol")}
                                <th style=" text-align: center">{$lenguaje.label_opciones}</th>
                                {/if}
                            </tr>
                            {foreach item=rl from=$listaDatos}
                                <tr {if $rl.Row_Estado==0}
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$rl.Hor_Dia}</td>
                                    <td>            
                                        {if $rl.Hor_Tipo==1}
                                            Teoría
                                        {else}
                                            Práctica
                                        {/if}
                                    </td>
                                    <td class="text-center">{$rl.Hor_Inicio|default:" - "}</td>
                                    <td class="text-center">{$rl.Hor_Fin|default:" - "}</td>
                                    <td class="text-center">{$rl.Amb_Nombre|default:" - "}({$rl.Amb_Direccion|default:" - "})</td>
                                    <td style=" text-align: center">
                                        {if $rl.Hor_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                                        {/if}                            
                                        {if $rl.Hor_Estado==1}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                                        {/if}
                                    </td>
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-registro" title="{$lenguaje.tabla_opcion_cambiar_est}" id_registro="{$rl.Caa_IdCargaAcademica}" estado="{$rl.Caa_Estado}"> </a> -->
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-time" title="Editar Horario Carga Académica" href="{$_layoutParams.root}{$_layoutParams.modulo}/{$_layoutParams.controlador}/editarHorario/{$rl.Caa_IdCargaAcademica}"></a>

                                        <!-- <a   
                                        {if $rl.Row_Estado==0}
                                            data-toggle="tooltip" 
                                            class="btn btn-default btn-sm  glyphicon glyphicon-ok confirmar-habilitar-registro" title="{$lenguaje.label_habilitar}" 
                                        {else}
                                            data-book-id="{$rl.Fac_Nombre}"
                                            data-toggle="modal"  data-target="#confirm-delete"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-registro" title="{$lenguaje.label_eliminar}"
                                        {/if} 
                                        id_registro="{$rl.Caa_IdCargaAcademica}" data-placement="bottom" > </a> -->

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
