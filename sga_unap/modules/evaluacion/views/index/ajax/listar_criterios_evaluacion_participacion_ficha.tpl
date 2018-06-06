{if isset($criterios_evaluacion_participacion_ficha) && count($criterios_evaluacion_participacion_ficha)}
                    <div class="table-responsive">
                        <table class="table" style="  margin: 20px auto">
                            <tr>
                                <th style=" text-align: center">N°</th>
                                <th>Planificación</th>                                                         
                                <th >Escala</th>                       
                            </tr>
                            {$contador=1}
                            {foreach item=cri from=$criterios_evaluacion_participacion_ficha}
                                <tr {if $cri.Row_Estado==0}
                                        
                                        {if $_acl->permiso("ver_eliminados")}
                                            class="btn-danger"
                                        {else}
                                            hidden {$numeropagina = $numeropagina-1}
                                        {/if}
                                    {/if} >
                                    <td style=" text-align: center">{$numeropagina++}</td>
                                    <td>{$cri.Cep_Nombre}</td>                  
                                                                                    
                                    <td>
                                        <select class="form-control" name="criterio{$contador}" id="criterio{$contador}">
                                            <option value="{$cri.Cep_IdCriterioEvaluacionParticipacionDocente}{0}">0</option>
                                            <option value="{$cri.Cep_IdCriterioEvaluacionParticipacionDocente}{1}">1</option>
                                            <option value="{$cri.Cep_IdCriterioEvaluacionParticipacionDocente}{2}">2</option>
                                            <option value="{$cri.Cep_IdCriterioEvaluacionParticipacionDocente}{3}">3</option>
                                            <option value="{$cri.Cep_IdCriterioEvaluacionParticipacionDocente}{4}">4</option>
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