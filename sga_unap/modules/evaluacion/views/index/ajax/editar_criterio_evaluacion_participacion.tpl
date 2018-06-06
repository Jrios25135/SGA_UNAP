<div  class="container-fluid" >    
    <div id='gestion_idiomas_rol'>        
        <div class="panel panel-default">
            <div class="panel-heading ">
                <h3 class="panel-title "><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>Editar criterio</strong></h3>
            </div>
            <div id="nuevo_criterio" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >
                    <input type="hidden" id="id_criterio" name="id_criterio" value="{$datos.Cep_IdCriterioEvaluacionParticipacionDocente}" />                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Criterio: </label>
                        <div class="col-lg-10">
                            <input class="form-control"  value="{$datos.Cep_Nombre}" id="criterio"  type="text" name="criterio" placeholder="Criterio" required="" />
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-2 col-lg-offset-2 col-lg-2">
                            <button class="btn btn-success" type="submit" id="bt_editar_criterio_evaluacion_participacion" name="bt_editar_criterio_evaluacion_participacion" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Guardar</button>
                        </div>
                        <div class="col-xs-6 col-sm-offset-1 col-sm-2 col-lg-2">
                            <button class="btn btn-danger" type="submit" id="bt_cancelar_editar_criterio" name="bt_cancelar_editar_criterio" ><i class="glyphicon glyphicon-remove"> </i>&nbsp; Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
