var _post = null;
var _IdRegistro_ = 0;
var formulario = "";
$(document).on('ready', function () {   
    
formulario = $("#formulario").val();
    $('body').on('click', '.pagina', function () {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"),$(this).attr("total_registros"));
    });
    $('body').on('change', '.s_filas', function () {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"),$(this).attr("total_registros"));
    });

    $("body").on('change', "#capa", function () {        
        actualizarProceso($("#capa").val());
    });
    
    $("body").on('click', ".idioma_s", function () {
        var id = $(this).attr("id");
        var idIdioma = $("#hd_" + id).val();
        gestionIdiomas($("#idRol").val(), $("#idIdiomaOriginal").val(), idIdioma);
    });

    $('#confirm-delete2').on('show.bs.modal', function(e) { 
        var bookId = $(e.relatedTarget).data('book-id'); 
         $(e.currentTarget).find("#texto_").html(bookId);
         var bookIdCap = $(e.relatedTarget).data('book-id-cap'); 
         $(e.currentTarget).find("#idcap").val(bookIdCap);
    }); 

    $('#confirm-editar').on('show.bs.modal', function(e) { 
        var bookId = $(e.relatedTarget).data('book-id'); 
         $(e.currentTarget).find("#texto_editar").html(bookId);
         var bookIdCap = $(e.relatedTarget).data('book-id-cap'); 
         $(e.currentTarget).find("#idcap").val(bookIdCap);
    }); 
    var paginacion = function (pagina, nombrelista, datos,total_registros) {
        var pagina = {'pagina':pagina,'nombrelista':nombrelista,'filas':$("#s_filas_"+nombrelista).val(),'total_registros':total_registros};
        
        $.post(_root_ + _modulo + '/' + _controlador + '/' + '_paginacion_' + nombrelista + '/' + datos, pagina, function (data) {
            $("#" + nombrelista).html('');
            $("#cargando").hide();
            $("#" + nombrelista).html(data);
        });
    }  

//------------------------CURRICULA/FACULTAD/TODOS----------------------------//
    $("body").on('click', "#btnBuscarRegistros", function () { 
        $("#cargando").show();       
        buscarRegistros($("#palabraBusqueda").val());
    }); 

    $("body").on('click', '.estado-registro', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }

        _id_registro = $(this).attr("id_registro");
        if (_id_registro === undefined) {
            _id_registro = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }

        _post = $.post(_root_  + _modulo + '/' + _controlador + '/' + '_cambiarEstado' + formulario,
                {                    
                    _IdRegistro: _id_registro,
                    _EstadoRegistro: _estado,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraBusqueda").val(),
                    formulario: formulario,
                    filas: $("#s_filas_listar" + formulario).val()
                },
        function(data) {
            $("#listar" + formulario).html('');
            $("#cargando").hide();
            $("#listar" + formulario).html(data);
            // mensaje(JSON.parse(data));
        });
    });

    $("body").on('click', '.confirmar-eliminar-registro', function() {
        
        if (_post && _post.readyState != 4) {
            _post.abort();
        }

        _id_registro = $(this).attr("id_registro");
        if (_id_registro === undefined) {
            _id_registro = 0;
        }

        _IdRegistro_ = _id_registro;
        _Row_Estado_ = 0;
    });

    $("body").on('click', '.eliminar_registro', function() {
        $("#cargando").show();
        // _Per_IdPermiso = _eliminar;
        
        _post = $.post(_root_  + _modulo + '/' + _controlador + '/' + '_eliminar' + formulario,
                {                    
                    _IdRegistro: _IdRegistro_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraBusqueda").val(),
                    formulario: formulario,
                    filas:$("#s_filas_"+'listar' + formulario).val()
                },
        function(data) {
            $("#listar" + formulario).html('');
            $("#cargando").hide();
            $("#listar" + formulario).html(data);
        });
    });

    $("body").on('click', '.confirmar-habilitar-registro', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }

        _id_registro = $(this).attr("id_registro");
        if (_id_registro === undefined) {
            _id_registro = 0;
        }

        _IdRegistro_ = _id_registro;
        _Row_Estado_ = 1;
        
        _post = $.post(_root_  + _modulo + '/' + _controlador + '/' + '_eliminar' + formulario,
                {                    
                    _IdRegistro: _IdRegistro_,
                    _Row_Estado: _Row_Estado_,
                    pagina: $(".pagination .active span").html(),
                    palabra: $("#palabraBusqueda").val(),
                    formulario: formulario,
                    filas:$("#s_filas_"+'listar' + formulario).val()
                },
        function(data) {
            $("#listar" + formulario).html('');
            $("#cargando").hide();
            $("#listar" + formulario).html(data);
        });
    });

//------------------------CURRICULA/FACULTAD/TODOS----------------------------/





// Pagina para todas las listas FIN 
    
    $("body").on('click', ".idioma_s", function () {
        var id = $(this).attr("id");
        var idIdioma = $("#hd_" + id).val();
        gestionIdiomas($("#idRol").val(), $("#idIdiomaOriginal").val(), idIdioma);
    });

    $('#confirm-delete').on('show.bs.modal', function(e) { 
        var bookId = $(e.relatedTarget).data('book-id'); 
         $(e.currentTarget).find("#texto_").html(bookId);
    }); 


});
function buscarRol(criterio) {
    $.post(_root_ + 'acl/index/_buscarRol',
    {
        palabra:criterio
        
    }, function (data) {
        $("#listaregistros").html('');
        $("#cargando").hide();
        $("#listarRoles").html(data);
    });
}
function buscarPermiso(criterio) {
    $("#cargando").show();
    $.post(_root_ + 'acl/index/_buscarPermiso',
    {
        palabra:criterio
        
    }, function (data) {
        $("#listarPermisos").html('');
        $("#cargando").hide();
        $("#listarPermisos").html(data);
    });
}
function gestionIdiomas(idrol, idIdiomaOriginal, idIdioma) {
    $("#cargando").show();
    $.post(_root_ + 'acl/index/gestion_idiomas_rol',
            {
                idrol: idrol,        
                idIdioma: idIdioma,
                idIdiomaOriginal: idIdiomaOriginal
            }, function (data) {
        $("#gestion_idiomas_rol").html('');
        $("#cargando").hide();
        $("#gestion_idiomas_rol").html(data);
        $('form').validator();
    });
}

function actualizarProceso(idcapa) {
    $("#cargando").show();
    $.post(_root_ + 'silabos/index/actualizarProceso',
    {
        idcapa:idcapa
        
    }, function (data) {
        $("#proceso_capa").html('');
        $("#cargando").hide();
        $("#proceso_capa").html(data);
    });
}

//General para todos
function buscarRegistros(criterio) {
    $("#cargando").show();
    $.post(_root_ + _modulo + '/' + _controlador + '/' +  '_buscar' + formulario,
    {
        palabra:criterio,
        formulario:formulario
        
    }, function (data) {
        $("#listar" + formulario).html('');
        $("#cargando").hide();
        $("#listar" + formulario).html(data);
    });
}
