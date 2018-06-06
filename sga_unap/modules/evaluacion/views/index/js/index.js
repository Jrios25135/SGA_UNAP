var _post = null;
var _Per_IdPermiso_ = 0;
$(document).on('ready', function () {   
    $('#form3').validator().on('submit', function (e) {
    if (e.isDefaultPrevented()) {
    } else {
    }
    });        
    $('body').on('click', '.pagina', function () {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"),$(this).attr("total_registros"));
    });
    $('body').on('change', '.s_filas', function () {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"),$(this).attr("total_registros"));
    });
    $('body').on('change', '#escuelas', function () {
        cargarDocentesEscuela($("#escuelas").val());
    }); 
    $('body').on('change', '#docentes_escuela', function () {
        cargarCursosDocenteEscuela($("#escuelas").val(),$("#docentes_escuela").val());
    }); 
    $("body").on('click', '.estado-criterio-evaluacion-academica', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");                
        if (_id_criterio === undefined) {            
            _id_criterio = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }if (!_estado) {
            _estado = 0;
        }        
        _post = $.post(_root_ + 'evaluacion/index/_cambiarEstadoCriterioEvaluacionAcademica',{                    
                    _Cea_IdCriterio: _id_criterio,
                    _Cea_Estado: _estado,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_academica_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_academica_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_academica_administracion").html(data);            
        });        
    }); 
    $("body").on('click', '.estado-criterio-evaluacion-participacion', function() {        
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");                
        if (_id_criterio === undefined) {            
            _id_criterio = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }if (!_estado) {
            _estado = 0;
        }        
        _post = $.post(_root_ + 'evaluacion/index/_cambiarEstadoCriterioEvaluacionParticipacion',{                    
                    _Cep_IdCriterio: _id_criterio,
                    _Cep_Estado: _estado,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_participacion_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_participacion_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_participacion_administracion").html(data);            
        });        
    });  
    $("body").on('click', '.estado-criterio-evaluacion-encuesta', function() {        
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");                
        if (_id_criterio === undefined) {            
            _id_criterio = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }if (!_estado) {
            _estado = 0;
        }        
        _post = $.post(_root_ + 'evaluacion/index/_cambiarEstadoCriterioEvaluacionEncuesta',{                    
                    _Cee_IdCriterio: _id_criterio,
                    _Cee_Estado: _estado,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_encuesta_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_encuesta_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_encuesta_administracion").html(data);            
        });        
    });    
    var paginacion = function (pagina, nombrelista, datos,total_registros) {
        var pagina = {'pagina':pagina,'filas':$("#s_filas_"+nombrelista).val(),'total_registros':total_registros};
        
        $.post(_root_ + 'evaluacion/index/_paginacion_' + nombrelista + '/' + datos, pagina, function (data) {
            $("#" + nombrelista).html('');
            $("#cargando").hide();
            $("#" + nombrelista).html(data);
        });
    }  
    $("body").on('click', ".idioma_s", function () {
        var id = $(this).attr("id");
        var idIdioma = $("#hd_" + id).val();
        gestionIdiomas($("#idCriterio").val(), $("#idIdiomaOriginal").val(), idIdioma);
    });
    $('#confirm-delete').on('show.bs.modal', function(e) { 
        var bookId = $(e.relatedTarget).data('book-id'); 
         $(e.currentTarget).find("#texto_").html(bookId);
    });     
    $("body").on('click', "#buscar_criterio_evaluacion_academica_administracion", function () {  
        $("#cargando").show();     
        buscarCriterioEvaluacionAcademicaAdministracion($("#palabra_criterio").val());        
    });
    $("body").on('click', "#buscar_criterio_evaluacion_academica_ficha", function () {  
        $("#cargando").show();             
        buscarCriterioEvaluacionAcademicaFicha($("#palabra_criterio").val());
    });
    $("body").on('click', "#buscar_criterio_evaluacion_participacion_ficha", function () {  
        $("#cargando").show();             
        buscarCriterioEvaluacionParticipacionFicha($("#palabra_criterio").val());
    });      
    $("body").on('click', '.confirmar-eliminar-criterio-evaluacion-academica', function() { 
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");
        if (_id_criterio === undefined) {
            _id_criterio = 0;
        }
        _Cea_IdCriterio_ = _id_criterio;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.confirmar-eliminar-criterio-evaluacion-participacion', function() { 
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");
        if (_id_criterio === undefined) {
            _id_criterio = 0;
        }
        _Cep_IdCriterio_ = _id_criterio;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.confirmar-eliminar-criterio-evaluacion-encuesta', function() { 
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");
        if (_id_criterio === undefined) {
            _id_criterio = 0;
        }
        _Cee_IdCriterio_ = _id_criterio;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.eliminar_criterio_evaluacion_academica', function() {
        $("#cargando").show();        
        _post = $.post(_root_ + 'evaluacion/index/_eliminarCriterioEvaluacionAcademica',
                {                    
                    _Cea_IdCriterio: _Cea_IdCriterio_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_academica_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_academica_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_academica_administracion").html(data);
        });
    });
    $("body").on('click', '.eliminar_criterio_evaluacion_encuesta', function() {
        $("#cargando").show();        
        _post = $.post(_root_ + 'evaluacion/index/_eliminarCriterioEvaluacionEncuesta',
                {                    
                    _Cee_IdCriterio: _Cee_IdCriterio_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_encuesta_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_encuesta_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_encuesta_administracion").html(data);
        });
    });
    $("body").on('click', '.eliminar_criterio_evaluacion_participacion', function() {
        $("#cargando").show();        
        _post = $.post(_root_ + 'evaluacion/index/_eliminarCriterioEvaluacionParticipacion',
                {                    
                    _Cep_IdCriterio: _Cep_IdCriterio_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_participacion_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_participacion_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_participacion_administracion").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-criterio-evaluacion-academica', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");
        if (_id_criterio === undefined) {
            _id_criterio = 0;
        }
        _Cea_IdCriterio_ = _id_criterio;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + 'evaluacion/index/_eliminarCriterioEvaluacionAcademica',
                {                    
                    _Cea_IdCriterio: _Cea_IdCriterio_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_academica_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_academica_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_academica_administracion").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-criterio-evaluacion-participacion', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");
        if (_id_criterio === undefined) {
            _id_criterio = 0;
        }
        _Cep_IdCriterio_ = _id_criterio;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + 'evaluacion/index/_eliminarCriterioEvaluacionParticipacion',
                {                    
                    _Cep_IdCriterio: _Cep_IdCriterio_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_participacion_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_participacion_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_participacion_administracion").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-criterio-evaluacion-encuesta', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_criterio = $(this).attr("id_criterio");
        if (_id_criterio === undefined) {
            _id_criterio = 0;
        }
        _Cee_IdCriterio_ = _id_criterio;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + 'evaluacion/index/_eliminarCriterioEvaluacionEncuesta',
                {                    
                    _Cee_IdCriterio: _Cee_IdCriterio_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraCriterio").val(),
                    filas:$("#s_filas_"+'listar_criterios_evaluacion_encuesta_administracion').val()
                },
        function(data) {
            $("#listar_criterios_evaluacion_encuesta_administracion").html('');
            $("#cargando").hide();
            $("#listar_criterios_evaluacion_encuesta_administracion").html(data);
        });
    });

});
function buscarCriterioEvaluacionAcademicaAdministracion(criterio) {

    $.post(_root_ + 'evaluacion/index/_buscarCriterioEvaluacionAcademicaAdministracion',{
        palabra:criterio    
    }, function (data) {
        $("#listaregistros").html('');
        $("#cargando").hide();
        $("#listar_criterios_evaluacion_academica_administracion").html(data);    

    });
}
function buscarCriterioEvaluacionAcademicaFicha(criterio) {
    $.post(_root_ + 'evaluacion/index/_buscarCriterioEvaluacionAcademicaFicha',{
        palabra:criterio    
    }, function (data) {
        $("#listaregistros").html('');
        $("#cargando").hide();
        $("#listar_criterios_evaluacion_academica_ficha").html(data);            
    });
}
function buscarCriterioEvaluacionParticipacionFicha(criterio) {
    $.post(_root_ + 'evaluacion/index/_buscarCriterioEvaluacionParticipacionFicha',{
        palabra:criterio
    }, function (data) {
        $("#listaregistros").html('');
        $("#cargando").hide();
        $("#listar_criterios_evaluacion_participacion_ficha").html(data);
    });
}
function cargarDocentesEscuela(idEscuela) {
    $('#cargando').show();
    $.post(_root_ + 'evaluacion/index/_cargarDocentesPorEscuela',{
        idEscuela:idEscuela        
    }, function(data) {
        $('#docentes_escuela').html('');
        $('#cargando').hide();                
        $("#docentes_escuela").html(data);        
    });
}
function cargarCursosDocenteEscuela(idEscuela,idUsuarioRol) {
    $('#cargando').show();
    $.post(_root_ + 'evaluacion/index/_cargarCursosDocenteEscuela',{
        idEscuela:idEscuela,       
        idUsuarioRol:idUsuarioRol      
    }, function(data) {
        $('#cursos_docente_escuela').html('');
        $('#cargando').hide();                
        $("#cursos_docente_escuela").html(data);        
    });
}