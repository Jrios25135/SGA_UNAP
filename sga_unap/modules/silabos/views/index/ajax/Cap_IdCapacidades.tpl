<div id="proceso_capa">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>CONTENIDOS:</strong>                       
                            </h3>
                        </div>
                        <textarea name="contenidos" class="form-control" id="contenidos" rows="5" placeholder="Escriba aquí...">{$proceso.Pra_Contenidos}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="row">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>ESTRATEGIAS DE ENSEÑANZA APRENDIZAJE:</strong>                       
                            </h3>
                        </div>
                        <textarea name="estra" class="form-control" id="estra" rows="5" placeholder="Escriba aquí...">{$proceso.Pra_Estrategias}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="row" >
                    <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>INDICADORES:</strong>                       
                                    </h3>
                                </div>
                         <div class="row panel-body" style="width: 94%; margin: 0px auto">
                                <div class="form-group">
                                    <label class="control-label" for="indc">Conceptuales: </label><br>
                                    {$instrume=explode("/",$proceso.Pra_Indicadores)}
                                    <textarea name="indc" class="form-control" id="indc" rows="5" placeholder="Escriba aquí...">{$instrume[0]}</textarea>
                                </div>
                        </div>
                         <div class="row" style="width: 90%; margin: 0px auto">
                                <div class="form-group">
                                    <label for="indp">Procedimentales:  </label><br>
                                    <textarea name="indp" class="form-control" id="indp" rows="5" placeholder="Escriba aquí...">{if isset($instrume[1])}{$instrume[1]}{/if}</textarea>
                                </div>
                        </div>
                     <div class="row" style="width: 90%; margin: 0px auto">
                            <div class="form-group">
                                <label for="inda">Actitudinales:  </label><br>
                                <textarea name="inda" class="form-control" id="inda" rows="5" placeholder="Escriba aquí...">{if isset($instrume[2])}{$instrume[2]}{/if}</textarea>
                            </div>
                    </div>
                </div>
                </div>
            </div>
             <div class="col-lg-10">
                    <div class="row" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>PROCEDIMIENTOS:</strong>                       
                                </h3>
                            </div>
                        <div class="panel-body">
                            <div class="form-group">
                        <input type='checkbox' id='proescrito' {if isset($proceso.Pra_Proc_escrito)} checked {/if} name='proescrito' value='escrito'>
                        <label for='escrito'>escrito</label>
                        
                        <input type='checkbox' id='prooral' {if isset($proceso.Pra_Proc_oral)} checked {/if} name='prooral' value='oral'> 
                        <label for='oral'>oral</label>
                        
                        <input type='checkbox'{if isset($proceso.Pra_Proc_observacion)} checked {/if} id='proobservacion' name='proobservacion' value='observacion'> 
                        <label for='observacion'>observacion</label>
                        <br>
                        
                        <label class="control-label" for="otros">otros (separar por un "/" cada procedimiento extra):  </label>
                        <textarea name="prootros" class="form-control" id="prootros" rows="1">{if isset($proceso.Pra_Proc_otros)}{$prootros=explode("/",$proceso.Pra_Proc_otros)}{foreach item=ro from=$prootros}{$ro}/{/foreach}{/if}</textarea>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                    <div class="row" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>INSTRUMENTOS:</strong>                       
                                </h3>
                            </div>
                        <div class="panel-body">
                            <div class="form-group">
                        <input type='checkbox' id='instrcuestionario' {if isset($proceso.Pra_Inst_cuestionario)} checked {/if} name='instrcuestionario' value='cuestionario'>
                        <label for='cuestionario'>cuestionario</label>
                        
                        <input type='checkbox' id='instrrubrica' {if isset($proceso.Pra_Inst_rubrica)} checked {/if} name='instrrubrica' value='rubrica'> 
                        <label for='rubrica'>rúbrica</label>
                        
                        <input type='checkbox' id='instrobservacion' {if isset($proceso.Pra_Inst_ficha)} checked {/if} name='instrobservacion' value='ficha de observacion'>
                        <label for='ficha de observacion'>ficha de observacion</label>
                        <br>
                        <label for="instrotros">otros (separar por un "/" cada instrumento extra):  </label>
                        <textarea name="instrotros" class="form-control" id="instrotros" rows="1">{if isset($proceso.Pra_Inst_otros)}{$prootros=explode("/",$proceso.Pra_Inst_otros)}{foreach item=ro from=$prootros}{$ro}/{/foreach}{/if}</textarea>
                    </div>
                </div>
                </div>
                </div>
            </div>
                    <div class="col-lg-10">
                    <div class="row" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>PONDERACIÓN:</strong>                       
                                </h3>
                            </div>
                        <div class="row panel-body">
                            <div class="col-lg-2">
                                <label>Conceptual:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="number" name="ponc" id="ponc" class="form-control" onkeypress="return valida(event)" value="{$proceso.Pra_Pond_Conceptual}">
                            </div>
                            <label class="col-lg-1" style="padding:0px">%</label>
                            <div class="col-lg-2">
                                <label>Procedimental:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="number" name="ponp" id="ponp" class="form-control" onkeypress="return valida(event)" value="{$proceso.Pra_Pond_Procedimental}">
                            </div>
                               <label class="col-lg-1" style="padding:0px">%</label>
                        </div>
                        <div class="row panel-body">
                            <div class="col-lg-2">
                                <label>Investigación Formativa:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="number" name="poni" id="poni" class="form-control" onkeypress="return valida(event)" value="{$proceso.Pra_Pond_Investigacion}">
                            </div>
                            <label class="col-lg-1" style="padding:0px">%</label>
                            <div class="col-lg-2">
                                <label>Actitudinal:</label>
                            </div>
                            <div class="col-lg-2">
                                <input type="number" name="pona" id="pona" class="form-control" onkeypress="return valida(event)" value="{$proceso.Pra_Pond_Actitudinal}">
                            </div>
                            <label class="col-lg-1" style="padding:0px">%</label>
                        </div>
                        </div>
                    </div>
                </div>
                </div>