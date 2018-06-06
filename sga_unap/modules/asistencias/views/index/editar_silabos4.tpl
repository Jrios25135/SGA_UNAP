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
                        <i class="fa fa-pencil"></i> Registro de las semanas para actitudes y capacidades
                    </li>
                </ol>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
                 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                60% Completado
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li><a>1. Datos Generales</a></li>
            <li><a>2. Competencias y Capacidades</a></li>
            <li><a>3. Proceso de Aprendizaje</a></li>
            <li class="active"><a>4. Cronograma</a></li>
            <li><a>5. Calificación y Bibliografia</a></li>
        </ul><br>
        <form action="" method="post" name="agregarsilabo4" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $listar_silabo1; ?>">
            <div class="form-group">
                    <div class="row">
                    <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>CRONOGRAMA</strong>                  
                        </h3>
                    </div>
                </div>
            </div>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <th>Capacidades y Actitudes/Semanas</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                            <th>15</th>
                            <th>16</th>
                            <th>17</th>
                            <tr>
                            <td>
                                <strong>A.1. </strong>{$sil['Sil_Actitud1']}<br>
                            </td>
                                {for $sele=1;$sele<18;$sele++}
                                    <td style="vertical-align:middle"><input type='checkbox' id='{$sele}' name='ct1semana{$sele}' {foreach item=rl from=$act1}{if $rl.Acs_Semana=="semana"|cat:$sele}checked{/if}{/foreach} value='semana{$sele}'></td>
                                {/for}

                                <td style="vertical-align:middle">
                                Todos <input name="g1T" type="checkbox" onclick="grupo('ct1semana', this.checked)">
                                </td>
                            </tr>
                            <tr>
                            <td>
                                <strong>A.2. </strong>{$sil['Sil_Actitud2']}<br>
                            </td>
                                {for $sele=1;$sele<18;$sele++}
                                    <td style="vertical-align:middle"><input type='checkbox' id='{$sele}' {foreach item=rl from=$act2}{if $rl.Acs_Semana=="semana"|cat:$sele}checked{/if}{/foreach} name='ct2semana{$sele}' value='semana{$sele}'></td>
                                {/for}
                                <td style="vertical-align:middle">
                                Todos <input name="g2T" type="checkbox" onclick="grupo('ct2semana', this.checked)">
                                </td>
                            </tr>
                            <td>
                                <strong>A.3. </strong>{$sil['Sil_Actitud3']}<br>
                            </td>
                                {for $sele=1;$sele<18;$sele++}
                                    <td style="vertical-align:middle"><input type='checkbox' id='{$sele}' {foreach item=rl from=$act3}{if $rl.Acs_Semana=="semana"|cat:$sele}checked{/if}{/foreach} name='ct3semana{$sele}'  value='semana{$sele}'></td>
                                {/for}
                                <td style="vertical-align:middle">
                                Todos <input name="g3T" type="checkbox" onclick="grupo('ct3semana', this.checked)">
                                </td>
                            </tr>
                            {$contCapa=1}
                             {foreach item=rl from=$cap}
                                    <tr><td><strong>C.{$contCapa}</strong>{$rl.Cap_Descripcion}<br></td>
                                    {for $sele=1;$sele<18;$sele++}
                                    <td style="vertical-align:middle">
                                    <input type='checkbox' id='{$sele}' name='ct{($contCapa+3)}semana{$sele}' value='semana{$sele}' {foreach item=rm from=$capsem}{if $rm.Cap_IdCapacidad==$rl.Cap_IdCapacidades && $rm.Cas_Semana=="semana"|cat:$sele }checked{/if}{/foreach}></td>
                                    {/for}
                                     <td style="vertical-align:middle">
                                Todos <input name="g{($contCapa+3)}T" type="checkbox" onclick="grupo('ct{($contCapa+3)}semana', this.checked)">
                                </td></tr>
                                    {$contCapa=$contCapa+1}
                                      {/foreach}
                                
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit" name="enviar" id="enviar" value="enviar" ><i class="icon-plus-sign icon-white"> </i>Continuar</button>
                        </div>
                    </div>
                </div>
        </form><br>
    </div>
     </div>
        <!-- /.container-fluid -->
    </div>
        </div>