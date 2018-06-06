<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">ADMINISTRACIÓN DE ASISTENCIAS DEL DOCENTE</h4>
    </div>
    {if $_acl->permiso("agregar_rol")}
    <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right" class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>REGISTRAR ASISTENCIA</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_rol" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >       
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Escuela: </label>
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

