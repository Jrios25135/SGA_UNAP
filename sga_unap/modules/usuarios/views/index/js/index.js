var _post = null;
var _Ded_IdDetalleDocente = 0;
$(document).on('ready', function() {
    $('#form1').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            // everything looks good!
            //        guardarUsuario($("#nombre").val(),$("#apellidos").val(),$("#dni").val(),$("#direccion").val(),
            //                $("#telefono").val(),$("#institucion").val(),$("#cargo").val(),
            //                $("#correo").val(),$("#usuario").val(),$("#contrasena").val(),$("#confirmarContrasena").val());
        }
    });
    $('#form2').validator().on('submit', function(e) {
        if (e.isDefaultPrevented()) {
            // handle the invalid form...
        } else {
            // everything looks good!
            //   guardarRol($("#nuevoRol").val());
        }
    });
    //////////////7////////////////////////////// CODIGO DE JOSE /////////////////////////////////////////////////////////////
    $("body").on('click', "#buscarDocente", function() {
        $("#cargando").show();
        buscarDocente($("#palabra").val());
    });

    function buscarDocente(criterio) {
        $.post(_root_ + 'usuarios/index/buscarDocente', {
            palabra: criterio
        }, function(data) {
            $("#listardocente").html('');
            $("#cargando").hide();
            $("#listardocente").html(data);
        });
    }
    $("body").on('click', "#buscarAlumno", function() {
        $("#cargando").show();
        buscarAlumno($("#palabra").val());
    });

    function buscarAlumno(criterio) {
        $.post(_root_ + 'usuarios/index/buscarAlumno', {
            palabra: criterio
        }, function(data) {
            $("#listaralumno").html('');
            $("#cargando").hide();
            $("#listaralumno").html(data);
        });
    }
    $(document).on('change', "#selescuela", function() {
        //console.log('entro 1');        
        actualizarcurricula($('#selescuela').val());
    });

    function actualizarcurricula(Esc_IdEscuela) {
        // console.log('entro 2');
        $("cargando").show();
        $.post(_root_ + 'usuarios/index/actualizarcurricula', {
            Esc_IdEscuela: Esc_IdEscuela
        }, function(data) {
            $("#selcurri").html('');
            $("#cargando").hide();
            $("#selcurri").html(data);
        });
    }
    /////////////////////// cambiar estado docente ////////////////////////////////////////////////////////
    $("body").on('click', '.estado-docente', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        id_detalledocente = $(this).attr("id_detalledocente");
        if (id_detalledocente === undefined) {
            id_detalledocente = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }
        _post = $.post(_root_ + 'usuarios/index/cambiarEstadoDocente', {
            _Ded_IdDetalleDocente: id_detalledocente,
            _Ded_Estado: _estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraDocente").val(),
            filas: $("#s_filas_" + 'listardocente').val()
        }, function(data) {
            $("#listardocente").html('');
            $("#cargando").hide();
            $("#listardocente").html(data);
        });
    });
    $("body").on('click', '.confirmar-eliminar-docente', function() {
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        id_detalledocente = $(this).attr("id_detalledocente");
        if (id_detalledocente === undefined) {
            id_detalledocente = 0;
        }
        _Ded_IdDetalleDocente = id_detalledocente;
        _Row_Estado_ = 0;
    });
    $("body").on('click', '.eliminar_docente', function() {
        $("#cargando").show();
        _post = $.post(_root_ + 'usuarios/index/eliminarHabilitarDocente', {
            _Ded_IdDetalleDocente: _Ded_IdDetalleDocente,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraDocente").val(),
            filas: $("#s_filas_" + 'listardocente').val()
        }, function(data) {
            $("#listardocente").html('');
            $("#cargando").hide();
            $("#listardocente").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-docente', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        id_detalledocente = $(this).attr("id_detalledocente");
        if (id_detalledocente === undefined) {
            id_detalledocente = 0;
        }
        _Ded_IdDetalleDocente = id_detalledocente;
        _Row_Estado_ = 1;
        _post = $.post(_root_ + 'usuarios/index/eliminarHabilitarDocente', {
            _Ded_IdDetalleDocente: _Ded_IdDetalleDocente,
            _Row_Estado: _Row_Estado_,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraCriterio").val(),
            filas: $("#s_filas_" + 'listardocente').val()
        }, function(data) {
            $("#listardocente").html('');
            $("#cargando").hide();
            $("#listardocente").html(data);
        });
    });
    /////////////////////////////////// estado alumno //////////////////////////////////////////
    $("body").on('click', '.estado-alumno', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        id_detallealumno = $(this).attr("id_detallealumno");
        if (id_detallealumno === undefined) {
            id_detallealumno = 0;
        }
        _estado = $(this).attr("estado");
        if (_estado === undefined) {
            _estado = 0;
        }
        if (!_estado) {
            _estado = 0;
        }
        _post = $.post(_root_ + 'usuarios/index/cambiarEstadoAlumno', {
            _Dea_IdDetalleAlumno: id_detallealumno,
            _Dea_Estado: _estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraEstudiante").val(),
            filas: $("#s_filas_" + 'listaralumno').val()
        }, function(data) {
            $("#listaralumno").html('');
            $("#cargando").hide();
            $("#listaralumno").html(data);
        });
    });
    $("body").on('click', '.confirmar-eliminar-alumno', function() {
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        id_detallealumno = $(this).attr("id_detallealumno");
        if (id_detallealumno === undefined) {
            id_detallealumno = 0;
        }
        id_detallealumno = id_detallealumno;
        _Row_Estado = 0;
    });
    $("body").on('click', '.eliminar_alumno', function() {
        $("#cargando").show();
        _post = $.post(_root_ + 'usuarios/index/eliminarHabilitarAlumno', {
            _Dea_IdDetalleAlumno: id_detallealumno,
            _Row_Estado: _Row_Estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraEstudiante").val(),
            filas: $("#s_filas_" + 'listaralumno').val()
        }, function(data) {
            $("#listaralumno").html('');
            $("#cargando").hide();
            $("#listaralumno").html(data);
        });
    });
    $("body").on('click', '.confirmar-habilitar-alumno', function() {
        $("#cargando").show();
        if (_post && _post.readyState != 4) {
            _post.abort();
        }
        id_detallealumno = $(this).attr("id_detallealumno");
        if (id_detallealumno === undefined) {
            id_detallealumno = 0;
        }
        _Dea_IdDetalleAlumno = id_detallealumno;
        _Row_Estado = 1;
        _post = $.post(_root_ + 'usuarios/index/eliminarHabilitarAlumno', {
            _Dea_IdDetalleAlumno: id_detallealumno,
            _Row_Estado: _Row_Estado,
            pagina: $(".pagination .active span").html(),
            palabra: $("#palabraCriterio").val(),
            filas: $("#s_filas_" + 'listaralumno').val()
        }, function(data) {
            $("#listaralumno").html('');
            $("#cargando").hide();
            $("#listaralumno").html(data);
        });
    });
    /////////////////////// ACA TERMINA  /////////////////////////////////////////////////
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
    $("body").on('click', "#btn_nuevoRol", function() {
        nuevoDivRol();
    });
    $("body").on('click', "#btn_editContra", function() {
        editContraDiv($("#idusuario").val());
    });
    $("body").on('click', "#buscar", function() {
        buscar($("#palabra").val(), $("#buscarRol").val());
    });
    $("body").on('change', "#buscarRol", function() {
        buscar($("#palabra").val(), $("#buscarRol").val());
    });
    $("body").on('click', "#btn_guardarRol", function() {
        if ($("#nuevoRol").val()) {
            rol_usuario($("#idusuario").val(), $("#nuevoRol").val());
        } else {
            guardarRol($("#nuevoRol").val());
        }
    });
});

function buscar(palabra, idrol) {
    $.post(_root_ + 'usuarios/index/_buscarUsuario', {
        palabra: palabra,
        idrol: idrol
    }, function(data) {
        $("#listaregistros").html('');
        $("#listaregistros").html(data);
    });
}

function guardarRol(role) {
    $.post(_root_ + 'acl/index/nuevo_role/' + role, {
        nuevoRol: role
    }, function(data) {
        $("#nuevo_rol").html('');
        $("#nuevo_rol").html(data);
    });
}

function nuevoDivRol() {
    $.post(_root_ + 'usuarios/index/divRol', {}, function(data) {
        $("#agregarRol").html('');
        $("#agregarRol").html(data);
        $('form').validator();
    });
}

function editContraDiv(idusuario) {
    $.post(_root_ + 'usuarios/index/divEditContra', {
        idusuario: idusuario
    }, function(data) {
        $("#editarContrasena").html('');
        $("#editarContrasena").html(data);
        $('form').validator();
    });
}

function rol_usuario(idusuario, nuevo) {
    $.post(_root_ + 'usuarios/index/rol/' + idusuario + '/' + nuevo, {}, function(data) {
        $("#rol_usuario").html('');
        $("#rol_usuario").html(data);
        $('form').validator();
    });
}