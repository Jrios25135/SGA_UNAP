<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRACIÓN DE CARGA ACADÉMICA</h4>
    </div>
    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right" class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>NUEVA CARGA ACADÉMICA</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_rol" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >       
                    
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
                                        <option value="{$r.Cui_IdCurricula}">{$r.Cui_Nombre} - {$r.Cui_Codigo}</option>    
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
                                        <option value="{$r.Cur_IdCurso}">{$r.Cur_Nombre}</option>    
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
                                            <option value="{$r.Usr_IdUsuarioRol}">{$r.Usu_Nombre} {$r.Usu_Apellidos}</option>    
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
                                            <option value="{$r.Sem_IdSemestre}">{$r.Sem_Ano} - {$r.Sem_Numero}</option>    
                                        {/foreach}
                                    {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Grupo Curso : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="nuevoSelGrupo" name="nuevoSelGrupo" required="" >
                                <option value="">Seleccionar Grupo</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">    
                        <label class="col-lg-2 control-label">Tipo Carga Académica : </label> 
                        <div class="col-lg-10">
                            <select class="form-control" id="nuevoSelTipoCargaAcademica" name="nuevoSelTipoCargaAcademica" required="" >
                                <option value="">Seleccionar Tipo CArga Académica</option>
                                <option value="1">ÚNICO</option>
                                <option value="2">COMPARTIDO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Vacantes : </label>
                        <div class="col-lg-10">
                            <input class="form-control" id="nuevoVacantes" min="1" max="40"  type="number" name="nuevoVacantes" placeholder="Cantidad de Alumnos Permitidos" required="" />
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit" id="bt_guardarCargaAcademica" name="bt_guardarCargaAcademica" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {/if}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BUSCAR CARGAS ACADÉMICAS</strong>                       
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
            <h4 class="panel-title"> <b>LISTA DE CARGAS ACADEMICAS</b></h4>
            <input type="hidden" name="formulario" id="formulario" value="{$formulario}">
            <div id="listar{$formulario}" >
                {if isset($listaDatos) && count($listaDatos)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">{$lenguaje.label_n}</th>
                                <th >Docente </th>
                                <th >Curso </th>
                                <th style=" text-align: center">Créditos</th>
                                <th style=" text-align: center">Horas Teorías</th>
                                <th style=" text-align: center">Horas Practicas</th>
                                <th style=" text-align: center">Grupo Curso</th>
                                <th style=" text-align: center">Tipo Curso</th>
                                <th style=" text-align: center">Semestre</th>
                                <th style=" text-align: center">N° Estudiantes</th>
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
                                    <td>{$rl.Docente}</td>
                                    <td>{$rl.Cur_Nombre|default:" - "}</td>
                                    <td class="text-center">{$rl.Cur_Creditos|default:" - "}</td>
                                    <td class="text-center">{$rl.Cur_HorasTeoria|default:" - "}</td>
                                    <td class="text-center">{$rl.Cur_HorasPractica|default:" - "}</td>
                                    <td class="text-center">{$rl.Caa_Grupo|default:" - "}</td>
                                    <td>{$rl.Cur_Tipo|default:" - "}</td>
                                    <td>{$rl.Semestre|default:" - "}</td>
                                    <td class="text-center">{$rl.Caa_Vacantes|default:" - "}</td>
                                    <td style=" text-align: center">
                                        {if $rl.Caa_Estado==0}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-remove-sign " title="{$lenguaje.label_denegado}" style="color: #DD4B39;"></p>
                                        {/if}                            
                                        {if $rl.Caa_Estado==1}
                                            <p data-toggle="tooltip" data-placement="bottom" class="glyphicon glyphicon-ok-sign " title="{$lenguaje.label_habilitado}" style="color: #088A08;"></p>
                                        {/if}
                                    </td>
                                    {if $_acl->permiso("editar_rol")}
                                    <td style=" text-align: center">
                                        <!-- <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-refresh estado-registro" title="{$lenguaje.tabla_opcion_cambiar_est}" id_registro="{$rl.Caa_IdCargaAcademica}" estado="{$rl.Caa_Estado}"> </a> -->
                                        
                                        <a data-toggle="tooltip" data-placement="bottom" class="btn btn-default btn-sm glyphicon glyphicon-time" title="Editar Horario Carga Académica" href="{$_layoutParams.root}{$_layoutParams.modulo}/{$_layoutParams.controlador}/editarHorarioCargaAcademica/{$rl.Caa_IdCargaAcademica}"></a>

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
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_registro">Eliminar</a>
            </div>
        </div>
    </div>
</div>