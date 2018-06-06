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
                        <i class="fa fa-pencil"></i> Edición de detalles de calificación y bibliografía
                    </li>
                </ol>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar"
                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                80% Completado
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li><a>1. Datos Generales</a></li>
            <li><a>2. Competencias y Capacidades</a></li>
            <li><a>3. Proceso de Aprendizaje</a></li>
            <li><a>3. Cronograma</a></li>
            <li class="active"><a>5. Calificación y Bibliografía</a></li>
        </ul><br>
        <form action="" method="post" name="agregarsilabo5" enctype="multipart/form-data">
        <div class="col-lg-10">
                    <div class="row">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>CALIFICACIÓN:</strong>                       
                            </h3>
                        </div>
                         <textarea name="calif" class="form-control" id="calif" rows="16" placeholder="Escriba aquí" required></textarea>
                          <div class="row panel-body">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="img">Esquema de calificación:</label>
                                        <input type="file" class="form-control" name="img" id="img" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-lg-10">
                    <div class="row">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;<strong>BIBLIOGRAFÍA:</strong>                       
                            </h3>
                        </div>
                        <textarea name="bib" class="form-control" id="bib" rows="16" placeholder="Escriba aquí..." required></textarea>
                        </div>
                    </div>
                </div>
           
            <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
            <button class="btn btn-primary" type="submit" name="enviar" id="enviar" value="enviar" ><i class="icon-plus-sign icon-white"> </i>Finalizar</button>
            </div>
        </form><
    </div>
         </div>
        <!-- /.container-fluid -->
    </div>
        </div>