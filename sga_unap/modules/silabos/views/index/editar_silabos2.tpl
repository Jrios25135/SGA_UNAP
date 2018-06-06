    <div class="panel-body" style=" margin: 15px">
            <div class="row" >
            <div class="panel panel-default">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edición de Sílabos
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-pencil"></i> Agregue o modifique las capacidades para cada competencia.
                    </li>
                </ol>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                20% Completado
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li><a>1. Datos Generales</a></li>
            <li class="active"><a>2. Competencias y Capacidades</a></li>
            <li><a>3. Proceso de Aprendizaje</a></li>
            <li><a>4. Cronograma</a></li>
            <li><a>5. Calificación y Bibliografia</a></li>
        </ul><br>

        <div class="row">
            <div class="col-lg-10">
                <h3>Información actual</h3>
                <div class="col-lg-7">
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead><th>Competencia</th><th>Capacidad</th><th>Accion</th></thead>
                            <tbody>
                        {$mos=0}
                        {foreach item=rl from=$comp}
                            {$mos = $mos+1}
                            {if $rl.Com_Nro==1}
                            {$conteo = count($cap1)}
                            {if $conteo!=0}
                            <tr>
                                    <td rowspan='{$conteo}'><label>Competencia {$mos}: <br>{$rl.Com_Descripcion}</label></td>
                                {foreach item=rm from=$cap1}
                                    
                                    <td>
                                    {$rm.Cap_Descripcion}</td>
                                    <td> <a data-book-id-cap="{$rm.Cap_IdCapacidades}"    data-book-id="{$rm.Cap_Descripcion}" data-toggle="modal"  data-target="#confirm-editar" class="btn btn-default btn-sm  glyphicon glyphicon-trash glyphicon-edit" title="Editar" id_rol="{$rm.Cap_IdCapacidades}" data-placement="bottom" > </a>
                                    <a data-book-id-cap="{$rm.Cap_IdCapacidades}"   data-book-id="{$rm.Cap_Descripcion}" data-toggle="modal"  data-target="#confirm-delete2"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="Eliminar" id_rol="{$rm.Cap_IdCapacidades}" data-placement="bottom" > </a>
                                    </td>
                                    </tr>
                                {/foreach}
                                {else}
                                <tr>
                                    <td><label>Competencia {$mos}: <br>{$rl.Com_Descripcion}</label></td>
                                    <td colspan="2">No se han registrado capacidades</td>
                                </tr>
                            {/if}
                            {/if}
                            {if $rl.Com_Nro==2}
                            {$conteo = count($cap2)}
                            {if $conteo!=0}
                                <td rowspan='{$conteo}'><label>Competencia {$mos}: <br>{$rl.Com_Descripcion}</label></td>
                                {foreach item=rm from=$cap2}
                                    <td>
                                    {$rm.Cap_Descripcion}</td>
                                    <td> <a data-book-id-cap="{$rm.Cap_IdCapacidades}"   data-book-id="{$rm.Cap_Descripcion}" data-toggle="modal"  data-target="#confirm-editar" class="btn btn-default btn-sm  glyphicon glyphicon-trash glyphicon-edit" title="Editar" id_rol="{$rm.Cap_IdCapacidades}" data-placement="bottom" > </a>
                                    <a data-book-id-cap="{$rm.Cap_IdCapacidades}" data-book-id="{$rm.Cap_Descripcion}" data-toggle="modal"  data-target="#confirm-delete2"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="Eliminar" id_rol="{$rm.Cap_IdCapacidades}" data-placement="bottom" > </a>
                                    </td>
                                    </tr>
                                {/foreach}
                                 {else}
                                <tr>
                                    <td><label>Competencia {$mos}: <br>{$rl.Com_Descripcion}</label></td>
                                    <td colspan="2">No se han registrado capacidades</td>
                                </tr>
                            {/if}
                            {/if}
                            {if $rl.Com_Nro==3}
                            {$conteo = count($cap3)}
                            {if $conteo!=0}
                                <td rowspan='{$conteo}'><label>Competencia {$mos}: <br>{$rl.Com_Descripcion}</label></td>
                                {foreach item=rm from=$cap3}
                                    <td>
                                    {$rm.Cap_Descripcion}</td>
                                     <td> <a data-book-id-cap="{$rm.Cap_IdCapacidades}"  data-book-id="{$rm.Cap_Descripcion}" data-toggle="modal"  data-target="#confirm-editar" class="btn btn-default btn-sm  glyphicon glyphicon-trash glyphicon-edit" title="Editar" id_rol="{$rm.Cap_IdCapacidades}" data-placement="bottom" > </a>
                                    <a data-book-id-cap="{$rm.Cap_IdCapacidades}" data-book-id="{$rm.Cap_Descripcion}" data-toggle="modal"  data-target="#confirm-delete2"
                                            class="btn btn-default btn-sm  glyphicon glyphicon-trash confirmar-eliminar-rol" title="Eliminar" id_rol="{$rm.Cap_IdCapacidades}" data-placement="bottom" > </a>
                                    </td>
                                    </tr>
                                {/foreach}
                                {else}
                                <tr>
                                    <td><label>Competencia {$mos}: <br>{$rl.Com_Descripcion}</label></td>
                                    <td colspan="2">No se han registrado capacidades</td>
                                </tr>
                            {/if}
                            {/if}
                        {/foreach}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
        <div class="panel-heading jsoftCollap">
            <h3 aria-expanded="false" data-toggle="collapse" href="#collapse3" class="panel-title collapsed"><i style="float:right"class="fa fa-ellipsis-v"></i><i class="fa fa-user-secret"></i>&nbsp;&nbsp;<strong>Nueva capacidad</strong></h3>
        </div>
        <div style="height: 0px;" aria-expanded="false" id="collapse3" class="panel-collapse collapse">
            <div id="nuevo_rol" class="panel-body" style="width: 90%; margin: 0px auto">
                <form class="form-horizontal" data-toggle="validator" id="form3" role="form" name="form1" action="" method="post" >       
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Seleccione Competencia: </label>
                        <div class="col-lg-10">
                            <select name="compete" class="form-control">
                                {$mos_=0}
                                {$i=3}
                                {foreach item=rl from=$comp}
                                    {$con=$i-1}
                                    {$mos_=$mos_ + 1}
                                    {$id_comp=$rl.Com_Descripcion}
                                    <option value='{$rl.Com_IdCompetencias}'>Competencia {$mos_}</option>";
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Escriba Capacidad: </label>
                        <div class="col-lg-10">
                           <textarea name="cap" class="form-control" id="cap" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit" id="guardar" name="guardar" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <form class="form-horizontal" role="form" action="" method="post" >
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
            <button class="btn btn-primary" type="submit" name="enviar" id="enviar" value="enviar" ><i class="icon-plus-sign icon-white"> </i>Continuar</button>
            </div>
        </div>
        </form>
    </div>
         </div>
        <!-- /.container-fluid -->
    </div>
        </div>
<div class="modal " id="confirm-editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Editar capacidad</h4>
            </div>
            <form class="form-horizontal" role="form" action="" method="post" >
            <div class="modal-body">
                <div class="form-group">
                        <label class="col-lg-2 control-label">Escriba Capacidad: </label>
                        <div class="col-lg-10">
                            <input type="hidden" id="idcap" name="idcap" >
                           <textarea name="texto_editar" class="form-control" id="texto_editar" rows="5" required></textarea><br>
                        </div>
                </div>
            </div>

            <div class="modal-footer">   
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" type="submit" id="editar" name="editar" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; {$lenguaje.button_ok}</button>   
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal " id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminación</h4>
            </div>
            <form class="form-horizontal" role="form" action="" method="post" >
            <div class="modal-body">
                <p>Estás a punto de borrar una capacidad, este procedimiento es irreversible</p>
                <p>¿Deseas Continuar?</p>
                <p>Eliminar: <strong  class="nombre-es"></strong></p>
                <input type="hidden" id="idcap" name="idcap" >
                <label id="texto_" name='texto_'></label>
                <!-- <input type='text' class='form-control' name='codigo' id='validate-number' placeholder='Codigo' required> --> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" type="submit" id="eliminar" name="eliminar" ><i class="glyphicon glyphicon-floppy-disk"> </i>&nbsp; Eliminar</button>  
            </div>
            </form>
        </div>
    </div>
</div>

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