{if isset($criterios_evaluacion_academica_ficha) && count($criterios_evaluacion_academica_ficha)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">N°</th>
                                <th>Planificación</th>                         
                                <th>Tipo</th>           
                                <th >Escala</th>                       
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
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{1}">1</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{2}">2</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{3}">3</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{4}">4</option>
                                            <option value="{$cri.Cea_IdCriterioEvaluacionAcademicaDocente}{5}">5</option>
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