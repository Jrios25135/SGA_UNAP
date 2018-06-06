

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="tit-pagina-principal" align="center">Registro de DublinCore</h2>
        </div>  

        <!-- <div class="col-md-3">     
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>{$lenguaje["label_recurso_bdrecursos"]}</strong>
                        </h4>
                    </div>               
                    <div class="panel-body">
                        <table class="table table-user-information">
                            <tbody>                           
                                <tr>
                                    <td>{$lenguaje["label_nombre_bdrecursos"]}:</td>
                                    <td>{$recurso.Rec_Nombre}</td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["label_tipo_bdrecursos"]}</td>
                                    <td>{$recurso.Tir_Nombre}</td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["label_estandar_bdrecursos"]}</td>
                                    <td>{$recurso.Esr_Nombre}</td>
                                </tr>                                
                                <tr>
                                    <td>{$lenguaje["label_fuente_bdrecursos"]}</td>
                                    <td>{$recurso.Rec_Fuente}</td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["label_origen_bdrecursos"]}</td>
                                    <td>{$recurso.Rec_Origen}</td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["registros_bdrecursos"]}</td>
                                    <td>{$recurso.Rec_CantidadRegistros}</td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["herramienta_utilizada_bdrecursos"]}</td>
                                    <td>
                                        {if isset($recurso.herramientas)}
                                            <ul>
                                                {foreach item=herramienta from=$recurso.herramientas}
                                                    <li>
                                                        {$herramienta.Her_Nombre}
                                                    </li>
                                                {/foreach}
                                            </ul>
                                        {/if}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["registro_bdrecursos"]}</td>
                                    <td>{$recurso.Rec_FechaRegistro|date_format:"%d/%m/%y"}</td>
                                </tr>
                                <tr>
                                    <td>{$lenguaje["modificacion_bdrecursos"]}</td>
                                    <td>{$recurso.Rec_UltimaModificacion|date_format:"%d/%m/%y"}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="col-md-9"> 
            <div class="panel panel-default">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Formulario de Registro</strong>
                        </h4>
                    </div>
                    <div class="panel-body" id="gestion_idiomas">
                        <form data-toggle="validator" class="form-horizontal" role="form" enctype="multipart/form-data" method="post" id="registrardublin">

                            <div class="form-group">
                                <label for="titulo" class="col-md-4 control-label">Título</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Titulo" name="Dub_Titulo" 
                                           placeholder="titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="col-md-4 control-label">descripcion</label>
                                <div class="col-md-6">          
                                    <textarea class="form-control" rows="3" id="Dub_Descripcion" name="Dub_Descripcion" placeholder="Descripción"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="autor" class="col-md-4 control-label">Autor</label>
                                <div class="col-md-6">
                                    <input type="text" list="autores" class="form-control" id="Aut_IdAutor" name="Aut_IdAutor" placeholder="autor"/>
                                    <datalist id="autores" multiple="multiple>
                                        {foreach item=datos from=$autores}
                                            <option value="{$datos.Aut_Nombre}">
                                            {/foreach}    
                                    </datalist>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="autor" class="col-md-4 control-label">Autor</label>
                                 <div class="col-md-6">
                                    <select class="form-control js-example-basic-multiple" multiple= "multiple" name="autores[]" id="autores">                        
                                        {for $i=0;$i<count($autores);$i++}
                                            {$Aut_IdAutor = $autores[$i]['Aut_IdAutor']}
                                            <option value="{$Aut_IdAutor}">               {$autores[$i]['Aut_Nombre']
                                             }</option>
                                        {/for}
                              </select>
                              </div>
                            </div> -->
                            <div class="form-group">
                                <label for="editor" class="col-md-4 control-label">Editor</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Editor" name="Dub_Editor" 
                                           placeholder="editor">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="colaborador" class="col-md-4 control-label">Colaborador</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Colabrorador" name="Dub_Colabrorador" 
                                           placeholder="colaborador" >
                                </div>
                            </div>            
                            <div class="form-group">
                                <label for="fecha_documento" class="col-md-4 control-label">Fecha Documento</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="Dub_FechaDocumento" name="Dub_FechaDocumento"
                                           placeholder="dd/mm/yyyy" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formato" class="col-md-4 control-label">Formato</label>
                                <div class="col-md-3">
                                    <input type="text" list="formatos" class="form-control" id="Dub_Formato" name="Dub_Formato" placeholder="formato"/>
                                    <datalist id="formatos">
                                        {foreach item=datos from=$formatos_archivos}
                                            <option value="{$datos.Taf_Descripcion}"></option>
                                        {/foreach}    
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="identificador" class="col-md-4 control-label">Identificador</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Identificador" name="Dub_Identificador"
                                           placeholder="identificador">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fuente" class="col-md-4 control-label">Fuente</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Fuente" name="Dub_Fuente"
                                           placeholder="fuente">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dublin_idioma" class="col-md-4 control-label">Idioma</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Idioma" name="Dub_Idioma" 
                                           placeholder="idioma">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="relación_dublin" class="col-md-4 control-label">Relación</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Relacion" name="Dub_Relacion" 
                                           placeholder="relación">          
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cobertura_dublin" class="col-md-4 control-label">Cobertura</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Cobertura" name="Dub_Cobertura" 
                                           placeholder="cobertura">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="derechos_dublin" class="col-md-4 control-label">Derechos</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Dub_Derechos" name="Dub_Derechos"
                                           placeholder="derechos">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="palabras_claves" class="col-md-4 control-label">Palabras Claves</label>
                                <div class="col-md-6">  
                                    <input type="text" list="palabraclaves" class="form-control" id="Dub_PalabraClave" name="Dub_PalabraClave" placeholder="palabras claves"/>
                                    <datalist id="palabraclaves">
                                        {foreach item=datos from=$palabraclave}
                                            <option value="{$datos.Dub_PalabraClave}">
                                            {/foreach}    
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tipo_dublin" class="col-md-4 control-label">Tipo</label>
                                <div class="col-md-6">
                                    <input type="text" list="tiposdublin" class="form-control" id="Tid_IdTipoDublin" name="Tid_IdTipoDublin" placeholder="tipo"/>
                                    <datalist id="tiposdublin">
                                        {foreach item=datos from=$tipodublin}
                                            <option value="{$datos.Tid_Descripcion}">
                                            {/foreach}    
                                    </datalist>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="tema_dublin" class="col-md-4 control-label">Tema</label>
                                <div class="col-md-6">
                                    <input type="text" list="temasdublin" class="form-control" id="Ted_IdTemaDublin" name="Ted_IdTemaDublin" placeholder="tema"/>
                                    <datalist id="temasdublin">
                                        {foreach item=datos from=$temadublin}
                                            <option value="{$datos.Ted_Descripcion}">
                                            {/foreach}    
                                    </datalist>         
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="tematica_dublin" class="col-md-4 control-label">Temática</label>
                                <div class="col-md-6">
                                    <input type="text" list="tematicadublin" class="form-control" id="Tem_IdTematicaDublin" name="Tem_IdTematicaDublin" placeholder="tematica"/>
                                    <datalist id="tematicadublin">
                                        {foreach item=datos from=$tematicadublin}
                                            <option value="{$datos.Tem_Nombre}">
                                        {/foreach}    
                                    </datalist>         
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="exampleInputFile" class="col-md-4 control-label">Seleccione Archivo</label>
                                <div class="col-md-6">
                                    <input type="file" id="Arf_IdArchivoFisico" name="Arf_IdArchivoFisico">
                                </div>
                            </div>      
                            <div class="form-group">
                                <label for="url" class="col-md-4 control-label">URL</label>
                                <div class="col-md-6">
                                    <input type="text"  class="form-control" id="Arf_URL" name="Arf_URL"
                                           placeholder="url">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="pais" class="col-md-4 control-label">País</label>
                                <div class="col-md-6">
                                    <input type="text"  class="form-control" id="Pai_IdPais" name="Pai_IdPais"
                                           placeholder="pais">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-6">
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                    <input type="hidden" value="1" name="registrar" />
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>





    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p><center>{$mensaje}</center></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>



