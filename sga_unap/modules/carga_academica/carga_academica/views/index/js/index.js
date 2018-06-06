var _post = null;
var _Per_IdPermiso_ = 0;
$(document).on('ready', function() {
    $("#cursor").select2();
    $('#form3').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {} else {}
    });
    /*----------- Codigo de Jose-----------------*/
    // $(document).ready(function() {
    // $('.mdb-select').material_select();
    // });  
    $(document).on('change', "#selEscuela", function() {
        //console.log('entro 1');        
        actualizarcurricula($('#selEscuela').val());
    });
    $(document).on('change', "#selCurricula", function() {
        actualizarciclo_curricula($("#selCurricula").val());
        actualizarcursorequi($("#selCurricula").val());
    });

    function actualizarcurricula(Esc_IdEscuela) {
        // console.log('entro 2');
        $("cargando").show();
        $.post(_root_ + 'carga_academica/index/actualizarcurricula', {
            Esc_IdEscuela: Esc_IdEscuela
        }, function(data) {
            $("#selCurricula").html('');
            $("#cargando").hide();
            $("#selCurricula").html(data);
        });
    }

    function actualizarciclo_curricula(Cui_IdCurricula) {
        $("cargando").show();
        $.post(_root_ + 'carga_academica/index/actualizarciclo_curricula', {
            Cui_IdCurricula: Cui_IdCurricula
        }, function(data) {
            console.log(data);
            $("#selciclo_curricula").html('');
            $("#cargando").hide();
            $("#selciclo_curricula").html(data);
        });
    }

    function actualizarcursorequi(Cui_IdCurricula) {
        $("cargando").show()
        $.post(_root_ + 'carga_academica/index/actualizarcursorequi', {
            Cui_IdCurricula: Cui_IdCurricula
        }, function(data) {
            $("#cursor").html('');
            $("#cargando").hide();
            $("#cursor").html(data);
        });
    }
    $('body').on('click', '.pagina', function() {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"), $(this).attr("total_registros"));
    });
    $('body').on('change', '.s_filas', function() {
        $("#cargando").show();
        paginacion($(this).attr("pagina"), $(this).attr("nombre"), $(this).attr("parametros"), $(this).attr("total_registros"));
    });
    var paginacion = function(pagina, nombrelista, datos, total_registros) {
        var pagina = {
            'pagina': pagina,
            'filas': $("#s_filas_" + nombrelista).val(),
            'total_registros': total_registros
        };
        $.post(_root_ + 'acl/index/_paginacion_' + nombrelista + '/' + datos, pagina, function(data) {
            $("#" + nombrelista).html('');
            $("#cargando").hide();
            $("#" + nombrelista).html(data);
        });
    }
    $("body").on('click', ".idioma_s", function() {
        var id = $(this).attr("id");
        var idIdioma = $("#hd_" + id).val();
        gestionIdiomas($("#idRol").val(), $("#idIdiomaOriginal").val(), idIdioma);
    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        var bookId = $(e.relatedTarget).data('book-id');
        $(e.currentTarget).find("#texto_").html(bookId);
    });
    $("body").on('click', '.estado-permiso', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_permiso = $(this).attr("id_permiso");
        if (_id_permiso === undefined) {
            _id_permiso = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }
        _post = $.post(_root_ + 'acl/index/_cambiarEstadoPermisos', {
            _Per_IdPermiso: _id_permiso,
            _Per_Estado: _estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraPermiso").val(),
            filas: $("#s_filas_" + 'listarPermisos').val()
        }, function(data) {
            $("#listarPermisos").html('');
            $("#cargando").hide();
            $("#listarPermisos").html(data);
            // mensaje(JSON.parse(data));
        });
    });
    //----------------------ROLES-------------------//
    $("body").on('click', "#buscar", function() {
        $("#cargando").show();
        buscarCurso($("#palabraCurso").val());
    });
    $("body").on('click', '.estado-rol', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_rol = $(this).attr("id_rol");
        if (_id_rol === undefined) {
            _id_rol = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }
        _post = $.post(_root_ + 'acl/index/_cambiarEstadoRol', {
            _Rol_IdRol: _id_rol,
            _Rol_Estado: _estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraRol").val(),
            filas: $("#s_filas_" + 'listarRoles').val()
        }, function(data) {
            $("#listarRoles").html('');
            $("#cargando").hide();
            $("#listarRoles").html(data);
            // mensaje(JSON.parse(data));
        });
    });
    $("body").on('click', '.confirmar-eliminar-rol', function() {
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_rol = $(this).attr("id_rol");
        if (_id_rol === undefined) {
            _id_rol = 0;
        }
        _Rol_IdRol_ = _id_rol;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.eliminar_rol', function() {
        $("#cargando").show();
        // _Per_IdPermiso = _eliminar;
        _post = $.post(_root_ + 'acl/index/_eliminarRol', {
            _Rol_IdRol: _Rol_IdRol_,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraRol").val(),
            filas: $("#s_filas_" + 'listarRoles').val()
        }, function(data) {
            $("#listarRoles").html('');
            $("#cargando").hide();
            $("#listarRoles").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-rol', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        _id_rol = $(this).attr("id_rol");
        if (_id_rol === undefined) {
            _id_rol = 0;
        }
        _Rol_IdRol_ = _id_rol;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + 'acl/index/_eliminarRol', {
            _Rol_IdRol: _Rol_IdRol_,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraRol").val(),
            filas: $("#s_filas_" + 'listarRoles').val()
        }, function(data) {
            $("#listarRoles").html('');
            $("#cargando").hide();
            $("#listarRoles").html(data);
        });
    });
    /*-------------Codigo agregado por Jose----------------*/
    function buscarCurso(criterio) {
        $.post(_root_ + 'carga_academica/index/_buscarCurso', {
            palabra: criterio
        }, function(data) {
            $("#listaregistros").html('');
            $("#cargando").hide();
            $("#listarCurso").html(data);
        });
    }
    /*---------------------------------------------------*/
    function buscarPermiso(criterio) {
        $("#cargando").show();
        $.post(_root_ + 'acl/index/_buscarPermiso', {
            palabra: criterio
        }, function(data) {
            $("#listarPermisos").html('');
            $("#cargando").hide();
            $("#listarPermisos").html(data);
        });
    }

    function gestionIdiomas(idrol, idIdiomaOriginal, idIdioma) {
        $("#cargando").show();
        $.post(_root_ + 'acl/index/gestion_idiomas_rol', {
            idrol: idrol,
            idIdioma: idIdioma,
            idIdiomaOriginal: idIdiomaOriginal
        }, function(data) {
            $("#gestion_idiomas_rol").html('');
            $("#cargando").hide();
            $("#gestion_idiomas_rol").html(data);
            $('form').validator();
        });
    }
});