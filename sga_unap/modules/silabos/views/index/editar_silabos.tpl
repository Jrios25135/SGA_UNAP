<div class="panel-body" style=" margin: 15px">
            <div class="row" >
            <div class="panel panel-default">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edición de Sílabo
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-pencil"></i> Modifique los datos del sílabo
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
                    <h3>Datos del Curso</h3>
                    <p>Nombre del Curso: </p>
                    <p>Codigo del Curso: </p>
                    <p>Créditos del Curso: </p>
                    <p>Horas Teóricas: </p>
                    <p>Horas de Práctica: </p>
                    <p>Ciclo: </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <form class="form-horizontal" role="form" method="post" action="" autocomplete="on">
                        <!-- <input type="hidden" name="fecha" value="<?php echo $fecha; ?>"> -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="competencia_general">2. COMPETENCIA GENERAL:</label>
                            <div class="col-lg-10">
                            <textarea class="form-control" required rows="4" id="competencia_general" name="competencia_general">{$silabo.Sil_CompetenciaGeneral}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="sumilla">3. SUMILLA:</label>
                            <div class="col-lg-10">
                            <textarea rows="12" required class="form-control" id="sumilla" name="sumilla">{$silabo.Sil_Sumilla}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cap1">4. Ingrese Competencia 01:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="cap1" name="cap1">{$comp[0]['Com_Descripcion']}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cap2">5. Ingrese Competencia 02:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="cap2" name="cap2">{$comp[1]['Com_Descripcion']}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="cap3">6. Ingrese Competencia 03:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="cap3" name="cap3">{$comp[2]['Com_Descripcion']}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="act1">7. Ingrese Actitud 01:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="act1" name="act1">{$silabo.Sil_Actitud1}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="act2">8. Ingrese Actitud 02:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="act2" name="act2">{$silabo.Sil_Actitud2}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="act3">9. Ingrese Actitud 03:</label>
                            <div class="col-lg-10">
                            <textarea rows="5" required class="form-control" id="act3" name="act3">{$silabo.Sil_Actitud3}</textarea>
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