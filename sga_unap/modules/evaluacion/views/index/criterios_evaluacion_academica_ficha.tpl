<div  class="container-fluid" >
    <div class="row" style="padding-left: 1.3em; padding-bottom: 20px;">
        <h4 style="width: 80%;  margin: 0px auto; text-align: center;">Informe del Avance Silábico y del desarrollo del aprendizaje</h4>
    </div>

    <form method="post">
        <div class="row" style=" padding-bottom: 20px; padding-top: 20px;">        
        <div class="col-lg-6"> 
            <div class="panel panel_default">                
                <div class="panel-heading">
                    <center> <h4 class="panel-title"><strong><u>Escala de Equivalencia de Puntaje</u></strong></h4></center>
                </div>
                <div class="panel-body" > 
                    <div class="table responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Escala</th>
                                    <th>Equivalencia</th>
                                    <th>Puntaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bueno</td>
                                    <td>Logra satisfactoriamente los requerimientos del indicador</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>En proceso</td>
                                    <td>Logra parcialmente los requerimientos del indicador</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Deficiente</td>
                                    <td>Logra deficientemente los requerimientos del indicador</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Ausente</td>
                                    <td>No se pudo observar</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-6"> 
            <div class="panel panel_default">
                <div class="col-lg-12 panel-body">
                    <label class="control-label">Escuela : </label>
                    <div>
                        <select class="form-control" name="escuelas" id="escuelas">
                            <option>--Seleccione--</option>
                        {if isset($escuelas) && count($escuelas)}
                        {foreach item=e from=$escuelas}
                             <option value="{$e.Esc_IdEscuela}" >{$e.Esc_Nombre}</option>
                        {/foreach}
                        {/if}
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 panel-body">
                    <label class="control-label">Docentes : </label>
                    <div >
                        <select class="form-control" name="docentes_escuela" id="docentes_escuela">
                            <option>--Seleccione--</option> 
                                {if isset($docentes_escuela) && count($docentes_escuela)}
                                {foreach item=doc from=$docentes_escuela}
                             <option value="{$doc.Usr_IdUsuarioRol|default:0}">{$doc.Usu_Nombre}</option>
                                {/foreach}
                                {/if}                               
                        </select>                           
                    </div>       
                </div>                                                 
                <div class="col-lg-12 panel-body">
                    <label class="control-label">Cursos : </label>
                    <div >
                         <select class="form-control" name="cursos_docente_escuela" id="cursos_docente_escuela">
                            <option>--Seleccione--</option> 
                                {if isset($cursos_docente_escuela) && count($cursos_docente_escuela)}
                                {foreach item=cur from=$cursos_docente_escuela}
                             <option value="{$cur.Cur_IdCurso|default:0}">{$cur.Cur_Nombre}</option>
                                {/foreach}
                                {/if}                               
                         </select>                           
                    </div>       
                </div> 
            </div> 
        </div>        
    </div>

    <div class="panel panel-default">                             
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BUSCAR ITEM DE FICHA</strong>                       
            </h3>
        </div>
        <div class="panel-body" style=" margin: 15px">
            <div class="row" style="text-align:right">
                <div style="display:inline-block;padding-right:2em">
                    <input class="form-control" placeholder="Buscar item" style="width: 150px; float: left; margin: 0px 10px;" name="palabra_criterio" id="palabra_criterio">
                    <button class="btn btn-success" style=" float: left" type="button" id="buscar_criterio_evaluacion_academica_ficha"  ><i class="glyphicon glyphicon-search"></i></button>
                </div>            
            </div>
            <h4 class="panel-title"> <b>LISTA DE CRITERIOS</b></h4>
            <div id="listar_criterios_evaluacion_academica_ficha" >
                {if isset($criterios_evaluacion_academica_ficha) && count($criterios_evaluacion_academica_ficha)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">N°</th>
                                <th>Planificación</th>                         
                                <th>Tipo</th>           
                                <th >Puntaje</th>                       
                            </tr>
                            {$contador=1}
                            {foreach item=cri from=$criterios_evaluacion_academica_ficha}
                                <tr {if $cri.Row_Estado==0}
                                        
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$cri.Cea_Nombre}</td>                  
                                    <td>{$cri.Tce_Nombre}</td>                                                                                                       
                                    <td>
                                        <select class="form-control" name="criterio{$contador}" id="criterio{$contador}">
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{0}">0</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{1}">1</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{2}">2</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{3}">3</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{4}">4</option>
                                        </select>
                                    </td>   
                                    <input type="hidden" id="contador" name="contador" value="{$contador++}"></input>                                       
                                </tr>
                            {/foreach}
                            <tfooter>
                                <button class="btn btn-success" type="submit" id="bt_guardar_evaluacion" name="bt_guardar_evaluacion" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Guardar</button>                              
                            </tfooter>
                        </table>
                    </div>
                    {$paginacion|default:""}
                {else}
                    {$lenguaje.no_registros}
                {/if}                   
            </div>
        </div>
    </div>
    </form>         

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
                <p>Eliminar: <strong  class="nombre-es">Criterio</strong></p>
                <label id="texto_" name='texto_'></label>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a style="cursor:pointer"  data-dismiss="modal" class="btn btn-danger danger eliminar_criterio">Eliminar</a>
            </div>
        </div>
    </div>
</div>