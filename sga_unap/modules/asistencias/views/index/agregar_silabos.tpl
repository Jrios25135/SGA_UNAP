    <div class="panel-body" style=" margin: 15px">
            <div class="row" >
            <div class="panel panel-default">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Registro de Sílabos
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-pencil"></i> Complete los datos solicitados
                        </li>
                    </ol>
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a>1. Datos Generales</a></li>
                <li><a>2. Competencias y Capacidades</a></li>
                <li><a>3. Proceso de Aprendizaje</a></li>
                <li><a>4. Cronograma</a></li>
                <li><a>5. Calificación y Bibliografia</a></li>
            </ul><br>
            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>DATOS DEL CURSO</strong>                       
                        </h3>
                    </div>
                    <div class="panel-body" style=" margin: 15px">
                    <p class="panel-title"><STRONG>Nombre del Curso:</STRONG> {$cursos['Cur_Nombre']}</p>
                    <p class="panel-title"><STRONG>Codigo del Curso:</STRONG> {$cursos['Cur_Codigo']}</p>
                    <p class="panel-title"><STRONG>Créditos del Curso:</STRONG> {$cursos['Cur_Creditos']}</p>
                    <p class="panel-title"><STRONG>Horas Teóricas:</STRONG> {$cursos['Cur_HorasTeoria']}</p>
                    <p class="panel-title"><STRONG>Horas de Práctica:</STRONG> {$cursos['Cur_HorasPractica']}</p>
                    <p class="panel-title"><STRONG>Ciclo:</STRONG> {$cursos['Cur_Ciclo']}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <form class="form-horizontal" role="form" method="post" action="" autocomplete="on">
                        <!-- <input type="hidden" name="fecha" value="<?php echo $fecha; ?>"> -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="competencia_general">2. COMPETENCIA GENERAL:</label>
                            <div class="col-lg-10">
                            <textarea class="form-control" required rows="4" id="competencia_general" name="competencia_general"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="sumilla">3. SUMILLA:</label>
                            <div class="col-lg-10">
                            <textarea rows="12" required class="form-control" id="sumilla" name="sumilla"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cap1">4. Competencia 01 (E-A):</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="cap1" name="cap1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cap2">5. Competencia 02 (IF):</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="cap2" name="cap2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cap3">6. Competencia 03 (P):</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="cap3" name="cap3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="act1">7. Actitud 01:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="act1" name="act1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="act2">8. Actitud 02:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="act2" name="act2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="act3">9. Actitud 03:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="act3" name="act3"></textarea>
                            </div>
                        </div>
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