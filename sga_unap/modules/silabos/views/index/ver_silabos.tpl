    <div class="panel-body" style=" margin: 15px">
            <div class="row" >
            <div class="panel panel-default">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">

                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <center><h2>SILABO</h2></center>
                <h4><b>1. INFORMACION GENERAL</b></h4>
                <p>1.1 NOMBRE:  {$silabo.Cur_Nombre} </p>
                <p>1.2 CODIGO: {$silabo.Cur_Codigo}</p>
                <p>1.3 CREDITOS: {$silabo.Cur_Creditos}</p>
                <p>1.4 HORAS TEORICAS: {$silabo.Cur_HorasTeoria}</p>
                <p>1.5 HORAS DE PRACTICA: {$silabo.Cur_HorasPractica}</p>
                <p>1.6 TIPO: {$silabo.CurTipo}</p>
                <p>1.7 DURACION: {$silabo.Cur_Semanas}</p>
                <p>1.8 SEMESTRE ACADEMICO: {$silabo.Cur_Semanas}</p>
                <p>1.9 CICLO: {$silabo.Cur_Codigo}</p>
                <p>1.10 FACULTAD: {$silabo.Fac_Nombre}</p>
                <p>1.11 ESC. DE FORM. PROF: {$silabo.Cur_Codigo}</p>
                <p>1.12 DOCENTE:{$silabo.Usu_Nombre} {$silabo.Usu_Apellidos}</p>
                <p>1.13 CORREO ELECTRONICO: {$silabo.Usu_Email}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <div class="form-group">
                    <h4><b>2. COMPETENCIA GENERAL:</b></h4>
                    <p>{$silabo.Sil_CompetenciaGeneral}</p>
                </div>
                <div class="form-group">
                    <h4><b>3. SUMILLA:</b></h4>
                    <p>{$silabo.Sil_Sumilla}</p>
                </div>
                <div class="form-group">
                    <label for="act1">4. COMPETENCIAS ESPECIFICAS, CAPACIDADES Y ACTITUDES:</label>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <th>Competencias</th>
                            <th>Capacidades</th>
                            <th>Actitudes</th>
                        </thead>
                        <tr>
                        {$contCapa=1}
                        {$i=0}
                        {foreach item=rl from=$comp}
                            <tr>
                                <td><strong>Competencia N° {($i+1)}</strong><br>{$rl.Com_Descripcion}</td>
                            <td>
                                {if $i==0}
                                {foreach item=rk from=$cap1}
                                    <strong>C.{$contCapa}.</strong>{$rk.Cap_Descripcion}<br><br>
                                    {$contCapa=$contCapa+1}
                                {/foreach}
                                {/if}
                                {if $i==1}
                                    <strong>C.{$contCapa}.</strong>{$cap2.Cap_Descripcion}<br><br>
                                    {$contCapa=$contCapa+1}
                                {/if}
                                {if $i==2}
                                    <strong>C.{$contCapa}.</strong>{$cap3.Cap_Descripcion}<br><br>
                                    {$contCapa=$contCapa+1}
                                {/if}
                                
                            </td>
                            {if $i==0}
                            <td rowspan="3">
                                <strong>A.1. </strong>{$silabo.Sil_Actitud1}<br><br>
                                <strong>A.2. </strong>{$silabo.Sil_Actitud2}<br><br>
                                <strong>A.3. </strong>{$silabo.Sil_Actitud3}
                            </td>
                            {/if}
                            {$i=$i+1}
                        </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="act1">5. PROGRAMACION DEL PROCESO DE APRENDIZAJE:</label>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <th>Capacidades y Actitudes</th>
                            <th>Contenidos</th>
                            <th>Estrategias de enseñanza - aprendizaje</th>
                            <th>Indicadores / comportamientos observables</th>
                            <th>Procedimientos</th>
                            <th>Instrumentos</th>
                            <th>Ponderación</th>
                        </thead>
                        <tbody>
                        {$j=0}
                        {foreach item=rm from=$proc}
                                <tr>
                                    <td><strong>C{($j+1)}(E-A)</strong>{$rm.Cap_Descripcion}<br><br>
                                        <strong>(IF)</strong>{$cap2.Cap_Descripcion}<br><br>
                                        <strong>(EX)</strong>{$cap3.Cap_Descripcion}<br><br>
                                        <strong>Actitudes<br>A.1. </strong>{$silabo.Sil_Actitud1}<br>
                                        <strong>A.2. </strong>{$silabo.Sil_Actitud2}<br> 
                                        <strong>A.3. </strong>{$silabo.Sil_Actitud3}
                                        </td>
                                        <td>{$rm.Pra_Contenidos}</td>
                                        <td>{$rm.Pra_Estrategias}</td>
                                        <td>{$instrume=explode("/",$rm.Pra_Indicadores)}
                                        {if isset($instrume[0])}
                                            <strong>Conceptual:</strong><br>{$instrume[0]}<br><br>
                                        {/if}
                                        {if isset($instrume[1])}
                                            <strong>Procedimental:</strong><br>{$instrume[1]}<br><br>
                                        {/if}
                                        {if isset($instrume[2])}
                                            <strong>Actitudinal:</strong><br>{$instrume[2]}
                                        {/if}
                                        </td>
                                        <td>{if isset($rm.Pra_Proc_escrito)}
                                            {$rm.Pra_Proc_escrito}<br><br>
                                        {/if}
                                        {if isset($rm.Pra_Proc_oral)}
                                            {$rm.Pra_Proc_oral}<br><br>
                                        {/if}
                                        {if isset($rm.Pra_Proc_observacion)}
                                            {$rm.Pra_Proc_observacion}<br><br>
                                        {/if}
                                        {if isset($rm.Pra_Proc_otros)}
                                            {$proces=explode("/",$rm.Pra_Proc_otros)}
                                                {foreach item=ro from=$proces}
                                                {$ro}<br><br>
                                                {/foreach}
                                        {/if}
                                        </td>
                                        <td>{if isset($rm.Pra_Inst_cuestionario)}
                                            {$rm.Pra_Inst_cuestionario}<br><br>
                                        {/if}
                                        {if isset($rm.Pra_Inst_rubrica)}
                                            {$rm.Pra_Inst_rubrica}<br><br>
                                        {/if}
                                        {if isset($rm.Pra_Inst_ficha)}
                                            {$rm.Pra_Inst_ficha}<br><br>
                                        {/if}
                                        {if isset($rm.Pra_Inst_otros)}
                                            {$proceso=explode("/",$rm.Pra_Inst_otros)}
                                                {foreach item=rot from=$proceso}
                                                {$rot}<br><br>
                                                {/foreach}
                                        {/if}
                                        </td>
                                        <td>
                                            <strong>Conceptual:</strong><br>{$rm.Pra_Pond_Conceptual}%<br><br>
                                            <strong>Procedimental:</strong><br>{$rm.Pra_Pond_Procedimental}%<br><br>
                                            <strong>Investigación Formativa:</strong><br>{$rm.Pra_Pond_Investigacion}%<br><br>
                                            <strong>Actitudinal:</strong><br>{$rm.Pra_Pond_Actitudinal}%
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                            ?>
                            <?php
                        }
                        ?>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="act1">6. CRONOGRAMA:</label>
                    <table class="table table-bordered">
                        <thead>
                        <th>Actitudes y Capacidades / Tiempo</th>
                        <th colspan="17"><center>Semanas</center><th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Criterios</td>
                            {for $semancol=1;$semancol<18;$semancol++}
                                <td>{$semancol}</td>
                            {/for}
                        </tr>
                        <!--/*  actitudes  */ -->
                        <tr>
                            {$ultimo=0}
                            <td>{$silabo.Sil_Actitud1}</td>
                            {$inicio_bucle=1}
                            {for $eleSem=0;$eleSem<17;$eleSem++}
                                {if isset($act1[$eleSem]['Acs_Semana'])}
                                    {$semana =$act1[$eleSem]['Acs_Semana']}
                                    {$num_semana_ = explode('a',$semana)}
                                    {$num_semana=$num_semana_[2]}
                                    {for $contando = $inicio_bucle;$contando<18;$contando++ }
                                        {if $num_semana == $contando }
                                            <td style='background-color: #d43f3a'>    X    </td>
                                            {$inicio_bucle = $num_semana + 1}
                                            {$contando = 19}
                                            {$ultimo = $num_semana}
                                        {else}
                                            <td></td>
                                        {/if}
                                    {/for}
                                {/if}
                            {/for}
                            {for $fa = 1;$fa<18-$ultimo;$fa++}
                                <td></td>
                            {/for}
                        </tr>
                        <tr>
                            {$ultimo=0}
                            <td>{$silabo.Sil_Actitud2}</td>
                            {$inicio_bucle=1}
                            {for $eleSem=0;$eleSem<17;$eleSem++}
                                {if isset($act2[$eleSem]['Acs_Semana'])}
                                    {$semana =$act2[$eleSem]['Acs_Semana']}
                                    {$num_semana_ = explode('a',$semana)}
                                    {$num_semana=$num_semana_[2]}
                                    {for $contando = $inicio_bucle;$contando<18;$contando++ }
                                        {if $num_semana == $contando }
                                            <td style='background-color: #d43f3a'>    X    </td>
                                            {$inicio_bucle = $num_semana + 1}
                                            {$contando = 19}
                                            {$ultimo = $num_semana}
                                        {else}
                                            <td></td>

                                        {/if}
                                    {/for}
                                {/if}
                            {/for}
                            {for $fa = 1;$fa<18-$ultimo;$fa++}
                                <td></td>
                            {/for}
                        </tr>
                       <tr>
                            {$ultimo=0}
                            <td>{$silabo.Sil_Actitud3}</td>
                            {$inicio_bucle=1}
                            {for $eleSem=0;$eleSem<17;$eleSem++}
                                {if isset($act3[$eleSem]['Acs_Semana'])}
                                    {$semana =$act3[$eleSem]['Acs_Semana']}
                                    {$num_semana_ = explode('a',$semana)}
                                    {$num_semana=$num_semana_[2]}
                                    {for $contando = $inicio_bucle;$contando<18;$contando++ }
                                        {if $num_semana == $contando }
                                            <td style='background-color: #d43f3a'>    X    </td>
                                            {$inicio_bucle = $num_semana + 1}
                                            {$contando = 19}
                                            {$ultimo = $num_semana}
                                        {else}
                                            <td></td>

                                        {/if}
                                    {/for}
                                {/if}
                            {/for}
                            {for $fa = 1;$fa<18-$ultimo;$fa++}
                                <td></td>
                            {/for}
                        </tr>
                            {foreach item=rs from=$cap1}
                                {$semanas=array()}
                                {$cont=0}
                                {for $i=0; $i<count($capsem); $i++ }
                                {if $rs.Cap_IdCapacidades==$capsem[$i]['Cap_IdCapacidad']}
                                {$semanas[$cont]=$capsem[$i]}
                                {$cont=$cont+1}
                                {/if}
                                {/for}
                                <tr>
                                <td>{$rs.Cap_Descripcion}</td>
                                    {$inicio_bucle=1}
                                    {for $eleSem=0;$eleSem<17;$eleSem++}
                                        {if isset($semanas[$eleSem]['Cas_Semana'])}
                                            {$semana =$semanas[$eleSem]['Cas_Semana']}
                                            {$num_semana_ = explode('a',$semana)}
                                            {$num_semana=$num_semana_[2]}
                                            {for $contando = $inicio_bucle;$contando<18;$contando++}
                                                {if $num_semana == $contando }
                                                    <td style='background-color: #d43f3a'>    X    </td>
                                                    {$inicio_bucle = $num_semana + 1}
                                                    {$contando = 19}
                                                    {$ultimo = $num_semana}
                                                {else}
                                                    <td></td>
                                                {/if}
                                            {/for}
                                        {/if}
                                    {/for}
                                   {for $fa = 1;$fa<18-$ultimo;$fa++}
                                        <td></td>
                                   {/for}

                                   {/foreach}
                                </tr>

                                {foreach item=rs from=$caps2}
                                {$semanas=array()}
                                {$cont=0}
                                {for $i=0; $i<count($capsem); $i++ }
                                {if $rs.Cap_IdCapacidades==$capsem[$i]['Cap_IdCapacidad']}
                                {$semanas[$cont]=$capsem[$i]}
                                {$cont=$cont+1}
                                {/if}
                                {/for}
                                <tr>
                                <td>{$rs.Cap_Descripcion}</td>
                                    {$inicio_bucle=1}
                                    {for $eleSem=0;$eleSem<17;$eleSem++}
                                        {if isset($semanas[$eleSem]['Cas_Semana'])}
                                            {$semana =$semanas[$eleSem]['Cas_Semana']}
                                            {$num_semana_ = explode('a',$semana)}
                                            {$num_semana=$num_semana_[2]}
                                            {for $contando = $inicio_bucle;$contando<18;$contando++}
                                                {if $num_semana == $contando }
                                                    <td style='background-color: #d43f3a'>    X    </td>
                                                    {$inicio_bucle = $num_semana + 1}
                                                    {$contando = 19}
                                                    {$ultimo = $num_semana}
                                                {else}
                                                    <td></td>
                                                {/if}
                                            {/for}
                                        {/if}
                                    {/for}
                                   {for $fa = 1;$fa<18-$ultimo;$fa++}
                                        <td></td>
                                   {/for}

                                   {/foreach}

                                   {foreach item=rs from=$caps3}
                                {$semanas=array()}
                                {$cont=0}
                                {for $i=0; $i<count($capsem); $i++ }
                                {if $rs.Cap_IdCapacidades==$capsem[$i]['Cap_IdCapacidad']}
                                {$semanas[$cont]=$capsem[$i]}
                                {$cont=$cont+1}
                                {/if}
                                {/for}
                                <tr>
                                <td>{$rs.Cap_Descripcion}</td>
                                    {$inicio_bucle=1}
                                    {for $eleSem=0;$eleSem<17;$eleSem++}
                                        {if isset($semanas[$eleSem]['Cas_Semana'])}
                                            {$semana =$semanas[$eleSem]['Cas_Semana']}
                                            {$num_semana_ = explode('a',$semana)}
                                            {$num_semana=$num_semana_[2]}
                                            {for $contando = $inicio_bucle;$contando<18;$contando++}
                                                {if $num_semana == $contando }
                                                    <td style='background-color: #d43f3a'>    X    </td>
                                                    {$inicio_bucle = $num_semana + 1}
                                                    {$contando = 19}
                                                    {$ultimo = $num_semana}
                                                {else}
                                                    <td></td>
                                                {/if}
                                            {/for}
                                        {/if}
                                    {/for}
                                   {for $fa = 1;$fa<18-$ultimo;$fa++}
                                        <td></td>
                                   {/for}

                                   {/foreach}
                                </tr>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="calif">7. CALIFICACION:</label>
                    <p>{$silabo.Sil_Califacion}</p>
                    <img src="{$_layoutParams.root_clear}{$silabo.Sil_url_img}" style="width: 500px; height: auto;" alt=" ">
                </div>
                <div class="form-group">
                    <label for="act1">8. REFERENCIAS BIBLIOGRAFICAS:</label>
                    <p>{$silabo.Sil_Bibliiografia}</p>
                </div>
                <div class="form-group">
                    <label>Fecha: {$silabo.Sil_Fecha}</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <center><button class="btn btn-success" onclick='imprimir()' >Imprimir</button></center>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
     </div>
        <!-- /.container-fluid -->
    </div>
        </div>