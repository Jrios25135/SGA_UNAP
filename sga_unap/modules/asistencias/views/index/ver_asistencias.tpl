<div class="panel-body" style=" margin: 15px">
    <div class="row" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>REPORTE DE ASISTENCIAS</strong>                       
                </h3>
            </div>
            <div class="panel-body" style=" margin: 15px">
                <form class="form-horizontal" role="form" method="post" action="" autocomplete="on">

                <div class="form-group">
                        <div class="col-lg-5">
                            <label for="fechaI">Desde:  </label><br>
                            <input type="date" class="form-control" name="fechaI" id="fechaI" required>
                        </div>
                        <div class="col-lg-5">
                            <label for="fechaF">Hasta:  </label><br>
                            <input type="date" class="form-control" name="fechaF" id="fechaF" required>
                        </div>
                        <div class="col-lg-2">
                            <div style="padding-right:2em">
                            <button class="btn btn-success" type="submit" id="buscar"  name="buscar"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                </div>
                </form>

                {if isset($fechas)}
                <div class="form-group">
                    <label for="act1">ASISTENCIAS</label>
                    <table class="table table-bordered">
                        <thead>
                        <th>Alumnos</th>
                        {foreach item=rs from=$fechas}
                        <th><center>{$rs.Asi_fecha}</center></th>
                        {/foreach}
                        </thead>
                        <tbody>
                            {for $i=0; $i<count($asistencias); $i++}
                                <tr> 
                                    <td>{$alumnos[$i]['Nombres']}</td>
                                        {$asistencia=$asistencias[$i]}
                                        {for $j=0; $j<count($asistencia); $j++}
                                            {if $asistencia[$j]['Asi_Asistio']==0}
                                            <td><center>Faltó</center></td>
                                            {else}
                                            <td><center>Asistió</center></td>
                                            {/if}
                                        {/for}
                                </tr>
                            {/for}
                        </tbody>
                    </table> 
                </div> 
                {/if}
            </div>
        </div>
    </div>
</div>